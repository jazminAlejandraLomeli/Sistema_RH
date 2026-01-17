<?php

namespace App\Services;

 use App\Models\Cumpleanos;

class   HbdSentService
{


    public static function getdata($today)
    {
        $isSent = Cumpleanos::where('fecha', $today)->get();

        if ($isSent) {
            return false;
        } else {
            return true;
        }
    }
}
