<?php
session_start();
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$title = "Главная";

$errors = [];
$email = mysqli_real_escape_string($con, $_POST['email']??NULL);
$password = mysqli_real_escape_string($con, $_POST['password']??NULL);
$submit = $_POST['submit']??NULL;
if (isset($submit)) {
if (empty($email)) {
  $errors['email'] = "Пустой email!";
}
$validateemail = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$validateemail) {
  $errors['wrongformatemail'] = "Неверный формат email";
}

if (empty($password)) {
    $errors['password'] = "Пустой пароль!";
  }
  if (!$errors){
     $authenthification = "SELECT name, id, password FROM `users` WHERE `email` = '".$email . "'";
     $authenthificationfromdatabasequery = mysqli_query($con, $authenthification );
     $id_check_results = mysqli_fetch_array($authenthificationfromdatabasequery, MYSQLI_ASSOC);
     $verify = password_verify($password, $id_check_results['password']);
      if(isset($id_check_results['id'])){
        if(password_verify($password, $id_check_results['password'])){

            $_SESSION['iduser'] = $id_check_results['id'];
            $_SESSION['username'] = $id_check_results['name'];
            header("Location: /");
        }
    }
    else {
        $errors['wrongdata'] = "Неверные логин или пароль!";
    }
  }
}


$content = include_template('login.php', ['rowscategories'=>$rowscategories, 'errors'=>$errors]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'user_name' => 'Максим Березинец']);
print($layout_content);

?>
