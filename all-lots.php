<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
require_once("timezone.php");

$queryCategories = 'SELECT id, name, symbol_code FROM categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

if (isset($_GET['categoryid'])) {
    $categoryId = mysqli_real_escape_string($con, $_GET['categoryid']);
} elseif (empty($_GET['categoryid'])) {
    header("Location: 404.php");
}

$countAllLotsCat = "SELECT count(lots.id) AS count FROM lots JOIN categories ON lots.categoryid = categories.id WHERE categories.id = " . $categoryId;
$countAllLotsCatQuery = mysqli_query($con, $countAllLotsCat);
$numberLotsFromCat = mysqli_fetch_array($countAllLotsCatQuery, MYSQLI_ASSOC);

$num = 9;

$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}

$total = 0;
if (isset($numberLotsFromCat["count"])) {
    $total = ceil($numberLotsFromCat["count"] / $num);
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

$selectAllLotCategory = "SELECT name FROM categories WHERE id = " . $categoryId;
$selectAllCategoryQuery = mysqli_query($con, $selectAllLotCategory);
$selectAllCategoryQueryArr = mysqli_fetch_array($selectAllCategoryQuery, MYSQLI_ASSOC);

$title = "All Lots";

$content = include_template('all-lots.php', ['rowsСategories' => $rowsCategories, "allCategoriesLot" => $allCategoriesLot, "selectAllCategoryQueryArr" => $selectAllCategoryQueryArr, "postrow" => $postRow, "page" => $page, "total" => $total]);

$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, "title" => $title]);

print($layoutContent);
