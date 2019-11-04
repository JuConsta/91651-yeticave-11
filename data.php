<?php 
date_default_timezone_set('Europe/Moscow'); //относится к конфигурации, наверно, но пока сюда вынесла
$user_name = 'Юлия'; // укажите здесь ваше имя

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

$lots = [
    [
        "name" => "2014 Rossignol District Snowboard",
        "category" => "Доски и лыжи",
        "price" => 10999,
        "image_url" => "img/lot-1.jpg",
        "exp_date" => "2019-11-05"
    ],
    [
        "name" => "DC Ply Mens 2016/2017 Snowboard",
        "category" => "Доски и лыжи",
        "price" => 159999,
        "image_url" => "img/lot-2.jpg",
        "exp_date" => "2019-12-30"
    ],
    [
        "name" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => "Крепления",
        "price" => 8000,
        "image_url" => "img/lot-3.jpg",
        "exp_date" => "2019-11-04 11:00" //добавила часы для проверки добавления нуля к часам и минутам
    ],
    [
        "name" => "Ботинки для сноуборда DC Mutiny Charocal",
        "category" => "Ботинки",
        "price" => 10999,
        "image_url" => "img/lot-4.jpg",
        "exp_date" => "2019-11-15"
    ],
    [
        "name" => "Куртка для сноуборда DC Mutiny Charocal",
        "category" => "Одежда",
        "price" => 7500,
        "image_url" => "img/lot-5.jpg",
        "exp_date" => "2019-11-07"
    ],
    [
        "name" => "Маска Oakley Canopy",
        "category" => "Разное",
        "price" => 5400,
        "image_url" => "img/lot-6.jpg",
        "exp_date" => "2019-11-10"
    ],
];