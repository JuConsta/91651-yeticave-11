<?php
// Функция форматирования суммы
function sum_format($sum) {
    $sum = ceil($sum);  
    if ($sum >= 1000) {
        $sum = number_format($sum, 0, ".", " ");
    }
    $sum = (string) $sum . " ₽";
    return $sum;
}