<?php

namespace App\Http\Controllers;

use App\Models\ProsesLain;
use App\Models\TujuanAudit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProsesLainController extends Controller
{
    public function index()
    {
        return view('master.proses_lain.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = ProsesLain::select('mst_proses_lain.*', 'mst_tujuan_audit.nama_tujuan_audit')
                ->leftJoin('mst_tujuan_audit', 'mst_proses_lain.id_tujuan_audit', '=', 'mst_tujuan_audit.id')
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('proses_lain.edit', ['proses_lain' => $row->id]);
                    $deleteRoute = route('proses_lain.destroy', ['proses_lain' => $row->id]);

                    $btn = '<a href="' . $editRoute . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>';
                    $btn .= '<form method="POST" action="' . $deleteRoute . '" style="display: inline-block; margin-left: 10px;" onsubmit="return confirm(\'Apakah anda yakin?\')">';
                    $btn .= '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>';
                    $btn .= csrf_field(); // Blade directive for CSRF token
                    $btn .= method_field("DELETE"); // Blade directive for HTTP method spoofing
                    $btn .= '</form>';

                    return $btn;
                    //return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');

        // Periksa dan tambahkan alias jika kolom yang diminta ambigu
        $column = $this->qualifyColumn($column);

        $query = ProsesLain::select($column)->distinct()
            ->leftJoin('mst_tujuan_audit', 'mst_proses_lain.id_tujuan_audit', '=', 'mst_tujuan_audit.id');

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

    private function qualifyColumn($column)
    {
        $ambiguousColumns = ['status', 'id']; // Tambahkan nama kolom lain yang mungkin ambigu di sini

        if (in_array($column, $ambiguousColumns)) {
            return 'mst_proses_lain.' . $column;
        }

        return $column;
    }

    public function create()
    {
        $tujuan_audit = TujuanAudit::all();
        return view('master.proses_lain.create', compact('tujuan_audit'));
    }

    public function edit($id)
    {
        $tujuan_audit = TujuanAudit::all();
        $data = ProsesLain::findOrFail($id);
        return view('master.proses_lain.edit', compact('data', 'tujuan_audit'));
    }

    public function store(Request $request)
    {

        $storeData = [

            'id_tujuan_audit' => $request->input('id_tujuan_audit'),
            'nama_proses' => $request->input('nama_proses'),
            'status' => $request->input('status'),
            'id_user' => Session::get('id_user'),

        ];
        ProsesLain::create($storeData);
        return redirect('proses_lain')->with('alert-success', 'Success Tambah Data');
    }

    public function update(Request $request, $id)
    {

        $updateData = [
            'id_tujuan_audit' => $request->input('id_tujuan_audit'),
            'nama_proses' => $request->input('nama_proses'),
            'status' => $request->input('status'),
            'id_user_update' => Session::get('id_user'),
        ];
        ProsesLain::where('id', $id)->update($updateData);
        return redirect('proses_lain')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        ProsesLain::findOrFail($id)->delete();
        return redirect('proses_lain')->with('alert-success', 'Success deleted data');
    }
}
