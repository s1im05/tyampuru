<?php
namespace SSCE\Controllers\Helpers;

function prepareTags($sTags) {
    if ($aTags  = explode("\n", $sTags)) {
        foreach ($aTags as $iKey    => $sVal) {
            $sStr           = mb_strtolower(trim($sVal),'utf8');
            $aTags[$iKey]   = array($sStr, preg_replace('/\s+/', '_', $sStr));
            if ($sStr == '') {
                unset($aTags[$iKey]);
            }
        }
    }
    return $aTags;
}