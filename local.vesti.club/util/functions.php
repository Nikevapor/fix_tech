<?php
function get_day_name($timestamp) {

    $date = date('d/m/Y', $timestamp);

    if($date == date('d/m/Y')) {
        $date = 'Сегодня';
    }
    elseif($date == date('d/m/Y',time() - (24 * 60 * 60))) {
        $date = 'Вчера';
    }
    return $date;
}