<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;


class SantriController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:santri-list|santri-create|santri-edit|santri-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:santri-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:santri-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:santri-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Santri";
        $pagination  = 10;
        $santris = Santri::with(['fotoSantri', 'jurusan', 'ortu', 'pendidikan']) // tambahkan eager load
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('nama_lengkap', 'like', "%{$request->keyword}%")
                    ->orWhere('tempat_lahir', 'like', "%{$request->keyword}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$request->keyword}%");
            })
            ->where('diterima', '1')
            ->orderBy('id', 'ASC')
            ->paginate($pagination);
        $valuepage = (($santris->currentPage() - 1) * $santris->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $santris->count()) . " Data dari ". $santris->total(). " Data";
        return view('alza_admin.alza_modul.santri.index', compact('santris', 'valuepage', 'labelcount','title'));
    }

    public function santribaru(Request $request)
    {
        $title = "Record Calon Santri";
        $pagination  = 10;
        $santris = Santri::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_lengkap', 'like', "%{$request->keyword}%")
                    ->orWhere('tempat_lahir', 'like', "%{$request->keyword}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$request->keyword}%");
            })
            ->where('diterima','0')
            ->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($santris->currentPage() - 1) * $santris->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $santris->count()) . " Data dari ". $santris->total(). " Data";
        return view('alza_admin.alza_modul.santri.calonsantri', compact('santris', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Santri";
        $jurusan = Jurusan::all();
        return view('alza_admin.alza_modul.santri.create',compact('title','jurusan'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'username' => 'required',
            'password' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon'=>'required',
            'email' => 'required|unique:santri,email'
        ]);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['pw_nohash'] = $request->password;
        $input['diterima'] = $request->diterima;
        Santri::create($input);
        if($request->diterima == 1){
            return redirect()->route(config('pathadmin.admin_prefix').'santris.index')->with('success','Data berhasi diproses, periksa pada kolom calon santri jika santri yang ditambhakan tidak ada di data santri');
        }else{
            $url = str_replace('.', '/', config('pathadmin.admin_prefix')) . 'calon/santri';
            return redirect($url)->with('success', 'Data berhasil diproses, periksa pada kolom calon santri jika santri yang ditambahkan tidak ada di data santri');
        }
    }

    public function createcalonsantri()
    {
        $title = "Tambah Record Calon Santri";
        $jurusan = Jurusan::all();
        return view('alza_admin.alza_modul.santri.createcalonsantri',compact('title','jurusan'));
    }

    public function show(Santri $santri)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Santri";
        $santri = Santri::find($id);
        $jurusan = Jurusan::all();
        return view('alza_admin.alza_modul.santri.edit',compact('title','santri','jurusan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'username' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|unique:santri,email,'.$id
        ]);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $santri = Santri::find($id);
        $input = $request->all();
        if($request->password!=''){
            $input['password'] = bcrypt($request->password);
        }else{
            $input = Arr::except($input,['password']);
        }

        $santri->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'santris.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'santris.index')->with('success','Data berhasi diproses');
    }

    public function diterima($id)
    {
        Santri::where('id', $id)->where('diterima', '0')->update(['diterima' => '1']);
        return redirect()->back()->with('success', 'Proses Berhasil.calon santri diterima menjadi santri');
    }
}
