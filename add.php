<?php 
require_once('./init.php');

if (!isset($_SESSION['user_name'])) {
    http_response_code(403);
    exit();
}

    $user_id = $_SESSION['user_id'];
    $cat_ids = array_column($categories, 'id');
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date']; // Обязательные поля, кроме файлов
    $errors = []; // Ошибки, выявленные при валидации формы
    $uploads_dir = '/uploads/'; // папка для загрузки файлов
    $file_path = __DIR__  . $uploads_dir; // абсолютный путь к папке
    $file_name;

    // правила проверки полей, кроме файлов
    $rules = [
        'lot-rate' => function($value) {
            return validateSum($value);
        },
        'lot-step' => function($value) {
            return validateSum($value);
        }, 
        'lot-date' => function($value) {
            return validateDate($value);
        },
        'category' => function($value) use ($cat_ids) {
            return validateCategory($value, $cat_ids);
        }
    ];

    // проверяем, что была отправка формы
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // проверяем на заполненность
        foreach ($required_fields as $field) {            
            $errors[$field] = validateFilled($field);
            // если поле заполнено, то при необходимости выполняем другие проверки
            if (!isset($errors[$field]) && isset($rules[$field])) {
                    $rule = $rules[$field];
                    $errors[$field] = $rule($_POST[$field]);
            }
        }

        // проверка файла
        $errors['lot-img'] = validateImage('lot-img');
        if(!$errors['lot-img']){
            $file_name =  uniqid() . '_' . $_FILES['lot-img']['name'];
        }

        $errors = array_filter($errors); //убираем все NULL из массива ошибок

        if (count($errors) == 0) { //если нет ошибок валидации (форма заполнена верно):

            //переносим файл в постоянную папку
            move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . $file_name);

            $sql_newlot = "INSERT INTO lots SET         
                            name = '". $_POST["lot-name"] ."',
                            description = '". $_POST["message"] ."',
                            image_url = '". $uploads_dir . $file_name ."',
                            start_price = ". $_POST["lot-rate"] .",
                            bid_step = ". $_POST["lot-step"] .",
                            dt_exp = '". $_POST["lot-date"] ."',
                            category_id = ". $_POST["category"] .",
                            user_id = $user_id;";    

            if ($con) {        
                $sql_res = mysqli_query($con, $sql_newlot);
                if ($sql_res) {                      
                    // перенаправляем на страницу с новым лотом
                    header("Location: /lot.php/?id=".mysqli_insert_id($con));
                } else {
                    //ошибка sql-запроса
                    print ("Ошибка MySQL: " . mysqli_error($con));
                }
            } else {
                //ошибка соединения с БД
                print ("Ошибка соединения с БД: " . mysqli_connect_error());
            };        
        }
    }

    $page_content = include_template('add.php', ['categories' => $categories, 'errors' => $errors]);
    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'user_name' => $user_name,
        'title' => 'YetiCave - Добавление нового лота',
        'categories' => $categories
    ]);

    print $layout_content;
