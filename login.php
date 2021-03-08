<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);


$title = "Страница логина";

$errors = [];

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
}
else {
    $email = null;
}

if (isset($_POST['password'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
}
else {
    $password = null;
}

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
} else {
    $submit = null;
}

if ($submit) {
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

    if (!$errors) {
        $authenthification = "SELECT name, id, password FROM `users` WHERE `email` = '" . $email . "'";
        $authenthificationFromDatabaseQuery = mysqli_query($con, $authenthification);
        $idCheckResults = mysqli_fetch_array($authenthificationFromDatabaseQuery, MYSQLI_ASSOC);

        $verify = password_verify($password, $idCheckResults['password']);

        if (isset($idCheckResults['id']) && $verify) {
            $_SESSION['iduser'] = $idCheckResults['id'];
            $_SESSION['username'] = $idCheckResults['name'];
            header("Location: /");
        } else {
            $errors['wrongdata'] = "Неверные логин или пароль!";
        }
    }
}


$content = include_template('login.php', ['rowsCategories' => $rowsCategories, 'errors' => $errors]);
$layoutContent = include_template('layout.php', ['content' => $content, 'title' => $title, 'rowsCategories' => $rowsCategories]);
print($layoutContent);
