<?php
// Форматирование суммы
function sum_format($sum) {
    $sum = ceil($sum);  
    if ($sum >= 1000) {
        $sum = number_format($sum, 0, ".", " ");
    }    
    return $sum;
}

// Подсчет оставшегося времени для лота
function get_date_range($expiration_date) {    
    $exp_dt = strtotime($expiration_date); //получение timestamp переданной даты
    $cur_dt = time(); //timestamp текущего времени
    $diff = $exp_dt - $cur_dt; //интервал
    
    if ($diff <= 0) {
        return false;
    }
    else {
        $range_hours = floor($diff/3600); //часов
        $range_minutes = ceil($diff%3600 / 60); //минут
        $range_hours = str_pad($range_hours, 2, "0", STR_PAD_LEFT);
        $range_minutes = str_pad($range_minutes, 2, "0", STR_PAD_LEFT);
        return [$range_hours, $range_minutes];
    }
}
