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
    $querylots = "Select name_of_the_lot, img, deskription, categoryid, start_price, finish_date, step_of_the_bid from lots where id = ".$id;
    $resultlots = mysqli_query($con, $querylots );
    $rowslots= mysqli_fetch_all($resultlots, MYSQLI_ASSOC);
}
else {
    header('HTTP/1.1 404 Not Found');
    include '404.php'; // or 404.php whatever you want...
    exit();
}

$thehistoryofbidssum= "Select id from bids";
$resultthehistoryofbidsum = mysqli_query($con, $thehistoryofbidssum );
$resultofthebids = mysqli_num_rows($resultthehistoryofbidsum);
$rowshistorysum= mysqli_fetch_all($resultofthebids, MYSQLI_ASSOC);

$thehistoryofbids= "Select id, date, summary_of_the_lot, name from bids JOIN users ON bids.userid = users.id";
$resultthehistoryofbids = mysqli_query($con, $thehistoryofbids );
$resulthistorybids = mysqli_num_rows($resultthehistoryofbids);
$rowshistory= mysqli_fetch_all($resulthistorybids, MYSQLI_ASSOC);

$lot = include_template('lot.php', ['rowscategories'=>$rowscategories, 'is_auth' => $is_auth, 'rowslots'=>$rowslots, 'rowshistorysum'=>$rowshistorysum, 'resultofthebidssum' => $resultofthebidssum, 'rowshistory'=>$rowshistory]);

print($lot);
?>
