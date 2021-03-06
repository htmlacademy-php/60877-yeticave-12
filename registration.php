<?php
session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = "Страница регистрации";

$queryCategories = 'SELECT id, name, symbol_code FROM categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$email = '';
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
}

$password = '';
if (isset($_POST['password'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
}

$name = '';
if (isset($_POST['name'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
}

$contacts = '';
if (isset($_POST['message'])) {
    $contacts = mysqli_real_escape_string($con, $_POST['message']);
}

$errors = [];

$register = filter_input(INPUT_POST, 'register');

if ($register) {

    if (empty($email)) {
        $errors['email'] = "Не заполнено поле майла!";
    }
    $validateEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$validateEmail) {
        $errors['wrongformatemail'] = "Неверный формат email";
    }
    if (empty($password)) {
        $errors['password'] = "Не заполнено поле пароля!";
    }
    if (isset($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    if (empty($name)) {
        $errors['name'] = "Не заполнено поле имени!";
    }

    if (empty($contacts)) {
        $errors['message'] = "Не заполнено поле контактных данных!";
    }

    $checkEmail = "SELECT COUNT(`id`) as count FROM `users` WHERE `email` = '" . $email . "'";
    $checkEmailQuery = mysqli_query($con, $checkEmail);
    $emailCheckResults = mysqli_fetch_array($checkEmailQuery, MYSQLI_ASSOC);

    if ($emailCheckResults['count'] > 0) {
        $errors['repeatemail'] = "Такой email уже есть";
    }
    if (!$errors) {
        $insertAfterRegistrate = "INSERT INTO users(date_registration, email, password, name, contacts)
        VALUES (CURRENT_TIMESTAMP, '$email', '$password', '$name', '$contacts')";
        mysqli_query($con, $insertAfterRegistrate);
        header("Location: login.php");
    }
}


$content = include_template('registration-page.php', ['rowsCategories' => $rowsCategories, "errors" => $errors, "title" => $title]);
$layoutContent = include_template('layout.php', ['content' => $content, "errors" => $errors, 'rowsCategories' => $rowsCategories, "title" => $title]);
print($layoutContent);
