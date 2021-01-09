<?php
session_start();
date_default_timezone_set('Europe/Kiev');
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
require_once("getwinner.php");

$querylots = "Select name_of_the_lot, categoryid, name, symbol_code, start_price, finish_date, img, lots.id from lots
join categories on lots.categoryid = categories.id where finish_date>CURTIME() order by lots.id DESC";
$resultlots = mysqli_query($con, $querylots );
$rowslots = mysqli_fetch_all($resultlots, MYSQLI_ASSOC);

$querycategories = "Select categories.id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$title = "Главная";

$content = include_template('main.php', ['rowscategories' => $rowscategories, 'rowslots' => $rowslots, 'resultlots'=>$resultlots]);

$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories]);

print($layout_content);
?>
