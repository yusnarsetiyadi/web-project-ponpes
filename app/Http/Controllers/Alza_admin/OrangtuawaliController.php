<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Orangtuawali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrangtuawaliController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:orangtuawali-list|orangtuawali-create|orangtuawali-edit|orangtuawali-delete', ['only' => ['index','show']]);
         $this->middleware('permission:orangtuawali-create', ['only' => ['create','store']]);
         $this->middleware('permission:orangtuawali-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:orangtuawali-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Orang tua wali";
        $pagination  = 10;
        $orangtuawalis = Orangtuawali::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama', 'like', "%{$request->keyword}%")->where('pekerjaan', 'like', "%{$request->keyword}%")->where('penghasilan_perbulan', 'like', "%{$request->keyword}%")->where('kontak', 'like', "%{$request->keyword}%");
            })->where('santri_id','=',$request->santri)->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($orangtuawalis->currentPage() - 1) * $orangtuawalis->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $orangtuawalis->count()) . " Data dari ". $orangtuawalis->total(). " Data";
        return view('alza_admin.alza_modul.orangtuawali.index', compact('orangtuawalis', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Orang tua wali";
        return view('alza_admin.alza_modul.orangtuawali.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['santri_id' => 'required','nama' => 'required','pekerjaan' => 'required','penghasilan_perbulan' => 'required','kontak' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Orangtuawali::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'orangtuawalis.index',['santri'=>$request->santri_id])->with('success','Data berhasi diproses');
    }

    public function show(Orangtuawali $orangtuawali)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Orang tua wali";
        $orangtuawali = Orangtuawali::find($id);

        return view('alza_admin.alza_modul.orangtuawali.edit',compact('title','orangtuawali'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['santri_id' => 'required','nama' => 'required','pekerjaan' => 'required','penghasilan_perbulan' => 'required','kontak' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $orangtuawali = Orangtuawali::find($id);
        $orangtuawali->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'orangtuawalis.index',['santri'=>$request->santri_id])->with('success','Data berhasi diproses');
    }

    public function destroy(Orangtuawali $orangtuawali)
    {
        $orangtuawali->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'orangtuawalis.index',["santri"=>$orangtuawali->santri_id])->with('success','Data berhasi diproses');
    }
}
