<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$categories = array("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");
$is_auth = rand(0, 1);
$user_name = 'Максим Березинец';
$title = "Главная";

$querycategories = "Select name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

if ($_GET['id']) {
    $id = $_GET['id'];
    $querylot = "Select name_of_the_lot, img, lots.deskription, categoryid,
                         start_price, finish_date, step_of_the_bid, name from lots
                                      join categories on lots.categoryid = categories.id where lots.id = ".$id;
    $resultlot = mysqli_query($con, $querylot );
    $onelot= mysqli_fetch_array($resultlot, MYSQLI_ASSOC);
}
else {
    header('HTTP/1.1 404 Not Found');
    include '404.php'; // or 404.php whatever you want...
    exit();
}

$thehistoryofbidssum= "select * FROM bids ";
$resultthehistoryofbidsum = mysqli_query($con, $thehistoryofbidssum );
$rowshistorysum= mysqli_fetch_all($resultthehistoryofbidsum, MYSQLI_ASSOC);

$thehistoryofbids= "Select bids.id, date, summary_of_the_lot, name from bids JOIN users ON bids.userid = users.id";
$resultthehistoryofbids = mysqli_query($con, $thehistoryofbids );
$rowshistory= mysqli_fetch_all($resultthehistoryofbids, MYSQLI_ASSOC);

$lot = include_template('lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'onelot'=>$onelot, 'rowshistorysum'=>$rowshistorysum, 'rowshistory'=>$rowshistory]);

print($lot);
?>
