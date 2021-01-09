<?php
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
/*определение победителей лотов*/
$getwinner = "select lots.id as lotsid, lots.name_of_the_lot, bids.id as bidsid, users.id as usersid, users.email, bids.date, users.name, summary_of_the_lot from lots join users
on lots.authorid = users.id join bids on lots.id = bids.lotid where winnerid is null
and finish_date < current_timestamp order by bids.date desc limit 1";
$querygetwinner = mysqli_query($con, $getwinner );
$getarrwinner = mysqli_fetch_array($querygetwinner, MYSQLI_ASSOC);
/*конец определения победителей лотов*/

$winnerid = $getarrwinner['usersid'];

$lotsid = $getarrwinner['lotsid'];

if (!!$querygetwinner) {
    $insertwinner = "UPDATE lots SET winnerid = ".$winnerid." WHERE lots.id =".$lotsid;
    $insertwinnerquery= mysqli_query($con, $insertwinner );
}


