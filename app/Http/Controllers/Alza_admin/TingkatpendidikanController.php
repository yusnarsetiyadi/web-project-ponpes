<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Tingkatpendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TingkatpendidikanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tingkatpendidikan-list|tingkatpendidikan-create|tingkatpendidikan-edit|tingkatpendidikan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tingkatpendidikan-create', ['only' => ['create','store']]);
         $this->middleware('permission:tingkatpendidikan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tingkatpendidikan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Tingkat Pendidikan";
        $pagination  = 10;
        $tingkatpendidikans = Tingkatpendidikan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($tingkatpendidikans->currentPage() - 1) * $tingkatpendidikans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tingkatpendidikans->count()) . " Data dari ". $tingkatpendidikans->total(). " Data";
        return view('alza_admin.alza_modul.tingkatpendidikan.index', compact('tingkatpendidikans', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Tingkat Pendidikan";

        return view('alza_admin.alza_modul.tingkatpendidikan.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Tingkatpendidikan::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'tingkatpendidikans.index')->with('success','Data berhasi diproses');
    }

    public function show(Tingkatpendidikan $tingkatpendidikan)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Tingkat Pendidikan";
        $tingkatpendidikan = Tingkatpendidikan::find($id);

        return view('alza_admin.alza_modul.tingkatpendidikan.edit',compact('title','tingkatpendidikan'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $tingkatpendidikan = Tingkatpendidikan::find($id);
        $tingkatpendidikan->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'tingkatpendidikans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Tingkatpendidikan $tingkatpendidikan)
    {
        $tingkatpendidikan->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'tingkatpendidikans.index')->with('success','Data berhasi diproses');
    }
}
