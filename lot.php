<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$categories = array("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");
$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$querycategories = "Select name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

if ($_GET['id']) {
    $id = $_GET['id'];
    $querylots = "Select name_of_the_lot, img, deskription, categoryid, start_price, step_of_the_bid from lots where id = ".$id;
    $resultlots = mysqli_query($con, $querylots );
    $rowslots= mysqli_fetch_all($resultlots, MYSQLI_ASSOC);
}
else {
    header('HTTP/1.1 404 Not Found');
    include '404.php'; // or 404.php whatever you want...
    exit();
}


$lot = include_template('lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'rowslots'=>$rowslots]);

print($lot);
?>
