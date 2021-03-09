<?php

session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = "Страница поиска";

$queryCategories = 'Select id, name, symbol_code from categories';
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$resultsPerPage = 9;

$page = 1;

if (isset ($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
}

$start = $page * $resultsPerPage - $resultsPerPage;

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
}

$countSql = "SELECT count(id) as count FROM lots WHERE MATCH(name_of_the_lot, deskription) AGAINST('$search') and current_timestamp < finish_date";

$countSqlQuery = mysqli_query($con, $countSql);
$countSqlResult = mysqli_fetch_array($countSqlQuery, MYSQLI_ASSOC);

$querySearch = "SELECT img, symbol_code, name, lots.id, name_of_the_lot, start_price, date_of_creation, finish_date FROM lots JOIN categories
 ON lots.categoryid = categories.id
 WHERE MATCH(name_of_the_lot, deskription) AGAINST('$search')
 and current_timestamp<finish_date order by date_of_creation desc limit $start, $resultsPerPage";
$resultSearchQuery = mysqli_query($con, $querySearch);
$resultSearch = mysqli_fetch_all($resultSearchQuery, MYSQLI_ASSOC);

if (isset($countSqlResult)) {
    $total = ceil(($countSqlResult['count']) / $resultsPerPage);
}

if ($page > $total) {
    $page = $total;
}

$content = include_template('search-lots.php', ['rowsCategories' => $rowsCategories, 'resultSearch' => $resultSearch, 'resultsPerPage' => $resultsPerPage, "page" => $page, "total" => $total]);
$layoutContent = include_template('layout.php', ['content' => $content, 'title' => $title, 'rowsCategories' => $rowsCategories]);

print($layoutContent);
