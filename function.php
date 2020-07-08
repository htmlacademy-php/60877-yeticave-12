
<?php

  function formatPrice (int $sum){
  $ok_sum = ceil($sum);
    if ($ok_sum >= 1000){
      $ok_sum = number_format($ok_sum, 0, ' ', ' ');
    }
  $ok_sum = $ok_sum . " " . "₽";
  return $ok_sum;
}

function lefttotime ($dateleft) {

$now = time();

$futuretime = strtotime($dateleft);

$newtime = $futuretime - $now;

$minutes = $newtime/60;

$minutes = floor($minutes);

$hours = $newtime/3600;

$hours = floor($hours);

$result = [$hours, $minutes];

return $result;

}

?>
