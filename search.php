<?php 
require_once('./init.php');

$search; //строка с поисковым запросом
$search_lots = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $search = $_GET['search'];
    
    if ($search) {
        // искать лоты и показывать результат в шаблоне 
        $sql = "SELECT l.*, c.name AS cat_name FROM lots l              
            JOIN categories c ON (c.id = l.category_id)            
            WHERE MATCH(l.name, l.description) AGAINST('$search') 
            HAVING l.dt_exp > NOW()
            ORDER BY l.dt_create DESC";

        $sql_res = mysqli_query($con, $sql);

        if ($sql_res) {            
            $search_lots = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
        } else {
            //ошибка sql-запроса
            $error = mysqli_error($con);
            print ("Ошибка MySQL: " . $error);
        }        
    }
}

$page_content = include_template('search.php', [ 'categories' => $categories, 'search_lots' => $search_lots, 'search' => $search ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'user_name' => $user_name,
        'title' => 'YetiCave - Поиск по лотам',
        'categories' => $categories
    ]);

    print $layout_content;