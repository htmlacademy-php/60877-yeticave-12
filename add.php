<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$querycategories = "Select name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);
$errors = [];
if (isset($_POST['senddata'])) {
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if(!is_date_valid($_POST['lot-date'])){
        $errors["date"] = 'Поле не заполнено';
    }
}
$content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);
?>
