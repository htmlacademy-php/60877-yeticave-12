<?php
session_start();
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = 'Страница ошибки';

$queryCategories = 'SELECT id, name, symbol_code FROM categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$content = include_template('404.php', ['rowsCategories' => $rowsCategories]);
$layoutContent = include_template('layout.php', ['content' => $content, 'title' => $title, 'rowscategories' => $rowsCategories]);

print($layoutContent);
