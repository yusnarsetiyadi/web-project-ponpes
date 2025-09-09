<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Kategorigaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KategorigaleriController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kategorigaleri-list|kategorigaleri-create|kategorigaleri-edit|kategorigaleri-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kategorigaleri-create', ['only' => ['create','store']]);
         $this->middleware('permission:kategorigaleri-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kategorigaleri-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Kategorigaleri";
        $pagination  = 10;
        $kategorigaleris = Kategorigaleri::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('judul', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($kategorigaleris->currentPage() - 1) * $kategorigaleris->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $kategorigaleris->count()) . " Data dari ". $kategorigaleris->total(). " Data";
        return view('alza_admin.alza_modul.kategorigaleri.index', compact('kategorigaleris', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Kategorigaleri";

        return view('alza_admin.alza_modul.kategorigaleri.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['seo' => 'required','judul' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Kategorigaleri::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategorigaleris.index')->with('success','Data berhasi diproses');
    }

    public function show(Kategorigaleri $kategorigaleri)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Kategorigaleri";
        $kategorigaleri = Kategorigaleri::find($id);

        return view('alza_admin.alza_modul.kategorigaleri.edit',compact('title','kategorigaleri'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['seo' => 'required','judul' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $kategorigaleri = Kategorigaleri::find($id);
        $kategorigaleri->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategorigaleris.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Kategorigaleri $kategorigaleri)
    {
        $kategorigaleri->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'kategorigaleris.index')->with('success','Data berhasi diproses');
    }
}
