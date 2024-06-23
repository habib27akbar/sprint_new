<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\RegistKlien;
use App\Models\RegistStatus;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get_klien(Request $request)
    {
        $klien = Klien::where('id_perusahaan', $request->id_perusahaan)->get();
        $regist = RegistKlien::where('id_perusahaan', $request->id_perusahaan)->get();
        $regist_status = RegistStatus::where('id_pelanggan', $request->id_perusahaan)->get();
        $from_data = '';
        if (count($regist) > 0) {
            $data_klien = $regist;
            $from_data =  'regist';
        } else {
            $data_klien = $klien;
            $from_data = 'klien';
        }
        //echo $klien;
        return response()->json(['status' => true, 'data' => $data_klien, 'data_regist' => $regist_status, 'from_data' => $from_data], 200);
    }
}
