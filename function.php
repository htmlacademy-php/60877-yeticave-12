
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

$now = strtotime("now");

$futuretime = strtotime($dateleft);

$newtime = $futuretime - $now;
$hours = $newtime/3600;

$hours = floor($hours);
if ($hours <10) {
   $hours = "0".$hours;
}
$minutes = floor((($futuretime - $hours * 3600) - $now) / 60);



$result = [$hours, $minutes];

return $result;

}

?>
