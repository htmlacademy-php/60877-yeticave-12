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

$date = $_POST['lot-date'] ?? NULL;
if (isset($_FILES['add-lot-file'])) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES['add-lot-file']['name'];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;
    move_uploaded_file($_FILES['add-lot-file']['tmp_name'], $file_path . $file_name);
    $file_type = finfo_file($finfo, "uploads/$file_name");
    if ($file_type !== 'image/jpeg'&&$file_type !== 'image/png') {
        $errors['format'] = "Неверный формат картинки";
    }
}

if ($date) {
if (!is_date_valid($date)) {
    $errors['date'] = "Поле даты неправильное!";
  }
}

$datedif = strtotime($date)-strtotime('now');
if ($datedif<0) {
    $errors['wrongdate'] = "Выберите дату больше нынешней!";
}
$authorid = 1;
$namefieldsafe = mysqli_real_escape_string($con, $namefield);
$messagesafe = mysqli_real_escape_string($con, $message);
$categoriessafe = mysqli_real_escape_string($con, $categories);
$lotRatesafe = mysqli_real_escape_string($con, $lotRate);
$lotStepsafe = mysqli_real_escape_string($con, $lotStep);
$authoridsafe = mysqli_real_escape_string($con, $authorid);
$datesafe = mysqli_real_escape_string($con, $date);
if (!$errors) {
    $lotname = $_FILES['add-lot-file']['name'];
    $date_of_creation = date("Y-m-d H-i-s");
    if ($_POST['category']==="Ботинки") {
      $categoryid = 1;
      $symbol_code = "botinki";
    }
    else if ($_POST['category']==="Доски и лыжи") {
        $categoryid = 2;
        $symbol_code = "doski_i_lishi";
    }
    else if ($_POST['category']==="Инструменты") {
        $categoryid = 3;
        $symbol_code = "instrumenti";
    }
    else if ($_POST['category']==="Крепления") {
        $categoryid = 4;
        $symbol_code = "kreplenia";
    }
    else if ($_POST['category']==="Одежда") {
        $categoryid = 5;
        $symbol_code = "odeshda";
    }
    else if ($_POST['category']==="Разное") {
        $categoryid = 6;
        $symbol_code = "raznoe";
    }

    $insertlot = 'INSERT INTO lots ("date_of_creation", "name_of_the_lot", "deskription",img, start_price, step_of_the_bid, authorid, winnerid, finish_date) VALUES (CURRENT_TIMESTAMP, "$namefieldsafe" ,"$messagesafe", "$categoriessafe" , $lotRatesafe , $lotStepsafe, $authoridsafe , NULL, $datesafe)';
mysqli_query($con, $insertlot );
/*$insertcategories =  "INSERT INTO categories ('name', 'symbol_code') VALUES (mysqli_real_escape_string($categories), mysqli_real_escape_string($symbol_code))";
mysqli_query($con, $insertcategories );*/
$lastid = "select id from lots order by id desc limit 1";
$lastidinsert = mysqli_fetch_row (mysqli_query($con, $lastid ));
header("Location: lot.php/?id=".$lastidinsert[0]);
}}
else {
    $namefield = $_POST['lot-name'] ?? NULL;
    $categories = $_POST['category'] ?? NULL;
    $message = $_POST['message'] ?? NULL;
    $lotRate = $_POST['lot-rate'] ?? NULL;
    $lotStep = $_POST['lot-step'] ?? NULL;
    $content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors, "namefield"=>$namefield,"categories"=>$categories, "message"=>$message, "lotRate"=>$lotRate,"lotStep"=>$lotStep ]);
    $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
    print($layout_content);
 }
?>
