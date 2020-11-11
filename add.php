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

if ($_POST['senddata']??NULL) {
$namefield  = $_POST['lot-name'] ?? NULL;

if (empty($namefield)) {
    $errors['name'] = "Поле имени пустое";
}

$categories  = $_POST['category'] ?? NULL;

if (empty($categories)) {
    $errors['categories'] = "Поле категории пустое";
}

$message  = $_POST['message'] ?? NULL;

if (empty($message)) {
    $errors['message'] = "Поле сообщения пустое";
}

$lotRate  = $_POST['lot-rate'] ?? NULL;

if (empty($lotRate)) {
    $errors['lot-rate-empty'] = "Поле сообщения пустое";
}

if (!is_numeric($lotRate)||($lotRate<0)){
    $errors['lot-rate-num'] = "Начальная цена не число! Или меньше ноля";
}

$lotStep  = $_POST['lot-step'] ?? NULL;

if (empty($lotStep)) {
    $errors['lot-step-empty'] = "Поле сообщения пустое";
}

if($lotStep) {
    if (!is_numeric($lotStep)||($lotStep<0)){
        $errors['lot-step-num'] = "Шаг ставки не число! Или меньше ноля";
    }
}


if (isset($_FILES['add-lot-file'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES['add-lot-file']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;

    move_uploaded_file($_FILES['add-lot-file']['tmp_name'], $file_path . $file_name);
    $file_type = finfo_file($finfo, $file_name, $file_url);
    if ($file_type !== 'image/jpeg'||$file_type !== 'image/png') {
        $errors['format'] = "Неверный формат картинки";
    }
}
$date = $_POST['date'] ?? NULL;;

if ($date) {
if (!is_date_valid($date)) {
    $errors['date'] = "Поле даты неправильное!";
  }
}

$content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors, "namefield"=>$namefield,"categories"=>$categories, "message"=>$message, "lotRate"=>$lotRate,"lotStep"=>$lotStep ]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);
}
else {
    $namefield  = $_POST['lot-name'] ?? NULL;
    $categories  = $_POST['category'] ?? NULL;
    $message  = $_POST['message'] ?? NULL;
    $lotRate  = $_POST['lot-rate'] ?? NULL;
    $lotStep  = $_POST['lot-step'] ?? NULL;
    $content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors, "namefield"=>$namefield,"categories"=>$categories, "message"=>$message, "lotRate"=>$lotRate,"lotStep"=>$lotStep ]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);
}
$lotname = $_FILES['add-lot-file']['name'];
if (!$errors) {
    $insertlot =  "INSERT INTO lots (name_of_the_lot, deskription, img, start_price, step_of_the_bid, finish_date) VALUES ($namefield, $message, $lotname , $lotRate, $lotStep, $date)";
mysqli_query($con, $insertlot );
$insertcategories =  "INSERT INTO categories (name) VALUES ($categories)";
mysqli_query($con, $insertcategories );
 $lastid = "Select LAST(id) from lots";
 header("Location: lot.php/?id = ".$lastid);
}


?>
