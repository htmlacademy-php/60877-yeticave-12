<?php
session_start();

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
$title = "Главная";

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$results_per_page = 9;
$page = 1;
if (isset ($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0) {
    $page = intval($_GET['page']);
 }

 $start = $page * $results_per_page - $results_per_page;

$search = mysqli_real_escape_string($con, $_GET['search']);

$countsql = "SELECT count(id) as count FROM lots
WHERE MATCH(name_of_the_lot, deskription) AGAINST('$search') and current_timestamp<finish_date";

$countsqlquery = mysqli_query($con, $countsql );
$countsqlresult= mysqli_fetch_array($countsqlquery, MYSQLI_ASSOC);

 $querysearch = "SELECT img, symbol_code, name, lots.id, name_of_the_lot,
 start_price, date_of_creation, finish_date
 FROM lots JOIN categories
 ON lots.categoryid = categories.id
 WHERE MATCH(name_of_the_lot, deskription) AGAINST('$search')
 and current_timestamp<finish_date order by date_of_creation desc limit $start, $results_per_page";

 $resultsearchquery = mysqli_query($con, $querysearch );
 $resultsearch= mysqli_fetch_all($resultsearchquery, MYSQLI_ASSOC);

 $total = ceil(($countsqlresult['count']) / $results_per_page);

if($page > $total) {
    $page = $total;
}

$content = include_template('search-lots.php', ['rowscategories'=>$rowscategories,
'resultsearch'=>$resultsearch, 'results_per_page'=>$results_per_page,
"page"=>$page, "total"=>$total]);

$layout_content = include_template('layout.php', ['content' => $content, 'resultsearch'=>$resultsearch, 'title' => 'Главная', 'rowscategories' => $rowscategories]);
print($layout_content);
?>
