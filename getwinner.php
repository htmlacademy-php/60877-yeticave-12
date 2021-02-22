<?php

require_once('vendor/autoload.php');

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");


/*определение победителей лотов*/
$getWinner = 'select lots.id as lotsid, lots.name_of_the_lot, bids.id as bidsid, users.id as usersid,
 users.email, bids.date, users.name, summary_of_the_lot from lots join users
on lots.authorid = users.id join bids on lots.id = bids.lotid where winnerid is null
and finish_date < current_timestamp order by bids.date desc limit 1';

$queryGetWinner = mysqli_query($con, $getWinner);

$getArrWinner = mysqli_fetch_array($queryGetWinner, MYSQLI_ASSOC);

/*конец определения победителей лотов*/

if ($getArrWinner) {
    $winnerId = $getArrWinner['usersid'];
    $lotsId = $getArrWinner['lotsid'];
    $insertWinner = "UPDATE lots SET winnerid = " . $winnerId . " WHERE lots.id =" . $lotsId;
    $insertWinnerQuery = mysqli_query($con, $insertWinner);
    $winnerEmail = $getArrWinner["email"];
$winnerName = $getArrWinner["name"];
$lotId = $getArrWinner["lotsid"];
$nameWinnerLot = $getArrWinner["name_of_the_lot"];
$winnerUserId = $getArrWinner["usersid"];
$transport = (new Swift_SmtpTransport('phpdemo.ru', 25))
    ->setUsername('keks@phpdemo.ru')
    ->setPassword('htmlacademy');
$mailer = new Swift_Mailer($transport);
$message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['keks@phpdemo.ru' => 'John Doe'])
    ->setTo([$winnerEmail => 'Bid Winner from Yeticave'])
    ->setBody(include_template('email.php', ["winnerName"=>$winnerName, "lotId"=>$lotId, "nameWinnerLot" => $nameWinnerLot, "winnerUserId"=>$winnerUserId]));
        $message->addPart('Welcome to Mailtrap, now your test emails will be safe', 'text/html');
$result = $mailer->send($message);
}



