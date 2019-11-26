<?php 

require_once('./init.php');

$required_fields = ['email', 'password', 'name', 'message']; // Обязательные поля
$errors = []; // Ошибки валидации
$sql;
$sql_res;

//Проверить, что отправлена форма.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //Убедиться, что заполнены все обязательные поля.
    foreach ($required_fields as $field) {            
        $errors[$field] = validateFilled($field);     
    }
    
    //проверяем правильность заполнения email
    if (!isset($errors['email'])) {
        $errors['email'] = validateEmail($_POST['email']);
    }
    
    $errors = array_filter($errors); //убираем все NULL из массива ошибок
    
    if (empty($errors)) { //если нет ошибок валидации        
        
        //Проверить, что указанный email уже не используется другим пользователем.        
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $sql_res = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($sql_res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        } else { 
            //Если ошибок нет, то сохранить данные формы в таблице пользователей.
            //Для хранения пароля в БД его предварительно нужно обработать встроенной функцией password_hash.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $message = mysqli_real_escape_string($con, $_POST['message']);

            $sql = "INSERT INTO users SET
                    email = '" . $email . "',
                    pwd = '" . $password . "',
                    name = '" . $name . "',
                    contact = '" . $message . "';";

            $sql_res = mysqli_query($con, $sql);
        }            
    }
                                                     
    if (empty($errors) && $sql_res) {                      
        // Если данные были сохранены успешно, то переадресовать пользователя на страницу входа.
        header("Location: /login.php");
    }
    
}

$page_content = include_template('sign-up.php', ['categories' => $categories, 'errors' => $errors]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => 'YetiCave - Регистрация',
    'categories' => $categories
]);

print $layout_content;