<?php

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$categories = array("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");
$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$lot = include_template('lot.php', ['rowslots' => $rowslots, 'rowscategories'=>$rowscategories, 'is_auth' => $is_auth]);

print($lot);
?>
