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
if (isset($_POST['senddata'])) {
    $required_fields = [$_POST['lot-name'], $_POST['category'], $_POST['message'], $_POST['lot-rate'], $_POST['lot-step']];
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($field)) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if(!is_date_valid($_POST['lot-date'])){
        $errors["date"] = 'Поле не заполнено';
    }
}
$content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);
?>
