<?php

session_start();

require_once("timezone.php");
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
$title = "Страница Лота";

if (isset($_SESSION['iduser'])) {
    $userId = mysqli_real_escape_string($con, $_SESSION['iduser']);
} else {
    header("Location:login.php");
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
} else {
    header("Location:404.php");
}

$querySumLot = "Select max(summary_of_the_lot) from bids where bids.lotid = " . $id;
$querySumLotToDb = mysqli_query($con, $querySumLot);
$querySumLotToDbFinal = mysqli_fetch_array($querySumLotToDb, MYSQLI_ASSOC);

/* выбираю макс ставку на данный момент*/
$selectMaxBidForNow = "select max(summary_of_the_lot), lots.step_of_the_bid from bids join lots on bids.lotid = lots.id where lotid = " . $id;
$selectMaxBidForNowQuery = mysqli_query($con, $selectMaxBidForNow);
$maxBidForNowArr = mysqli_fetch_all($selectMaxBidForNowQuery, MYSQLI_ASSOC);
/* конец выборки максимальной ставки */


/*начинаю определять текущего юзера*/
$selectLotsAuthor = "select * from lots where id = " . $id;
$selectLotsAuthorQuery = mysqli_query($con, $selectLotsAuthor);
$selectLotsAuthorArr = mysqli_fetch_all($selectLotsAuthorQuery, MYSQLI_ASSOC);

/*определяю последнюю дату создания ставки */
$maxDateBid = "Select users.id, max(date) as maxdate from bids JOIN users ON bids.userid = users.id where bids.lotid = " . $id . " group by users.id";
$maxdateBidQuery = mysqli_query($con, $maxDateBid);
$maxdateBidQueryArr = mysqli_fetch_array($maxdateBidQuery, MYSQLI_ASSOC);

/*заканчиваю определять последнюю дату ставки */

$oneLot = [];
$rowsHistorySum = [];
$rowsHistory = [];

if (isset($_GET['id'])) {

    $queryLot = "Select name_of_the_lot, img, lots.deskription, categoryid, start_price, finish_date, step_of_the_bid, name from lots join categories on lots.categoryid = categories.id where lots.id = " . $id;
    $resultLot = mysqli_query($con, $queryLot);
    $oneLot = mysqli_fetch_array($resultLot, MYSQLI_ASSOC);

    $theHistoryofBidsSum = "select * FROM bids where bids.lotid = " . $id;
    $resultTheHistoryofBidsum = mysqli_query($con, $theHistoryofBidsSum);
    $rowsHistorySum = mysqli_fetch_all($resultTheHistoryofBidsum, MYSQLI_ASSOC);

    $theHistoryofBids = "Select bids.id, date, summary_of_the_lot, name from bids JOIN users ON bids.userid = users.id where bids.lotid = " . $id;
    $resultheHistoryofBids = mysqli_query($con, $theHistoryofBids);
    $rowsHistory = mysqli_fetch_all($resultheHistoryofBids, MYSQLI_ASSOC);

    if (!$oneLot) {
        header('Location: /404.php');
        die();
    }
}

$errors = [];

if (isset($_POST['send_bid'])) {
    $sendBid = $_POST['send_bid'] ?? NULL;
}

if (isset($sendBid)) {
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
