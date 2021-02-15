<?php

session_start();

require_once("timezone.php");

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = "Страница ставок";

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

if (isset($_SESSION['iduser'])) {
    $userId = $_SESSION['iduser'];
}

/*определение победителей лотов*/
$getWinner = 'select bids.id, users.email, summary_of_the_lot from lots join users on lots.authorid = users.id join bids on
lots.id = bids.lotid where winnerid is null and finish_date < current_timestamp order by summary_of_the_lot desc limit 1';
$queryGetWinner = mysqli_query($con, $getWinner);
$getArrWinner = mysqli_fetch_array($queryGetWinner, MYSQLI_ASSOC);
/*конец определения победителей лотов*/

$userMyBet = "select img, deskription, lots.id, name_of_the_lot, start_price, date_of_creation, finish_date, categories.name from lots JOIN categories ON lots.categoryid = categories.id JOIN bids ON bids.lotid = lots.id where userid = " . $userId;
$userMyBetQuery = mysqli_query($con, $userMyBet);
$userMyBetQueryArray = mysqli_fetch_all($userMyBetQuery, MYSQLI_ASSOC);

$content = include_template('my-bets.php', ['rowsCategories' => $rowsCategories, "userMyBetQueryArray" => $userMyBetQueryArray, "getArrWinner" => $getArrWinner]);

$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, 'title' => $title, "usermybetqueryarray" => $userMyBetQueryArray]);
print($layoutContent);
