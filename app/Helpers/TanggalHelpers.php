<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class TanggalHelper
{
    function get_date($tanggal)
    {
        $explode = explode("-", $tanggal);
        if ($explode[1] == '01') {
            $get_date = $explode[2] . ' Januari ' . $explode[0];
        } else if ($explode[1] == '02') {
            $get_date = $explode[2] . ' Februari ' . $explode[0];
        } else if ($explode[1] == '03') {
            $get_date = $explode[2] . ' Maret ' . $explode[0];
        } else if ($explode[1] == '04') {
            $get_date = $explode[2] . ' April ' . $explode[0];
        } else if ($explode[1] == '05') {
            $get_date = $explode[2] . ' Mei ' . $explode[0];
        } else if ($explode[1] == '06') {
            $get_date = $explode[2] . ' Juni ' . $explode[0];
        } else if ($explode[1] == '07') {
            $get_date = $explode[2] . ' Juli ' . $explode[0];
        } else if ($explode[1] == '08') {
            $get_date = $explode[2] . ' Agustus ' . $explode[0];
        } else if ($explode[1] == '09') {
            $get_date = $explode[2] . ' September ' . $explode[0];
        } else if ($explode[1] == '10') {
            $get_date = $explode[2] . ' Oktober ' . $explode[0];
        } else if ($explode[1] == '11') {
            $get_date = $explode[2] . ' November ' . $explode[0];
        } else if ($explode[1] == '12') {
            $get_date = $explode[2] . ' Desember ' . $explode[0];
        }

        return $get_date;
    }

    function get_dateTime($tanggal)
    {
        $explode = explode(" ", $tanggal);
        $get_tgl = explode("-", $explode[0]);
        $get_date = $get_tgl[2] . '/' . $get_tgl[1] . '/' . $get_tgl[0] . ' ' . substr($explode[1], 0, 5);
        // if ($get_tgl[1] == '01') {
        //     $get_date = $get_tgl[2] . ' Januari ' . $get_tgl[0];
        // } else if ($get_tgl[1] == '02') {
        //     $get_date = $explode[2] . ' Februari ' . $explode[0];
        // } else if ($get_tgl[1] == '03') {
        //     $get_date = $explode[2] . ' Maret ' . $explode[0];
        // } else if ($get_tgl[1] == '04') {
        //     $get_date = $explode[2] . ' April ' . $explode[0];
        // } else if ($explode[1] == '05') {
        //     $get_date = $explode[2] . ' Mei ' . $explode[0];
        // } else if ($explode[1] == '06') {
        //     $get_date = $explode[2] . ' Juni ' . $explode[0];
        // } else if ($explode[1] == '07') {
        //     $get_date = $explode[2] . ' Juli ' . $explode[0];
        // } else if ($explode[1] == '08') {
        //     $get_date = $explode[2] . ' Agustus ' . $explode[0];
        // } else if ($explode[1] == '09') {
        //     $get_date = $explode[2] . ' September ' . $explode[0];
        // } else if ($explode[1] == '10') {
        //     $get_date = $explode[2] . ' Oktober ' . $explode[0];
        // } else if ($explode[1] == '11') {
        //     $get_date = $explode[2] . ' November ' . $explode[0];
        // } else if ($explode[1] == '12') {
        //     $get_date = $explode[2] . ' Desember ' . $explode[0];
        // }

        return $get_date;
    }
}
