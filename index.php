<?php
    require_once("helpers.php");
    require_once("function.php");
    $categories = array("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");
$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';

$lots = [
    ['category'=>'Доски и лыжи', 'name'=>"2014 Rossignol District Snowboard", 'price'=>10999, 'img'=>'img/lot-1.jpg'],
    ['category'=>'Доски и лыжи', 'name'=>"DC Ply Mens 2016/2017 Snowboard", 'price'=>159999, 'img'=>'img/lot-2.jpg'],
    ['category'=>'Крепления', 'name'=>"Крепления Union Contact Pro 2015 года размер L/XL", 'price'=>8000, 'img'=>'img/lot-3.jpg'],
    ['category'=>'Ботинки', 'name'=>"Ботинки для сноуборда DC Mutiny Charocal", 'price'=>10999, 'img'=>'img/lot-4.jpg'],
    ['category'=>'Одежда', 'name'=>"Куртка для сноуборда DC Mutiny Charocal", 'price'=>7500, 'img'=>'img/lot-5.jpg'],
    ['category'=>'Разное', 'name'=>"Маска Oakley Canopy", 'price'=>5400, 'img'=>'img/lot-6.jpg'],
];

$content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'categories' => $categories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);

print($layout_content);
?>
</body>
</html>
