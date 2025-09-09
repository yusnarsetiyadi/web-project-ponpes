<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kategori-list|kategori-create|kategori-edit|kategori-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kategori-create', ['only' => ['create','store']]);
         $this->middleware('permission:kategori-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kategori-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Kategori";
        $pagination  = 10;
        $kategoris = Kategori::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('nama', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($kategoris->currentPage() - 1) * $kategoris->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $kategoris->count()) . " Data dari ". $kategoris->total(). " Data";
        return view('alza_admin.alza_modul.kategori.index', compact('kategoris', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Kategori";

        return view('alza_admin.alza_modul.kategori.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Kategori::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategoris.index')->with('success','Data berhasi diproses');
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Kategori";
        $kategori = Kategori::find($id);

        return view('alza_admin.alza_modul.kategori.edit',compact('title','kategori'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['nama' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategoris.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'kategoris.index')->with('success','Data berhasi diproses');
    }
}
