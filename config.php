<?php

$con;
$con = mysqli_connect("localhost", "root", "", "yeticave");

if ($con) {
     mysqli_set_charset($con, "utf8");   
} 
else {
    //ошибка соединения с БД
    print("Ошибка соединения с БД: " . mysqli_connect_error());
}

//Установка времени жизни сессии (24 часа)
ini_set('session.cookie_lifetime', 86400);
ini_set('session.dc_maxlifetime', 86400);
session_start();