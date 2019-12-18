<?php 

require_once('./init.php');

if (isset($_SESSION['user_name'])) {
    http_response_code(403);
    header("Location: /");    
} else {
    $required_fields = ['email', 'password'];
    $errors = [];
    $user;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($required_fields as $field) {
            $errors[$field] = validateFilled($field);
        }

        if (!isset($errors['email'])) {
            $errors['email'] = validateEmail($_POST['email']);
        }

        $errors = array_filter($errors);

        if (empty($errors)) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $sql_res = mysqli_query($con, $sql);
        }
        
        if (empty($errors) && $sql_res->num_rows > 0) {
            $users = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
            $user = $users[0];

            if (password_verify($_POST['password'], $user['pwd'])) {

                // Введён верный пароль, открываем сессию
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = strip_tags($user['name']);
                $_SESSION['user_email'] = strip_tags($user['email']);
                header("Location: /");

            } else {
                $errors['password'] = 'Вы ввели неверный пароль';
            }
        } elseif ($sql_res->num_rows < 1) {
            $errors['email'] = 'Пользователя с таким email не существует.';
        }
    }

    $page_content = include_template('login.php', ['categories' => $categories, 'errors' => $errors]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'user_name' => $user_name,
        'title' => 'YetiCave - Вход на сайт',
        'categories' => $categories
    ]);

    print $layout_content;
}