<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

if(isset($_GET['categoryid'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['categoryid']);// проверить что оно есть
}

/*пагинация*/
$countAllLotsCat = "select count(lots.id) as count from lots join categories on lots.categoryid = categories.id where categories.id = " . $categoryId;
$countAllLotsCatQuery = mysqli_query($con, $countAllLotsCat);
$numberLotsFromCat = mysqli_fetch_array($countAllLotsCatQuery, MYSQLI_ASSOC);

$num = 9;

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}


$total = ceil($numberLotsFromCat["count"] / $num);//проверить что есть $numberLotsFromCat["count"];

if (empty($page) || $page < 0) {
    $page = 1;
}

if ($page > $total) {
    $page = $total;
}
$start = $page * $num - $num;


$queryLot = "Select img, lots.id as lotsid, name_of_the_lot, img, lots.deskription, categoryid, start_price, finish_date,
step_of_the_bid, name from lots join categories on lots.categoryid = categories.id
where categories.id = " . $categoryId . " and finish_date >current_timestamp LIMIT $start, $num";
$resultLot = mysqli_query($con, $queryLot);
$allCategoriesLot = mysqli_fetch_all($resultLot, MYSQLI_ASSOC);

while ($postRow[] = mysqli_fetch_array($resultLot)){}
/*конец пагинации*/

$selectAllLotCategory = "select name from categories where id = ".$categoryId;
$selectAllCategoryQuery = mysqli_query($con, $selectAllLotCategory);
$selectAllCategoryQueryArr = mysqli_fetch_array($selectAllCategoryQuery, MYSQLI_ASSOC);

$title = "All Lots";

/*$theHistoryofBidsSum = "select * FROM bids where bids.lotid = " . $allCategoriesLot[0]['lotsid'];
$resultTheHistoryofBidsum = mysqli_query($con, $theHistoryofBidsSum);
$rowsHistorySum = mysqli_fetch_all($resultTheHistoryofBidsum, MYSQLI_ASSOC);*/

//написать запрос где выбирается все id категорий
/*$getIdLots = "select id from lots where categoryid = ". $categoryId;
$getIdLotsQuery = mysqli_query($con, $getIdLots);
$getIdLotsQueryArr = mysqli_fetch_all($getIdLotsQuery, MYSQLI_ASSOC);*/
/*foreach($allCategoriesLot as $allCategoriesLotOneElem) {

    $lotsIdAll = $allCategoriesLotOneElem["lotsid"];

    $theHistoryOfBids = "Select count(id) as count from bids where lotid = " . $lotsIdAll;
$resultTheHistoryOfBids = mysqli_query($con, $theHistoryOfBids);
$countBidsRes = mysqli_fetch_all($resultTheHistoryOfBids, MYSQLI_ASSOC);

}*/

$content = include_template('all-lots.php', ['rowsСategories' => $rowsCategories, "allCategoriesLot" => $allCategoriesLot, "selectAllCategoryQueryArr" => $selectAllCategoryQueryArr, "postrow" => $postRow, "page" => $page, "total" => $total]);

$layoutContent = include_template('layout.php', ['rowsCategories'=>$rowsCategories, 'content' => $content, "title" => $title]);

print($layoutContent);
