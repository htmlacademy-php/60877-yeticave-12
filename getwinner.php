<?php

require_once('vendor/autoload.php');

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$getWinner = 'SELECT lots.id AS lotsid, lots.name_of_the_lot, bids.id AS bidsid, users.id AS usersid,
users.email, bids.date, users.name, summary_of_the_lot FROM lots JOIN users
ON lots.authorid = users.id JOIN bids ON lots.id = bids.lotid WHERE winnerid IS NULL
AND finish_date < current_timestamp ORDER BY bids.date DESC LIMIT 1';

$queryGetWinner = mysqli_query($con, $getWinner);

$getArrWinner = mysqli_fetch_array($queryGetWinner, MYSQLI_ASSOC);

if (isset($getArrWinner)) {
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
        ->setBody(include_template('email.php', ["winnerName" => $winnerName, "lotId" => $lotId, "nameWinnerLot" => $nameWinnerLot, "winnerUserId" => $winnerUserId]));
    $message->addPart('Welcome to Mailtrap, now your test emails will be safe', 'text/html');
    $result = $mailer->send($message);
}



