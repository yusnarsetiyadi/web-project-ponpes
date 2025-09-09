<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategorigaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class GaleriController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:galeri-list|galeri-create|galeri-edit|galeri-delete', ['only' => ['index','show']]);
         $this->middleware('permission:galeri-create', ['only' => ['create','store']]);
         $this->middleware('permission:galeri-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:galeri-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Galeri";
        $pagination  = 10;
        $galeris = Galeri::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('judul', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($galeris->currentPage() - 1) * $galeris->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $galeris->count()) . " Data dari ". $galeris->total(). " Data";
        return view('alza_admin.alza_modul.galeri.index', compact('galeris', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Galeri";
        $kategorigaleris = Kategorigaleri::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.galeri.create',compact('title','kategorigaleris'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['foto' => 'required','judul' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('foto');
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/galeri',
				$file,
				time()."_".$nama_file,
			);
            $input['foto'] = basename($pathfile);
		}else{
            $input = Arr::except($input,['foto']);
        }

        Galeri::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'galeris.index')->with('success','Data berhasi diproses');
    }

    public function show(Galeri $galeri)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Galeri";
        $galeri = Galeri::find($id);
        $kategorigaleris = Kategorigaleri::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.galeri.edit',compact('title','galeri','kategorigaleris'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['foto' => 'required','judul' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $galeri = Galeri::find($id);
		$file = $request->file('foto');
		$input = $request->except('imagenow');
		if (file_exists($file)) {

            if (Storage::exists('public/galeri/' . $galeri->foto)) {
                Storage::delete('public/galeri/' . $galeri->foto);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/galeri',
				$file,
				time()."_".$nama_file,
			);
			$input['foto'] = basename($pathfile);
		}else{
			$input = Arr::except($input,['foto','imagenow']);
		}

        $galeri->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'galeris.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'galeris.index')->with('success','Data berhasi diproses');
    }
}
