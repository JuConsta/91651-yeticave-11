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

// Сохранение значений, введенных в форму
function getPostVal($input_name) {
    return $_POST[$input_name] ?? "";
}

/* ======= ВАЛИДАЦИЯ ФОРМЫ ======= */

// Проверка заполненности поля (кроме файлов)
function validateFilled($name) {
	if (empty($_POST[$name])) {
		return "Заполните поле";
	}
}

// Проверка файла на картинку
function validateImage($name) {
    if (!empty($_FILES[$name]['tmp_name'])) {
        $file_type = mime_content_type($_FILES[$name]['tmp_name']);
        if ($file_type != "image/png" && $file_type != "image/jpeg") {
            return "Добавьте файл типа PNG или JPEG";
        }
    }
    else {
        return "Добавьте файл";
    }
}

// Проверка стоимости на целое больше нуля
function validateSum($value) {
    if (!filter_var($value, FILTER_VALIDATE_INT, ['min_range' => 1])) {
        return "Введите число больше нуля";
    }
}

// Проверка даты истечения лота
function validateDate($value) {
    $date = Datetime::createFromFormat('Y-m-d', $value);
    if (! $date) {
        return "Введите дату в формате ГГГГ-ММ-ДД";
    }

    if ($date < new DateTime('+1 day')) {
        // дата вне требуемого диапазона
        return "Введите дату больше текущей минимум на 1 сутки";
    }
}

// Проверяем, что категория существует в БД
function validateCategory($cat_id, $ids) {
        if (!in_array($cat_id, $ids)) {
            return "Выберите категорию";
        }
}

// ФУНКЦИИ НА БУДУЩЕЕ

// Проверка на email
function validateEmail($value) {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return "Введите корректный email";
    }
}
