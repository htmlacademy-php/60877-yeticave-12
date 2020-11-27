<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories = mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$email = mysqli_real_escape_string($con, $_POST['email']??NULL);

$password = mysqli_real_escape_string($con, $_POST['password']??NULL);

$name  = mysqli_real_escape_string($con, $_POST['name']??NULL);

$contacts = mysqli_real_escape_string($con, $_POST['message']??NULL);

$errors = [];
$register = $_POST['register']??NULL;

if (isset($register)) {

  if (empty($email)) {
    $errors['email'] = "Не заполнено поле майла!";
  }
  $validateemail = filter_var($email, FILTER_VALIDATE_EMAIL);
  if (!$validateemail) {
    $errors['wrongformatemail'] = "Неверный формат email";
  }
  if (empty($password)) {
    $errors['password'] = "Не заполнено поле пароля!";
  }
  if(isset($password)){
    $password = password_hash($password, PASSWORD_DEFAULT);
  }
  if (empty($name)) {
    $errors['name'] = "Не заполнено поле имени!";
  }

   if  (empty($contacts)) {
    $errors['message'] = "Не заполнено поле контактных данных!";
  };

  $check_email = "SELECT COUNT(`id`) as count FROM `users` WHERE `email` = '".$email . "'";
  $check_email_query = mysqli_query($con, $check_email );
  $email_check_results = mysqli_fetch_array($check_email_query, MYSQLI_ASSOC);
  if ($email_check_results['count'] > 0) {
      $errors['repeatemail'] = "Такой email уже есть";
  }
  if (!$errors) {
    $insertafterregistrate = "INSERT INTO users
    (date_registration, email, password, name, contacts) VALUES (CURRENT_TIMESTAMP, '$email', '$password', '$name', '$contacts')";



    mysqli_query($con, $insertafterregistrate);
    header("Location: index.php");
}
}



$content = include_template('registration-page.php', ['rowscategories' =>$rowscategories, "errors"=>$errors]);
$layout_content = include_template('layout.php', ['content' => $content, "errors"=>$errors, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец', 'rowscategories' =>$rowscategories]);
print($layout_content);
