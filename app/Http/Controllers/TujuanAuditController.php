<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TujuanAudit;

class TujuanAuditController extends Controller
{
    public function index()
    {
        return view('master.tujuan_audit.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = TujuanAudit::select('*');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $editRoute = route('tujuan_audit.edit', ['tujuan_audit' => $row->id]);
                    $deleteRoute = route('tujuan_audit.destroy', ['tujuan_audit' => $row->id]);

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
        $query = TujuanAudit::select($column)->distinct();

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


        return view('master.tujuan_audit.create');
    }

    public function edit($id)
    {

        $data = TujuanAudit::findOrFail($id);

        return view('master.tujuan_audit.edit', compact('data'));
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
        TujuanAudit::create($storeData);
        return redirect('tujuan_audit')->with('alert-success', 'Success Tambah Data');
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
        TujuanAudit::where('id', $id)->update($updateData);
        return redirect('tujuan_audit')->with('alert-success', 'Success Update Data');
    }

    public function destroy($id)
    {
        TujuanAudit::findOrFail($id)->delete();
        return redirect('tujuan_audit')->with('alert-success', 'Success deleted data');
    }
}
