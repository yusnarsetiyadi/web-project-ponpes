<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JurusanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jurusan-list|jurusan-create|jurusan-edit|jurusan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jurusan-create', ['only' => ['create','store']]);
         $this->middleware('permission:jurusan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jurusan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Jurusan";
        $pagination  = 10;
        $jurusans = Jurusan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($jurusans->currentPage() - 1) * $jurusans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $jurusans->count()) . " Data dari ". $jurusans->total(). " Data";
        return view('alza_admin.alza_modul.jurusan.index', compact('jurusans', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Jurusan";

        return view('alza_admin.alza_modul.jurusan.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Jurusan::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jurusans.index')->with('success','Data berhasi diproses');
    }

    public function show(Jurusan $jurusan)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Jurusan";
        $jurusan = Jurusan::find($id);

        return view('alza_admin.alza_modul.jurusan.edit',compact('title','jurusan'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $jurusan = Jurusan::find($id);
        $jurusan->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jurusans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'jurusans.index')->with('success','Data berhasi diproses');
    }
}
