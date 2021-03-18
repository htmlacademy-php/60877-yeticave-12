<?php

session_start();

require_once("timezone.php");
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$queryCategories = 'SELECT id, name, symbol_code FROM categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
$title = "Страница Лота";

$userId = '';
if (isset($_SESSION['iduser'])) {
    $userId = mysqli_real_escape_string($con, $_SESSION['iduser']);
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
} else {
    header("Location:404.php");
}

$querySumLot = "SELECT MAX(summary_of_the_lot) FROM bids WHERE bids.lotid = " . $id;
$querySumLotToDb = mysqli_query($con, $querySumLot);
$querySumLotToDbFinal = mysqli_fetch_array($querySumLotToDb, MYSQLI_ASSOC);

/* выбираю макс ставку на данный момент*/
$selectMaxBidForNow = "SELECT MAX(summary_of_the_lot), lots.step_of_the_bid FROM bids JOIN lots ON bids.lotid = lots.id WHERE lotid = " . $id;
$selectMaxBidForNowQuery = mysqli_query($con, $selectMaxBidForNow);
$maxBidForNowArr = mysqli_fetch_all($selectMaxBidForNowQuery, MYSQLI_ASSOC);
/* конец выборки максимальной ставки */


/*начинаю определять текущего юзера*/
$selectLotsAuthor = "SELECT * FROM lots WHERE id = " . $id;
$selectLotsAuthorQuery = mysqli_query($con, $selectLotsAuthor);
$selectLotsAuthorArr = mysqli_fetch_all($selectLotsAuthorQuery, MYSQLI_ASSOC);

/*определяю последнюю дату создания ставки */
$maxDateBid = "SELECT users.id, MAX(date) AS maxdate FROM bids JOIN users ON bids.userid = users.id WHERE bids.lotid = " . $id . " GROUP BY users.id";
$maxdateBidQuery = mysqli_query($con, $maxDateBid);
$maxdateBidQueryArr = mysqli_fetch_array($maxdateBidQuery, MYSQLI_ASSOC);

/*заканчиваю определять последнюю дату ставки */

$rowsHistorySum = [];
$rowsHistory = [];

if (isset($_GET['id'])) {

    $queryLot = "SELECT name_of_the_lot, img, lots.deskription, categoryid, start_price, finish_date, step_of_the_bid, name FROM lots JOIN categories ON lots.categoryid = categories.id WHERE lots.id = " . $id;
    $resultLot = mysqli_query($con, $queryLot);
    $oneLot = mysqli_fetch_array($resultLot, MYSQLI_ASSOC);

    $theHistoryofBidsSum = "SELECT * FROM bids WHERE bids.lotid = " . $id;
    $resultTheHistoryofBidsum = mysqli_query($con, $theHistoryofBidsSum);
    $rowsHistorySum = mysqli_fetch_all($resultTheHistoryofBidsum, MYSQLI_ASSOC);

    $theHistoryofBids = "SELECT bids.id, date, summary_of_the_lot, name FROM bids JOIN users ON bids.userid = users.id WHERE bids.lotid = " . $id;
    $resultheHistoryofBids = mysqli_query($con, $theHistoryofBids);
    $rowsHistory = mysqli_fetch_all($resultheHistoryofBids, MYSQLI_ASSOC);

    if (!$oneLot) {
        header('Location: /404.php');
        die();
    }
}

$errors = [];


$sendBid = filter_input(INPUT_POST, 'send_bid');


if ($sendBid) {
    if (isset($_POST['cost'])) {
        $cost = mysqli_real_escape_string($con, $_POST['cost']);
    }
    if (empty($cost)) {
        $errors['wrongbet'] = "Поле ставки пустое";
    } else {

        $insertIntoDb = "INSERT INTO bids (date, summary_of_the_lot, userid, lotid ) VALUES (current_timestamp, $cost, $userId, $id )";

        $insertIntoDbQuery = mysqli_query($con, $insertIntoDb);
        if (!$insertIntoDbQuery) {
            exit("Запрос не добавил ставку!!");
        }
        header("Location: my-bets.php/?id=" . $id);
    }
}

$content = include_template('lot.php', ['rowsCategories' => $rowsCategories, "maxdateBidQueryArr" => $maxdateBidQueryArr, "userId" => $userId, "selectLotsAuthorArr" => $selectLotsAuthorArr, "maxBidForNowArr" => $maxBidForNowArr, 'querySumLotToDbFinal' => $querySumLotToDbFinal, 'oneLot' => $oneLot, 'rowsHistorySum' => $rowsHistorySum, 'rowsHistory' => $rowsHistory, 'errors' => $errors]);
$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, 'title' => $title]);


print($layoutContent);
