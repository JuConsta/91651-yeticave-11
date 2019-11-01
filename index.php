<?php
require_once('./helpers.php');
require_once('./functions.php');
require_once('./data.php');

$page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => 'YetiCave - Главная страница',
    'categories' => $categories
]);

print $layout_content;