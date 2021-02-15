        <html lang="ru">
         <body>
        <h1>Поздравляем с победой</h1>
        <p>Здравствуйте, <?php echo  $winnerName; ?></p>
        <p>Ваша ставка для лота <a href="/lot.php?id=<?php echo $lotId; ?>">
<?php echo $nameWinnerLot; ?></a> победила.</p>
        <p>Перейдите по ссылке <a href="/my-bets.php?id=<?php echo $winnerUserId; ?>">мои ставки</a>
чтобы связаться с автором объявления</p>
        <small>Интернет Аукцион "YetiCave"</small>
         </body>
        </html>
