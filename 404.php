<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$querycategories = "Select name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$mistake = include_template('404.php', ['rowscategories'=>$rowscategories]);

print($mistake);
?>
