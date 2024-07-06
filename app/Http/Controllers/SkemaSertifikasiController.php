<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SkemaSertifikasiController extends Controller
{
    public function index()
    {
        return view('master.skema_sertifikasi.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = SkemaSertifikasi::select('*');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('skema_sertifikasi.edit', ['skema_sertifikasi' => $row->id]);
                    $deleteRoute = route('skema_sertifikasi.destroy', ['skema_sertifikasi' => $row->id]);

                    $btn = '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');
        $query = SkemaSertifikasi::select($column)->distinct();

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


        return view('master.skema_sertifikasi.create');
    }

    public function edit($id)
    {

        $data = SkemaSertifikasi::findOrFail($id);

        return view('master.skema_sertifikasi.edit', compact('data'));
    }

    public function store(Request $request)
    {

        $storeData = [

            'kode_skema_sertifikasi' => $request->input('kode_skema_sertifikasi'),
            'nama_skema_sertifikasi' => $request->input('nama_skema_sertifikasi'),
            'kode_no_order' => $request->input('kode_no_order'),
            'order' => $request->input('order'),
            'status' => $request->input('status'),
            'id_user' => Session::get('id_user'),

        ];
        SkemaSertifikasi::create($storeData);
        return redirect('skema_sertifikasi')->with('alert-success', 'Success Tambah Data');
    }

    public function update(Request $request, $id)
    {

        $updateData = [
            'kode_skema_sertifikasi' => $request->input('kode_skema_sertifikasi'),
            'nama_skema_sertifikasi' => $request->input('nama_skema_sertifikasi'),
            'kode_no_order' => $request->input('kode_no_order'),
            'order' => $request->input('order'),
            'status' => $request->input('status'),
            'id_user_update' => Session::get('id_user'),
        ];
        SkemaSertifikasi::where('id', $id)->update($updateData);
        return redirect('skema_sertifikasi')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        SkemaSertifikasi::findOrFail($id)->delete();
        return redirect('skema_sertifikasi')->with('alert-success', 'Success deleted data');
    }
}
