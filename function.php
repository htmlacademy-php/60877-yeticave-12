<?php

//форматирует цену и приводит ее к правильному формату согласно ТЗ
function formatPrice(int $sum)
{
    $ok_sum = ceil($sum);
    $ok_sum .= " ₽";
    return $ok_sum;
}

//определяет сколько осталось к нужной дате
function lefttotime($dateleft)
{

    $now = time();

    $futuretime = strtotime($dateleft);

    $newtime = $futuretime - $now;
    if ($newtime < 0) {
        return ["00", "00"];
    }
    $hours = $newtime / 3600;

    $hours = floor($hours);
    if ($hours < 10) {
        $hours = "0" . $hours;
    }

    $minutes = ceil((($futuretime - $hours * 3600) - $now) / 60);
    if ($minutes < 10) {
        $minutes = "0" . $minutes;
    }
    return [$hours, $minutes];

}

function throwForbiddenError()
{
    header("HTTP/1.0 403 Forbidden");
    return;
}

