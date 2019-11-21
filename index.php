<?php require_once('./init.php');
//var_dump($con);

$page_content = include_template('main.php', ['categories' => $categories]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => 'YetiCave - Главная страница',
    'categories' => $categories
]);

print $layout_content;