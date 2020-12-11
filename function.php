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
if ($newtime<0) {
return [ "00", "00"];
}
$hours = $newtime/3600;

$hours = floor($hours);
if ($hours <10) {
   $hours = "0".$hours;
}

$minutes = ceil((($futuretime - $hours * 3600) - $now) / 60);
if ($minutes <10) {
    $minutes = "0".$minutes;
 }
$result = [$hours, $minutes];

return $result;

}

