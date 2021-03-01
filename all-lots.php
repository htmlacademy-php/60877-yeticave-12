<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
require_once("timezone.php");

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$categoryId = '';

if (isset($_GET['categoryid'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['categoryid']);
}

$countAllLotsCat = "select count(lots.id) as count from lots join categories on lots.categoryid = categories.id where categories.id = " . $categoryId;
$countAllLotsCatQuery = mysqli_query($con, $countAllLotsCat);
$numberLotsFromCat = mysqli_fetch_array($countAllLotsCatQuery, MYSQLI_ASSOC);

$num = 9;

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

$total = 0;

if (isset($numberLotsFromCat["count"])) {
    $total = ceil($numberLotsFromCat["count"] / $num);
}


if (empty($page) || $page < 0) {
    $page = 1;
}

if ($page > $total) {
    $page = $total;
}
$start = $page * $num - $num;

$nowSql = time();

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
WHERE l.`finish_date` > CURTIME() AND l.categoryid=' . $categoryId . '
GROUP BY l.`id`
ORDER BY l.`id` DESC LIMIT ' . $start . ', ' . $num . '';

$resultLot = mysqli_query($con, $queryLot);
$allCategoriesLot = mysqli_fetch_all($resultLot, MYSQLI_ASSOC);

while ($postRow[] = mysqli_fetch_array($resultLot)) {
}

$selectAllLotCategory = "select name from categories where id = " . $categoryId;
$selectAllCategoryQuery = mysqli_query($con, $selectAllLotCategory);
$selectAllCategoryQueryArr = mysqli_fetch_array($selectAllCategoryQuery, MYSQLI_ASSOC);

$title = "All Lots";

$content = include_template('all-lots.php', ['rowsСategories' => $rowsCategories, "allCategoriesLot" => $allCategoriesLot, "selectAllCategoryQueryArr" => $selectAllCategoryQueryArr, "postrow" => $postRow, "page" => $page, "total" => $total]);

$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, "title" => $title]);

print($layoutContent);
