<?php require_once('init.php');
//print "CON = " . var_dump($con);

    $lots = [];
/* Если отсюда убираю соединение с БД, то лоты не выводятся. Не поняла почему так, на других страницах работает без повторного подключения. */
    $con = mysqli_connect("localhost", "root", "", "yeticave");
    if ($con) {
        mysqli_set_charset($con, "utf8");
        
        /* Получение массива с открытыми лотами */
        $sql_lots = "SELECT l.id AS lot_id, dt_exp, image_url, c.name AS cat_name, l.name AS lot_name, start_price FROM lots l JOIN categories c ON (c.id = l.category_id) WHERE dt_exp > NOW() ORDER BY l.dt_create DESC";
        $sql_res = mysqli_query($con, $sql_lots);
        if ($sql_res) {
            //обработка результата
            $lots = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
            /*echo "<pre>";
            var_dump($lots);
            echo "</pre>";*/
        }
        else {
            //ошибка sql-запроса
            $error = mysqli_error($con);
            //куда-то вывести $error, например:
            print ("Ошибка MySQL: " . $error);
        }
    }
    else {
        //ошибка соединения с БД - куда-то вывести, например:
        print ("Ошибка соединения с БД: " . mysqli_connect_error());
    };
