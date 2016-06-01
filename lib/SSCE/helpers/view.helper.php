<?php
namespace SSCE\H;

function date2ru($string, $bTime = false){
    $aMonths    = array(1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
    $iTime      = strtotime($string);
    return ($bTime?date('H:i', $iTime).', ':'').date('j ', $iTime).$aMonths[ (int)date('n', $iTime) ].' '.(int)date('Y', $iTime).'г.';
}

function date2en($string, $bTime = false){
    $iTime      = strtotime($string);
    return ($bTime?date('g:i a', $iTime).'; ':'').date('F d, Y', $iTime);
}

function getImageCount($sTitle){
    $iCnt = preg_match('/\((\d+)\)$/', $sTitle, $aMatches);
    return $iCnt ? $aMatches[1] : 0;
}