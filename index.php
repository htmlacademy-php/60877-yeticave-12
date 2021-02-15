<?php

session_start();
require_once("timezone.php");

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
require_once("getwinner.php");

$queryLots = 'Select name_of_the_lot, categoryid, name, symbol_code, start_price, finish_date, img, lots.id from lots
join categories on lots.categoryid = categories.id where finish_date>CURTIME() order by lots.id DESC';
$resultLots = mysqli_query($con, $queryLots);
$rowsLots = mysqli_fetch_all($resultLots, MYSQLI_ASSOC);

$queryCategories = "Select categories.id, name, symbol_code from categories";
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$title = "Главная";
$content = include_template('main.php', ['rowsCategories' => $rowsCategories, 'rowsLots' => $rowsLots, 'resultlots' => $resultLots]);

$layoutContent = include_template('layout.php', ['rowsCategories'=>$rowsCategories, 'content' => $content, 'title' => 'Главная']);

print($layoutContent);
