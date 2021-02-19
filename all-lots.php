<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

if(isset($_GET['categoryid'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['categoryid']);
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

if ($numberLotsFromCat["count"]) {
    $total = ceil($numberLotsFromCat["count"] / $num);//проверить что есть $numberLotsFromCat["count"];
}


if (empty($page) || $page < 0) {
    $page = 1;
}

if ($page > $total) {
    $page = $total;
}
$start = $page * $num - $num;


$queryLot = 'SELECT
l.`name_of_the_lot`,
l.`categoryid`,
c.`name`,
c.`symbol_code`,
l.`start_price`,
l.`finish_date`,
l.`img`,
l.`id`, MAX(b.`summary_of_the_lot`) AS rate,
COUNT(b.`id`) AS rate_count
FROM lots AS l
LEFT JOIN `categories` AS c ON l.`categoryid` = c.`id`
LEFT JOIN `bids` AS b ON b.`lotid` = l.`id`
WHERE l.`finish_date` > CURTIME() AND l.categoryid='.$categoryId.'
GROUP BY l.`id`
ORDER BY l.`id` DESC LIMIT '.$start.', '.$num.'';

$resultLot = mysqli_query($con, $queryLot);
$allCategoriesLot = mysqli_fetch_all($resultLot, MYSQLI_ASSOC);

while ($postRow[] = mysqli_fetch_array($resultLot)){}
/*конец пагинации*/

$selectAllLotCategory = "select name from categories where id = ".$categoryId;
$selectAllCategoryQuery = mysqli_query($con, $selectAllLotCategory);
$selectAllCategoryQueryArr = mysqli_fetch_array($selectAllCategoryQuery, MYSQLI_ASSOC);

$title = "All Lots";


/*$selectCatId = "select id from lots where categoryid = ".$_GET['categoryid'];
$selectCatIdQuery = mysqli_query($con, $selectCatId );
$selectCatIdArr = mysqli_fetch_all($selectCatIdQuery, MYSQLI_ASSOC);

$bids = [];
foreach ($selectCatIdArr as $selectCatIdElem){
   $allCategoriesBids = "select count(id) from bids where lotid = ".$selectCatIdElem['id'];
    $allCategoriesBidsQuery = mysqli_query($con, $allCategoriesBids );
    $allCategoriesBidsArr = mysqli_fetch_all($allCategoriesBidsQuery, MYSQLI_ASSOC);
    array_push($bids, $allCategoriesBidsArr[0]["count(id)"]);
}*/




$content = include_template('all-lots.php', ['rowsСategories' => $rowsCategories, "allCategoriesLot" => $allCategoriesLot, "selectAllCategoryQueryArr" => $selectAllCategoryQueryArr, "postrow" => $postRow, "page" => $page, "total" => $total]);

$layoutContent = include_template('layout.php', ['rowsCategories'=>$rowsCategories, 'content' => $content, "title" => $title]);

print($layoutContent);
