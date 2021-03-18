<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

if (empty($_SESSION['iduser'])) {
    throwForbiddenError();
}

if (isset($_SESSION['iduser'])) {


    $idUser = $_SESSION['iduser'];

    $selectUser = "SELECT name FROM users WHERE id = " . $idUser;
    $selectUserQuery = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_array($selectUserQuery, MYSQLI_ASSOC);

    if (empty($getUser['name'])) {
        throwForbiddenError();
    }

    $title = "Добавить лот";
    $queryCategories = 'SELECT id, name, symbol_code FROM categories';
    $resultCategories = mysqli_query($con, $queryCategories);
    $rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
    $errors = [];


    $nameField = '';
    if (isset($_POST['lot-name'])) {
        $nameField = $_POST['lot-name'];
    }

    $categories = '';
    if (isset($_POST['category'])) {
        $categories = $_POST['category'];
    }

    $message = '';
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
    }

    $lotRate = '';
    if (isset($_POST['lot-rate'])) {
        $lotRate = $_POST['lot-rate'];
    }

    $lotStep = '';
    if (isset($_POST['lot-step'])) {
        $lotStep = $_POST['lot-step'];
    }

    if (isset($_POST['senddata'])) {

        if (empty($nameField)) {
            $errors['name'] = "Поле имени пустое";
        }

        if ($categories < 0) {
            $errors['categories'] = "Поле категории пустое";
        }

        if (empty($message)) {
            $errors['message'] = "Поле сообщения пустое";
        }

        if (empty($lotRate)) {
            $errors['lot-rate-empty'] = "Поле сообщения пустое";
        }

        if (!is_numeric($lotRate) || ($lotRate < 0)) {
            $errors['lot-rate-num'] = "Начальная цена не число! Или меньше ноля";
        }

        if (empty($lotStep)) {
            $errors['lot-step-empty'] = "Поле сообщения пустое! ";
        }

        if (!is_numeric($lotStep) || ($lotStep < 0)) {
            $errors['lot-step-num'] = "Шаг ставки не число! Или меньше ноля";
        }

        $date = '';
        if (isset($_POST['lot-date'])) {
            $date = $_POST['lot-date'];
        }

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
            $fileType = finfo_file($finfo, $_FILES['add-lot-file']['tmp_name']);

            if (empty($fileName)) {
                $errors['image-null'] = "Нету картинки!!";
            } elseif ($fileType !== 'image/jpeg' && $fileType !== 'image/png') {
                $errors['format'] = "Неверный формат картинки";
            } else {
                move_uploaded_file($_FILES['add-lot-file']['tmp_name'], $filePath . $fileName);
            }
        } else {
            $errors['image-not'] = "Нету файла!!";
        }

        $authorId = $_SESSION['iduser'];
        if (empty($authorId)) {
            header("Location: login.php");
        }
        $nameFieldSafe = mysqli_real_escape_string($con, $nameField);
        $messageSafe = mysqli_real_escape_string($con, $message);
        $categoriesSafe = mysqli_real_escape_string($con, $categories);
        $lotRateSafe = mysqli_real_escape_string($con, $lotRate);
        $lotStepSafe = mysqli_real_escape_string($con, $lotStep);
        $authorIdSafe = mysqli_real_escape_string($con, $authorId);
        $dateSafe = mysqli_real_escape_string($con, $date);

        if (!$errors) {
            $insertLot = "INSERT INTO lots (date_of_creation, name_of_the_lot,
    deskription,img, start_price, step_of_the_bid, winnerid, finish_date, categoryid)
    VALUES (CURRENT_TIMESTAMP, '$nameFieldSafe' ,'$messageSafe', '$fileUrl' ,
    $lotRateSafe,$lotStepSafe, $authorIdSafe, '$dateSafe',$categories)";
            if (mysqli_query($con, $insertLot)) {
                $lastid = 'select id from lots order by id desc limit 1';
                $lastidinsert = mysqli_fetch_row(mysqli_query($con, $lastid));
                header("Location: lot.php/?id=" . $lastidinsert[0]);
            } else {
                $errors['not-add'] = "Не добавлен лот!";
            }
        }
    }
    $content = include_template('add-lot.php', ['rowsCategories' => $rowsCategories, 'errors' => $errors, 'nameField' => $nameField, 'categories' => $categories, 'message' => $message, 'lotRate' => $lotRate, 'lotStep' => $lotStep]);

    $layoutContent = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowsCategories' => $rowsCategories]);

    print ($layoutContent);
}

