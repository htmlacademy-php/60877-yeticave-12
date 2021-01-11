<?php require_once("../getwinner.php");?>

<?php
$winneremail = $getarrwinner["email"];
$winnername = $getarrwinner["name"];
$lot_id = $getarrwinner["lotsid"];
$name_winner_lot = $getarrwinner["name_of_the_lot"];
$winneruserid = $getarrwinner["usersid"];

require '../vendor/autoload.php';

    $transport = (new Swift_SmtpTransport('phpdemo.ru', 25))
    ->setUsername('keks@phpdemo.ru')
    ->setPassword('htmlacademy');
$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message())
->setSubject('	Ваша ставка победила')
->setFrom(['keks@phpdemo.ru'])
->setTo([$winneremail => 'Bid Winner from Yeticave']);
$message->setBody(
'<html lang="ru">'.
'<body>'.
'<h1>Поздравляем с победой</h1>' .
'<p>Здравствуйте, <?php echo '.$winnername.'?></p> ' .
'<p>Ваша ставка для лота <a href="/lot.php?id=<?php echo '.$lot_id.' ?>">
<?php echo '.$name_winner_lot.' ?></a> победила.</p>' .
'<p>Перейдите по ссылке <a href="/my-bets.php?id=<?php echo '.$winneruserid.' ?>">мои ставки</a>,
чтобы связаться с автором объявления</p>' .
'<small>Интернет Аукцион "YetiCave"</small>'.
' </body>' .
'</html>'
);
$message->addPart('Welcome to Mailtrap, now your test emails will be safe', 'text/html');
$mailer->send($message);


?>

