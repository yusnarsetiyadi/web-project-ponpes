<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Pendidikanakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PendidikanakhirController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pendidikanakhir-list|pendidikanakhir-create|pendidikanakhir-edit|pendidikanakhir-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pendidikanakhir-create', ['only' => ['create','store']]);
         $this->middleware('permission:pendidikanakhir-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pendidikanakhir-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Pendidikan Akhir";
        $pagination  = 10;
        $pendidikanakhirs = Pendidikanakhir::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_sekolah', 'like', "%{$request->keyword}%")->where('tahun_lulus', 'like', "%{$request->keyword}%")->where('nilai_rata_rata', 'like', "%{$request->keyword}%");
            })
            ->where('santri_id','=',$request->santri)
            ->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($pendidikanakhirs->currentPage() - 1) * $pendidikanakhirs->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $pendidikanakhirs->count()) . " Data dari ". $pendidikanakhirs->total(). " Data";
        return view('alza_admin.alza_modul.pendidikanakhir.index', compact('pendidikanakhirs', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Pendidikan Akhir";

        return view('alza_admin.alza_modul.pendidikanakhir.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['santri_id' => 'required','nama_sekolah' => 'required','tahun_lulus' => 'required','nilai_rata_rata' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Pendidikanakhir::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'pendidikanakhirs.index',['santri'=>$request->santri_id])->with('success','Data berhasi diproses');
    }

    public function show(Pendidikanakhir $pendidikanakhir)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Pendidikan Akhir";
        $pendidikanakhir = Pendidikanakhir::find($id);

        return view('alza_admin.alza_modul.pendidikanakhir.edit',compact('title','pendidikanakhir'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['santri_id' => 'required','nama_sekolah' => 'required','tahun_lulus' => 'required','nilai_rata_rata' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $pendidikanakhir = Pendidikanakhir::find($id);
        $pendidikanakhir->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'pendidikanakhirs.index',['santri'=>$request->santri_id])->with('success','Data berhasi diproses');
    }

    public function destroy(Pendidikanakhir $pendidikanakhir)
    {
        $pendidikanakhir->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'pendidikanakhirs.index',['santri'=>$pendidikanakhir->santri_id])->with('success','Data berhasi diproses');
    }
}
