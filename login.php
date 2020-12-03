<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);


$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
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
    //$_SESSION['email'] = $email;
    //$sessionemail = $_SESSION['email'];
    //$_SESSION['password'] = $password;
    //$sessionpassword = $_SESSION['password'];
     //$emailsession = $_SESSION['email']??NULL ;
     //$passwordsession = $_SESSION['password']??NULL;
     //$check_emailsession = "SELECT * FROM `users` WHERE `email` = '".$sessionemail . "'";
     $authenthification = "SELECT name, id, password FROM `users` WHERE `email` = '".$email . "'";
     $authenthificationfromdatabasequery = mysqli_query($con, $authenthification );
     $id_check_results = mysqli_fetch_array($authenthificationfromdatabasequery, MYSQLI_ASSOC);
     $verify = password_verify($password, $id_check_results['password']);

     var_dump( $verify);
      if(isset($id_check_results['id'])){
        if(password_verify($password, $id_check_results['password'])){
            session_start();
            $_SESSION['iduser'] = $id_check_results['id'];
            $_SESSION['username'] = $id_check_results['name'];
            header("Location: /");
        }
    }
    else {

    }
  }
}



$content = include_template('login.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'errors'=>$errors]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories, 'is_auth' => $is_auth, 'user_name' => 'Максим Березинец']);
print($layout_content);

?>
