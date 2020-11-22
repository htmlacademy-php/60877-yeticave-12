<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);
$errors = [];

if ($_POST['senddata']??NULL) {
$namefield  = $_POST['lot-name'] ?? NULL;

if (empty($namefield)) {
    $errors['name'] = "Поле имени пустое";
}

$categories  = $_POST['category'] ?? NULL;
echo $categories;
if ($categories <0) {
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
    $errors['lot-step-empty'] = "Поле сообщения пустое! ";
}

if (!is_numeric($lotStep)||($lotStep<0)){
    $errors['lot-step-num'] = "Шаг ставки не число! Или меньше ноля";
}

$date = $_POST['lot-date'] ?? NULL;
if (empty($date)) {
    $errors['missing-date'] = "Выберите дату!! ";
}
$datedif = strtotime($date)-strtotime('now');
if ($datedif<0) {
    $errors['wrongdate'] = "Выберите дату больше нынешней!";
}
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
    if (empty($file_name)) {
        $errors['image-size'] = "Нету картинки!!";
    }
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

    $insertlot = "INSERT INTO lots (date_of_creation, name_of_the_lot,
    deskription,img, start_price, step_of_the_bid, authorid, winnerid, finish_date, categoryid)
    VALUES (CURRENT_TIMESTAMP, '$namefieldsafe' ,'$messagesafe', '$file_url' ,
    $lotRatesafe , $lotStepsafe, $authoridsafe , NULL, '$datesafe', $categories)";

mysqli_query($con, $insertlot );

$lastid = "select id from lots order by id desc limit 1";
$lastidinsert = mysqli_fetch_row (mysqli_query($con, $lastid ));
header("Location: lot.php/?id=".$lastidinsert[0]);
}}
var_dump($errors);
    $namefield = $_POST['lot-name'] ?? NULL;
    $categories = $_POST['category'] ?? NULL;
    $message = $_POST['message'] ?? NULL;
    $lotRate = $_POST['lot-rate'] ?? NULL;
    $lotStep = $_POST['lot-step'] ?? NULL;
    $content = include_template('add-lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors, "namefield"=>$namefield,"categories"=>$categories, "message"=>$message, "lotRate"=>$lotRate,"lotStep"=>$lotStep ]);
    $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
    print($layout_content);

?>
