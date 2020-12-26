<?php
session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);



$content = include_template('my-bets.php', ['rowscategories'=>$rowscategories]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories]);

print($layout_content);
