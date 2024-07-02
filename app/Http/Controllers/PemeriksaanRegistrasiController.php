<?php

namespace App\Http\Controllers;

use App\Models\RegistStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PemeriksaanRegistrasiController extends Controller
{
    public function index()
    {
        return view('pemeriksaan_registrasi.index');
    }

    public function edit($id)
    {

        $data = RegistStatus::select('regist_status.*', 'mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan')
            ->join('mst_klien', 'regist_status.id_pelanggan', '=', 'mst_klien.id_perusahaan')
            ->where('regist_status.id', $id)
            ->firstOrFail();
        return view('pemeriksaan_registrasi.edit', compact('data'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = RegistStatus::select('regist_status.*', 'mst_klien.id_perusahaan', 'mst_klien.nama_perusahaan')
                ->join('mst_klien', 'regist_status.id_pelanggan', '=', 'mst_klien.id_perusahaan')
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('pemeriksaan_regist.edit', ['pemeriksaan_regist' => $row->id]);
                    //$deleteRoute = route('perjanjian_sertifikasi.destroy', ['perjanjian_sertifikasi' => $row->id]);

                    $btn = '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show()
    {
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');
        $query = RegistStatus::select($column)->distinct()
            ->join('mst_klien', 'regist_status.id_pelanggan', '=', 'mst_klien.id_perusahaan');

        // Apply filters if provided
        if ($request->has('filtered') && $request->get('filtered') == 'true') {
            if ($request->get('filters')) {
                foreach ($request->get('filters') as $key => $value) {
                    if (!empty($value)) {
                        $query->where($key, $value);
                    }
                }
            }
        }

        $results = $query->get();

        // Format date fields if they exist in the results
        foreach ($results as $result) {
            if (isset($result->tanggal_pengajuan)) {
                $result->tanggal_pengajuan = Carbon::parse($result->tanggal_pengajuan)->format('d/m/Y');
            }
            if (isset($result->tanggal_selesai)) {
                $result->tanggal_selesai = Carbon::parse($result->tanggal_selesai)->format('d/m/Y');
            }
        }

        $uniqueValues = $results->pluck($column);
        return response()->json($uniqueValues);
    }

    public function update(Request $request, $id)
    {
        $updateData = [
            'id_pelanggan' => $request->input('id_pelanggan'),
            'tanggal_pengajuan' => $request->input('tanggal_pengajuan'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'catatan' => $request->input('catatan'),
            'status' => $request->input('status')
        ];
        RegistStatus::where('id', $id)->update($updateData);
        return redirect('pemeriksaan_regist')->with('alert-success', 'Success Update Data');
    }
}
