<?php
session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$search = $_GET['search'];

$search = mysqli_real_escape_string($con, $search);

$querysearch = "SELECT img, symbol_code, name, lots.id, name_of_the_lot, start_price, date_of_creation, finish_date FROM lots JOIN categories ON lots.categoryid = categories.id WHERE MATCH(name_of_the_lot, deskription) AGAINST('$search') and current_timestamp<finish_date order by date_of_creation desc ";
$resultsearchquery = mysqli_query($con, $querysearch );
$resultsearch= mysqli_fetch_all($resultsearchquery, MYSQLI_ASSOC);
$results_per_page = 9;

$num_rows = round(ceil(count($resultsearch))/$results_per_page);

if (isset($_GET['page'])) {
    $nav = $_GET['page'];
    }
    else {
    $nav = 0;
    }
    $nav = intval($nav);

$content = include_template('search-lots.php', ['rowscategories'=>$rowscategories, 'resultsearch'=>$resultsearch, 'results_per_page'=>$results_per_page, 'num_rows'=>$num_rows, 'nav'=>$nav]);
$layout_content = include_template('layout.php', ['content' => $content, 'resultsearch'=>$resultsearch, 'title' => 'Главная', 'rowscategories' => $rowscategories]);
print($layout_content);
?>
