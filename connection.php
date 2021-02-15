<?php

$con = mysqli_connect("localhost", "root", "", "yeticave");

mysqli_set_charset($con, "utf8");

if ($con === false) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
