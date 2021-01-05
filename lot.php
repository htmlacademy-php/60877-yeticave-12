<?php
session_start();
date_default_timezone_set('Europe/Kiev');
require_once("connection.php");
require_once("helpers.php");
require_once("function.php");

$title = "Главная";
$userid = $_SESSION['iduser']??NULL;

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $querysumlot = "Select max(summary_of_the_lot) from bids where bids.lotid = ".$id;
    $querysumlottodb = mysqli_query($con, $querysumlot);
    $querysumlottodbfinal= mysqli_fetch_array($querysumlottodb, MYSQLI_ASSOC);



    if (isset($_GET['id'])) {
      $querycategories = "Select id, name, symbol_code from categories";
      $resultcategories = mysqli_query($con, $querycategories );
      $rowscategories= mysqli_fetch_all($resultcategories, MYSQLI_ASSOC);
      $querylot = "Select name_of_the_lot, img, lots.deskription, categoryid, start_price, finish_date, step_of_the_bid, name from lots join categories on lots.categoryid = categories.id where lots.id = ".$id;
      $resultlot = mysqli_query($con, $querylot );
      $onelot = mysqli_fetch_array($resultlot, MYSQLI_ASSOC);

    $thehistoryofbidssum= "select * FROM bids where bids.lotid = ".$id;
    $resultthehistoryofbidsum = mysqli_query($con, $thehistoryofbidssum );
    $rowshistorysum= mysqli_fetch_all($resultthehistoryofbidsum, MYSQLI_ASSOC);

    $thehistoryofbids= "Select bids.id, date, summary_of_the_lot, name from bids JOIN users ON bids.userid = users.id where bids.lotid = ".$id;
    $resultthehistoryofbids = mysqli_query($con, $thehistoryofbids );
    $rowshistory= mysqli_fetch_all($resultthehistoryofbids, MYSQLI_ASSOC);

    if (!$onelot) {
        header('Location: /404.php');
        die();
    }

  }

$errors = [];
$sendbid = $_POST['send_bid']??NULL;
  if ($sendbid) {
    $cost  = $_POST['cost'];

    if (empty($cost)) {
        $errors['wrongbet'] = "Поле ставки пустое";
    }
    else {
        $lotid = $_GET['id'];

        $insertintodb = "INSERT INTO bids (date, summary_of_the_lot, userid, lotid ) VALUES (current_timestamp, $cost, '$userid', $lotid )";
        $insertintodbquery = mysqli_query($con, $insertintodb);
if (!$insertintodbquery) {
  echo "Запрос не добавил ставку!!";
}
        header("Location: my-bets.php/?id=".$lotid);
    }
    }
        $content = include_template('lot.php', ['rowscategories'=>$rowscategories, 'querysumlottodbfinal' => $querysumlottodbfinal, 'onelot'=>$onelot, 'rowshistorysum'=>$rowshistorysum, 'rowshistory'=>$rowshistory, 'errors'=>$errors]);
        $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Главная', 'rowscategories' => $rowscategories]);
        print($layout_content);
?>
