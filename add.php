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

$add = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth]);
if (isset($submit)) {
    $required_fields = [$_POST['lot-name'], $_POST['category'], $_POST['message'], $_POST['lot-rate'], $_POST['lot-step']];
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    $errors["date"]  = is_date_valid($_POST['lot-date']);
}
print($add);
?>
