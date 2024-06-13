<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KlienController extends Controller
{
    public function index()
    {
        return view('master.klien.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Klien::select('*')->orderBy('nama_perusahaan', 'ASC');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            //return Datatables::of($data)->make(true);
        }
    }

    public function show($id)
    {
        $klien = Klien::findOrFail($id);
        return view('klien.show', compact('klien'));
    }

    public function getUniqueValues(Request $request)
    {
        $column = $request->get('column');
        $query = Klien::select($column)->distinct();

        // Apply filters if provided
        if ($request->has('filtered') && $request->get('filtered') == 'true') {
            foreach ($request->get('filters') as $key => $value) {
                $query->where($key, $value);
            }
        }

        $uniqueValues = $query->pluck($column);
        return response()->json($uniqueValues);
    }
}
