<?php
$con;
$con = mysqli_connect("localhost", "root", "", "yeticave");
if ($con) {
     mysqli_set_charset($con, "utf8");   
}
else {
    //ошибка соединения с БД - куда-то вывести, например:
    print ("Ошибка соединения с БД: " . mysqli_connect_error());
}