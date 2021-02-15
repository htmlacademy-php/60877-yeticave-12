<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

if (empty($_SESSION['iduser'])) {
    header("HTTP/1.0 403 Forbidden");
    return;
}

$selectUser = "select name from users where id = ".$_SESSION['iduser'];
$selectUserQuery = mysqli_query($con, $selectUser);
$getUser = mysqli_fetch_array($selectUserQuery, MYSQLI_ASSOC);

if (empty($getUser['name'])) {
    header("HTTP/1.0 403 Forbidden");
    return;
}

$title = "Добавить лот";
$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
$errors = [];

if ($_POST['senddata'] ?? NULL) {
    $nameField = $_POST['lot-name'] ?? NULL;

    if (empty($nameField)) {
        $errors['name'] = "Поле имени пустое";
    }

    $categories = $_POST['category'] ?? NULL;
    if ($categories < 0) {
        $errors['categories'] = "Поле категории пустое";
    }

    $message = $_POST['message'] ?? NULL;

    if (empty($message)) {
        $errors['message'] = "Поле сообщения пустое";
    }

    $lotRate = $_POST['lot-rate'] ?? NULL;

    if (empty($lotRate)) {
        $errors['lot-rate-empty'] = "Поле сообщения пустое";
    }

    if (!is_numeric($lotRate) || ($lotRate < 0)) {
        $errors['lot-rate-num'] = "Начальная цена не число! Или меньше ноля";
    }

    $lotStep = $_POST['lot-step'] ?? NULL;

    if (empty($lotStep)) {
        $errors['lot-step-empty'] = "Поле сообщения пустое! ";
    }

    if (!is_numeric($lotStep) || ($lotStep < 0)) {
        $errors['lot-step-num'] = "Шаг ставки не число! Или меньше ноля";
    }

    $date = $_POST['lot-date'] ?? NULL;
    if (empty($date)) {
        $errors['missing-date'] = "Выберите дату!! ";
    }
    $dateDif = strtotime($date) - time();
    if ($dateDif < 0) {
        $errors['wrongdate'] = "Выберите дату больше нынешней!";
    }
    if (isset($_FILES['add-lot-file'])) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileName = $_FILES['add-lot-file']['name'];
        $filePath = __DIR__ . '/uploads/';
        $fileUrl = '/uploads/' . $fileName;
        $fileType = finfo_file($finfo, "uploads/$fileName");

        if(empty($fileName)){
            $errors['image-null'] = "Нету картинки!!";
        }
        elseif($fileType !== 'image/jpeg' && $fileType !== 'image/png')  {
             $errors['format'] = "Неверный формат картинки";

        }
        else {
            move_uploaded_file($_FILES['add-lot-file']['tmp_name'], $filePath . $fileName);
        }
    }
    else {
        $errors['image-not'] = "Нету файла!!";
    }

    $authorId = $_SESSION['iduser'];
    $nameFieldSafe = mysqli_real_escape_string($con, $nameField);
    $messageSafe = mysqli_real_escape_string($con, $message);
    $categoriesSafe = mysqli_real_escape_string($con, $categories);
    $lotRateSafe = mysqli_real_escape_string($con, $lotRate);
    $lotStepSafe = mysqli_real_escape_string($con, $lotStep);
    $authorIdSafe = mysqli_real_escape_string($con, $authorId);
    $dateSafe = mysqli_real_escape_string($con, $date);

    if (!$errors) {
        $lotName = $_FILES['add-lot-file']['name'];
        $dateOfCreation = date("Y-m-d H-i-s");

        $insertLot = "INSERT INTO lots (date_of_creation, name_of_the_lot,
    deskription,img, start_price, step_of_the_bid, winnerid, finish_date, categoryid)
    VALUES (CURRENT_TIMESTAMP, '$nameFieldSafe' ,'$messageSafe', '$fileUrl' ,
    $lotRateSafe,$lotStepSafe, $authorIdSafe, '$dateSafe',$categories)";
       if( mysqli_query($con, $insertLot)){
        $lastid = 'select id from lots order by id desc limit 1';
        $lastidinsert = mysqli_fetch_row(mysqli_query($con, $lastid));
        header("Location: lot.php/?id=" . $lastidinsert[0]);
       }
else {
      $errors['not-add'] = "Не добавлен лот!";
    }
}}
$nameField = $_POST['lot-name'] ?? NULL;
$categories = $_POST['category'] ?? NULL;
$message = $_POST['message'] ?? NULL;
$lotRate = $_POST['lot-rate'] ?? NULL;
$lotStep = $_POST['lot-step'] ?? NULL;

$content = include_template('add-lot.php', ['rowsCategories' => $rowsCategories, 'errors' => $errors, 'nameField' => $nameField, 'categories' => $categories, 'message' => $message, 'lotRate' => $lotRate, 'lotStep' => $lotStep]);

$layoutContent = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowsCategories' => $rowsCategories]);

print ($layoutContent);
