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
        if ($_POST[$field]) {
            $errors['field'] = 'Поле не заполнено';
        }
        else {
            unset($errors['field']);
        }
    }
    if(!is_date_valid($_POST["lot-date"])){
        $errors['date'] = 'Поле даты не валидно';
    }
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

if (!is_numeric($_POST['lot-rate'])&&($_POST['lot-rate']<0)){
    $errors['lot-rate'] = "Начальная цена не число! Или меньше ноля";
}

if (!is_numeric($_POST['lot-step'])&&($_POST['lot-step']<0)){
    $errors['lot-step'] = "Шаг ставки не число! Или меньше ноля";
}

$content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);
?>
