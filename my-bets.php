<?php

session_start();

require_once("timezone.php");

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = "Страница ставок";

$queryCategories = 'SELECT id, name, symbol_code FROM categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);


if (!isset($_SESSION['iduser'])) {
    header('Location: login.php');
    return;
}
$userId = mysqli_real_escape_string($con, $_SESSION['iduser']);

/*определение победителей лотов*/
$getWinner = 'SELECT bids.id, users.email, summary_of_the_lot FROM lots JOIN users ON lots.authorid = users.id JOIN bids ON
lots.id = bids.lotid WHERE winnerid IS NULL AND finish_date < current_timestamp ORDER BY summary_of_the_lot DESC LIMIT 1';
$queryGetWinner = mysqli_query($con, $getWinner);
$getArrWinner = mysqli_fetch_array($queryGetWinner, MYSQLI_ASSOC);
/*конец определения победителей лотов*/

$userMyBet = "SELECT img, deskription, lots.id, name_of_the_lot, start_price, date_of_creation, finish_date, categories.name FROM lots JOIN categories ON lots.categoryid = categories.id JOIN bids ON bids.lotid = lots.id where userid = " . $userId;
$userMyBetQuery = mysqli_query($con, $userMyBet);
$userMyBetQueryArray = mysqli_fetch_all($userMyBetQuery, MYSQLI_ASSOC);

$content = include_template('my-bets.php', ['rowsCategories' => $rowsCategories, "userMyBetQueryArray" => $userMyBetQueryArray, "getArrWinner" => $getArrWinner]);

$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, 'title' => $title, "usermybetqueryarray" => $userMyBetQueryArray]);
print($layoutContent);
