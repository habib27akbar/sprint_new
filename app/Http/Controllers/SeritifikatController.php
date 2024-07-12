<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Sertifikat;
use Carbon\Carbon;

class SeritifikatController extends Controller
{
    public function index()
    {
        return view('master.sertifikat.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Sertifikat::select('mst_sertifikat.*', 'mst_klien.id_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.nama_perusahaan', 'mst_ruang_lingkup.nomor_standar', 'mst_ruang_lingkup.judul_standar', 'mst_skema_sertifikasi.nama_skema_sertifikasi', 'mst_produk.nama_produk')
                ->leftJoin('mst_klien', 'mst_sertifikat.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_ruang_lingkup', 'mst_sertifikat.id_ruang_lingkup', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_produk', 'mst_ruang_lingkup.id_produk', '=', 'mst_produk.id')
                ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id')
                ->get()
                ->map(function ($item) {
                    $item->full_nama_perusahaan = "{$item->id_perusahaan} {$item->jenis_badan_usaha} {$item->nama_perusahaan}";
                    $item->tanggal_terbit_raw = $item->tanggal_terbit ? \Carbon\Carbon::parse($item->tanggal_terbit)->format('Y-m-d') : null;
                    $item->tanggal_berakhir_raw = $item->tanggal_berakhir ? \Carbon\Carbon::parse($item->tanggal_berakhir)->format('Y-m-d') : null;
                    $item->tanggal_terbit = $item->tanggal_terbit ? \Carbon\Carbon::parse($item->tanggal_terbit)->format('d/m/Y') : null;
                    $item->tanggal_berakhir = $item->tanggal_berakhir ? \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d/m/Y') : null;
                    return $item;
                });;
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('sertifikat.edit', ['sertifikat' => $row->id]);
                    $deleteRoute = route('sertifikat.destroy', ['sertifikat' => $row->id]);
                    $btn = '<div class="btn-group">';
                    $btn .= '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</form>';
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');

        // Handle the custom attribute separately
        if ($column == 'full_nama_perusahaan') {
            $query = Sertifikat::select('mst_klien.id_perusahaan', 'mst_klien.jenis_badan_usaha', 'mst_klien.nama_perusahaan')
                ->leftJoin('mst_klien', 'mst_sertifikat.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_ruang_lingkup', 'mst_sertifikat.id_ruang_lingkup', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_produk', 'mst_ruang_lingkup.id_produk', '=', 'mst_produk.id')
                ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id');

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

            $uniqueValues = $query->distinct()->get()->map(function ($item) {
                return "{$item->id_perusahaan} {$item->jenis_badan_usaha} {$item->nama_perusahaan}";
            })->unique()->values();

            return response()->json($uniqueValues);
        } else {
            // Periksa dan tambahkan alias jika kolom yang diminta ambigu
            $column = $this->qualifyColumn($column);

            $query = Sertifikat::select($column)->distinct()
                ->leftJoin('mst_klien', 'mst_sertifikat.id_perusahaan', '=', 'mst_klien.id_perusahaan')
                ->leftJoin('mst_ruang_lingkup', 'mst_sertifikat.id_ruang_lingkup', '=', 'mst_ruang_lingkup.id')
                ->leftJoin('mst_produk', 'mst_ruang_lingkup.id_produk', '=', 'mst_produk.id')
                ->leftJoin('mst_skema_sertifikasi', 'mst_sertifikat.menu', '=', 'mst_skema_sertifikasi.id');

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
                if (isset($result->tanggal_terbit)) {
                    $result->tanggal_terbit = Carbon::parse($result->tanggal_terbit)->format('d/m/Y');
                }
                if (isset($result->tanggal_berakhir)) {
                    $result->tanggal_berakhir = Carbon::parse($result->tanggal_berakhir)->format('d/m/Y');
                }
            }

            $uniqueValues = $results->pluck($column);
            return response()->json($uniqueValues);
        }
    }


    private function qualifyColumn($column)
    {
        $ambiguousColumns = ['status', 'id']; // Tambahkan nama kolom lain yang mungkin ambigu di sini

        if (in_array($column, $ambiguousColumns)) {
            return 'mst_sertifikat.' . $column;
        }

        return $column;
    }

    public function create()
    {


        return view('master.sertifikat.create');
    }

    public function edit($id)
    {

        $data = Sertifikat::findOrFail($id);

        return view('master.sertifikat.edit', compact('data'));
    }

    public function store(Request $request)
    {

        $storeData = [

            'nama_tujuan_audit' => $request->input('nama_tujuan_audit'),
            'kode_audit' => $request->input('kode_audit'),
            'order' => $request->input('order'),
            'status' => $request->input('status'),
            'id_user' => Session::get('id_user'),

        ];
        Sertifikat::create($storeData);
        return redirect('sertifikat')->with('alert-success', 'Success Tambah Data');
    }

    public function update(Request $request, $id)
    {

        $updateData = [
            'nama_tujuan_audit' => $request->input('nama_tujuan_audit'),
            'kode_audit' => $request->input('kode_audit'),
            'order' => $request->input('order'),
            'status' => $request->input('status'),
            'id_user_update' => Session::get('id_user'),
        ];
        Sertifikat::where('id', $id)->update($updateData);
        return redirect('sertifikat')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        Sertifikat::findOrFail($id)->delete();
        return redirect('sertifikat')->with('alert-success', 'Success deleted data');
    }
}
