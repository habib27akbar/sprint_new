<?php

namespace App\Http\Controllers;

use App\Models\PerjanjianSertifikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class PerjanjianSertifikasiController extends Controller
{
    public function index()
    {
        return view('perjanjian_sertifikasi.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = PerjanjianSertifikasi::select('*');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('perjanjian_sertifikasi.edit', ['perjanjian_sertifikasi' => $row->id]);
                    $deleteRoute = route('perjanjian_sertifikasi.destroy', ['perjanjian_sertifikasi' => $row->id]);

                    $btn = '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</form>';

                    return $btn;
                })
                ->addColumn('dokumen', function ($row) {
                    $url = url('public/doc/draft/' . $row->perjanjian_sertifikasi_klien);
                    return '<a href="' . $url . '" target="_blank">File</a>';
                })
                ->rawColumns(['action', 'dokumen'])
                ->make(true);
        }
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');
        $query = PerjanjianSertifikasi::select($column)->distinct();

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

        $uniqueValues = $query->pluck($column);
        return response()->json($uniqueValues);
    }

    public function create()
    {



        return view('perjanjian_sertifikasi.create');
    }

    public function edit($id)
    {

        $data = PerjanjianSertifikasi::findOrFail($id);


        return view('perjanjian_sertifikasi.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $nama_file = null;
        if ($request->file('file')) {
            $file = $request->file('file');
            $nama_file = 'draft-' . uniqid() . '-' . $file->getClientOriginalName();
            $dir = 'doc/draft';
            $file->move(public_path($dir), $nama_file);
        }
        $storeData = [
            'id_perusahaan' => Session::get('id_perusahaan'),
            'jenis_sertifikasi' => $request->input('jenis_sertifikasi'),
            'perjanjian_sertifikasi_klien' => $nama_file,
            'nomor' => $request->input('nomor'),
            'status' => 'Draft'
        ];
        PerjanjianSertifikasi::create($storeData);
        return redirect('perjanjian_sertifikasi')->with('alert-success', 'Success Tambah Data');
    }

    public function update(Request $request, $id)
    {

        $nama_file = $request->input('file_old');
        if ($request->file('file')) {
            $file = $request->file('file');
            $nama_file = 'draft-' . uniqid() . '-' . $file->getClientOriginalName();
            $dir = 'doc/draft';
            $file->move(public_path($dir), $nama_file);
        }
        $updateData = [
            'id_perusahaan' => Session::get('id_perusahaan'),
            'jenis_sertifikasi' => $request->input('jenis_sertifikasi'),
            'perjanjian_sertifikasi_klien' => $nama_file,
            'nomor' => $request->input('nomor'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            'status' => $request->input('status')
        ];
        PerjanjianSertifikasi::where('id', $id)->update($updateData);
        return redirect('perjanjian_sertifikasi')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        PerjanjianSertifikasi::findOrFail($id)->delete();
        return redirect('perjanjian_sertifikasi')->with('alert-success', 'Success deleted data');
    }
}
