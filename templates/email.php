<?php require_once("../getwinner.php");?>

<?php
require_once '/path/to/vendor/autoload.php';
 try {
$transport = (new Swift_SmtpTransport('phpdemo.ru', 25))
        ->setUsername('keks@phpdemo.ru')
        ->setPassword('htmlacademy');
    $mailer = new Swift_Mailer($transport);
public function index($name, \Swift_Mailer $mailer)
{
 $message = (new Swift_Message())
 ->setSubject('	Ваша ставка победила')
->setFrom(['keks@phpdemo.ru'])
 ->setTo(['$getarrwinner["email"]' => 'New Mailtrap user']));
$message->setBody(
    '<html lang="ru">'.
    '<body>'.
'<h1>Поздравляем с победой</h1>' .
'<p>Здравствуйте, <?php echo $getarrwinner["name"];?></p> ' .
'<p>Ваша ставка для лота <a href="/lot.php?id=<?php echo $getarrwinner["lotsid"]; ?>">
    <?php echo $getarrwinner["name_of_the_lot"]; ?></a> победила.</p>' .
   '<p>Перейдите по ссылке <a href="/my-bets.php?id=<?php echo $getarrwinner["usersid"]; ?>">мои ставки</a>,
   чтобы связаться с автором объявления</p>' .
   '<small>Интернет Аукцион "YetiCave"</small>'.
   ' </body>' .
'</html>',
  'text/html'
);
$message->addPart('Welcome to Mailtrap, now your test emails will be safe', 'text/plain');
$message->attach(Swift_Attachment::fromPath('/path/to/confirmation.pdf'));
$mailer->send($message);
