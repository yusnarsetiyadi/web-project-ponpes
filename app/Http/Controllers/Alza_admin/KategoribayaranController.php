<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Kategoribayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KategoribayaranController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kategoribayaran-list|kategoribayaran-create|kategoribayaran-edit|kategoribayaran-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kategoribayaran-create', ['only' => ['create','store']]);
         $this->middleware('permission:kategoribayaran-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kategoribayaran-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Kategoribayaran";
        $pagination  = 10;
        $kategoribayarans = Kategoribayaran::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama', 'like', "%{$request->keyword}%")->where('nominal', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($kategoribayarans->currentPage() - 1) * $kategoribayarans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $kategoribayarans->count()) . " Data dari ". $kategoribayarans->total(). " Data";
        return view('alza_admin.alza_modul.kategoribayaran.index', compact('kategoribayarans', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Kategoribayaran";

        return view('alza_admin.alza_modul.kategoribayaran.create',compact('title'));
    }

    public function store(Request $request)
    {
        
        Kategoribayaran::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategoribayarans.index')->with('success','Data berhasi diproses');
    }

    public function show(Kategoribayaran $kategoribayaran)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Kategoribayaran";
        $kategoribayaran = Kategoribayaran::find($id);

        return view('alza_admin.alza_modul.kategoribayaran.edit',compact('title','kategoribayaran'));
    }

    public function update(Request $request, $id)
    {
        
        $kategoribayaran = Kategoribayaran::find($id);
        $kategoribayaran->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kategoribayarans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Kategoribayaran $kategoribayaran)
    {
        $kategoribayaran->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'kategoribayarans.index')->with('success','Data berhasi diproses');
    }
}
