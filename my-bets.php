<?php

session_start();

date_default_timezone_set('Europe/Kiev');

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$userid = $_SESSION['iduser'];

/*определение победителей лотов*/
$getwinner = "select bids.id, users.email, summary_of_the_lot from lots join users on lots.authorid = users.id join bids on
lots.id = bids.lotid where winnerid is null and finish_date < current_timestamp order by summary_of_the_lot desc limit 1";
$querygetwinner = mysqli_query($con, $getwinner );
$getarrwinner = mysqli_fetch_array($querygetwinner, MYSQLI_ASSOC);
/*конец определения победителей лотов*/

$usermybet = "select img, deskription, lots.id, name_of_the_lot, start_price, date_of_creation, finish_date, categories.name from lots JOIN categories ON lots.categoryid = categories.id where authorid =".$userid;
$usermybetquery = mysqli_query($con, $usermybet);
$usermybetqueryarray = mysqli_fetch_all($usermybetquery, MYSQLI_ASSOC);

$content = include_template('my-bets.php', ['rowscategories'=>$rowscategories, "usermybetqueryarray"=>$usermybetqueryarray, "getarrwinner"=>$getarrwinner]);
$layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories]);

print($layout_content);
