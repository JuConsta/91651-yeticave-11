<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./data.php');

$lot = [];

$con = mysqli_connect("localhost", "root", "", "yeticave");
if ($con) {
     mysqli_set_charset($con, "utf8");    
        
        if (isset($_GET['id'])) { 
            
        $sql_lot = "SELECT l.*, c.name AS cat_name FROM lots l JOIN categories c ON (c.id = l.category_id) WHERE l.id = " . $_GET['id'];
            
        $sql_res = mysqli_query($con, $sql_lot);
        if ($sql_res) {            
            //обработка результата
            $lot = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
            /*echo "<pre>";
            var_dump($lot);
            echo "</pre>";*/
            //var_dump($sql_res);
        }
        else {
            //ошибка sql-запроса
            $error = mysqli_error($con);
            //куда-то вывести $error, например:
            print ("Ошибка MySQL: " . $error);
            //var_dump($sql_res);
        }
    }
    else {
        //в строке запроса нет параметра "id"
        http_response_code(404);
    }
}
else {
    //ошибка соединения с БД - куда-то вывести, например:
    print ("Ошибка соединения с БД: " . mysqli_connect_error());
}
 

$page_content = include_template('lot.php', ['categories' => $categories, 'lot' => $lot[0]]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => 'YetiCave - Лот',
    'categories' => $categories
]);

print $layout_content;
       