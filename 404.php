<?php
session_start();
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = 'Страница ошибки';

$queryСategories = 'Select id, name, symbol_code from categories';
$resultСategories = mysqli_query($con, $queryСategories);
$rowsСategories = mysqli_fetch_all($resultСategories, MYSQLI_ASSOC);

$content = include_template('404.php', ['rowscategories' => $rowsСategories]);
$layoutСontent = include_template('layout.php', ['content' => $content, 'title' => $title, 'rowscategories' => $rowsСategories]);

print($layoutСontent);
