<?php

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$querylots = "Select name_of_the_lot, categoryid, name, start_price, finish_date, img, lots.id from lots join categories on lots.categoryid = categories.id where finish_date>CURTIME() order by lots.id DESC";
$querycategories = "Select name, symbol_code from categories";

$resultlots = mysqli_query($con, $querylots );
$resultcategories = mysqli_query($con, $querycategories );

$rowslots = mysqli_fetch_all($resultlots, MYSQLI_ASSOC);
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

    $categories = array("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");
$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$content = include_template('main.php', ['rowscategories' => $rowscategories, 'rowslots' => $rowslots, 'resultlots'=>$resultlots]);

$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);

print($layout_content);
?>
