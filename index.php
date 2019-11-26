<?php 

require_once('./init.php');

$lots = [];

if ($con) {
    /* Получение массива с открытыми лотами */
    $sql_lots = "SELECT l.id AS lot_id, dt_exp, image_url, c.name AS cat_name, l.name AS lot_name, start_price FROM lots l JOIN categories c ON (c.id = l.category_id) WHERE dt_exp > NOW() ORDER BY l.dt_create DESC";
    
    $sql_res = mysqli_query($con, $sql_lots);
    
    if ($sql_res) {
        $lots = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
    } else {
        //ошибка sql-запроса
        $error = mysqli_error($con);        
        print ("Ошибка MySQL: " . $error);
    }
}
else {
    //ошибка соединения с БД
    print ("Ошибка соединения с БД: " . mysqli_connect_error());
};

$page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => 'YetiCave - Главная страница',
    'categories' => $categories
]);

print $layout_content;
