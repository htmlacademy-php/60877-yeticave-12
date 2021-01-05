<?php
session_start();
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$querycategories = "Select id, name, symbol_code from categories";
$resultcategories = mysqli_query($con, $querycategories );
$rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);

$categoryid = $_GET['categoryid'];

/*пагинация*/
$countalllotscat = "select count(lots.id) from lots join categories on lots.categoryid = categories.id where categories.id = ".$categoryid;
$countalllotscatquery = mysqli_query($con, $countalllotscat );
$numberlotsfromcat = mysqli_fetch_all($countalllotscatquery, MYSQLI_ASSOC);

$num = 9;

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}
else {
    $page = 1;
}


$total = ceil($numberlotsfromcat[0]["count(lots.id)"] / $num);

if(empty($page) ||$page < 0) {
    $page = 1;
}

if($page > $total) {
    $page = $total;
}
$start = $page * $num - $num;


$querylot = "Select img, lots.id, name_of_the_lot, img, lots.deskription, categoryid, start_price, finish_date,
step_of_the_bid, name from lots join categories on lots.categoryid = categories.id
where categories.id = ".$categoryid." and finish_date >current_timestamp LIMIT $start, $num"  ;
$resultlot = mysqli_query($con, $querylot );
$allcategorieslot = mysqli_fetch_all($resultlot, MYSQLI_ASSOC);

while ( $postrow[] = mysqli_fetch_array($resultlot));

/*конец пагинации*/



$selectalllotcategory = "select name from categories where id = ".$categoryid;
$selectallcategoryquery = mysqli_query($con, $selectalllotcategory );
$selectallcategoryqueryarr = mysqli_fetch_array($selectallcategoryquery, MYSQLI_ASSOC);

$title = "Главная";



$content = include_template('all-lots.php', ['rowscategories'=>$rowscategories, "allcategorieslot"=>$allcategorieslot, "selectallcategoryqueryarr"=>$selectallcategoryqueryarr, "postrow"=>$postrow, "page"=>$page, "total"=>$total]);
$layout_content = include_template('layout.php', ['content' => $content, "title"=>$title, 'rowscategories' => $rowscategories]);

print($layout_content);
