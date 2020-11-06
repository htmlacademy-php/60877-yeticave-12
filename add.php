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

$name  = $_POST['lot-name'];

if (empty($name)) {
    $errors['name'] = "Поле имени пустое";
}

$categories  = $_POST['category'];

if (empty($categories)) {
    $errors['categories'] = "Поле категории пустое";
}

$message  = $_POST['message'];

if (empty($message)) {
    $errors['message'] = "Поле сообщения пустое";
}

$lotRate  = $_POST['lot-rate'];

if (empty($lotRate)) {
    $errors['lot-rate-empty'] = "Поле сообщения пустое";
}

if (!is_numeric($_POST['lot-rate'])||($_POST['lot-rate']<0)){
    $errors['lot-rate-num'] = "Начальная цена не число! Или меньше ноля";
}

$lotStep  = $_POST['lot-step'];

if (empty($lotStep)) {
    $errors['lot-step-empty'] = "Поле сообщения пустое";
}

if (!is_numeric($_POST['lot-step'])||($_POST['lot-step']<0)){
    $errors['lot-step-num'] = "Шаг ставки не число! Или меньше ноля";
}

if (isset($_FILES['add-lot-file'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES['add-lot-file']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;

    move_uploaded_file($_FILES['add-lot-file']['tmp_name'], $file_path . $file_name);
    $file_type = finfo_file($finfo, $file_name);
    if ($file_type !== 'image/jpg'||$file_type !== 'image/jpeg'||$file_type !== 'image/png') {
        $errors['format'] = "Неверный формат картинки";
    }
}
$date = $_POST['date'];
if (!is_date_valid($date)) {
    $errors['date'] = "Поле даты неправильное!";
}

$content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors, "name"=>$name,"categories"=>$categories, "message"=>$message, "lotRate"=>$lotRate,"lotStep"=>$lotStep ]);

$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
echo $_POST['lot-step'];
print($layout_content);
?>
