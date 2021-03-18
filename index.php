<?php

session_start();
require_once("timezone.php");

require_once("connection.php");
require_once("helpers.php");
require_once("function.php");
require_once("getwinner.php");

$queryLots = 'SELECT
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
WHERE l.`finish_date` > CURTIME()
GROUP BY l.`id`
ORDER BY l.`id` DESC';

$resultLots = mysqli_query($con, $queryLots);
$rowsLots = mysqli_fetch_all($resultLots, MYSQLI_ASSOC);

$queryCategories = "SELECT categories.id, name, symbol_code FROM categories";
$resultCategories = mysqli_query($con, $queryCategories);
$rowsCategories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);

$title = "Главная";
$content = include_template('main.php', ['rowsCategories' => $rowsCategories, 'rowsLots' => $rowsLots, 'resultlots' => $resultLots]);

$layoutContent = include_template('layout.php', ['rowsCategories' => $rowsCategories, 'content' => $content, 'title' => 'Главная']);

print($layoutContent);
