<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ProgramController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:program-list|program-create|program-edit|program-delete', ['only' => ['index','show']]);
         $this->middleware('permission:program-create', ['only' => ['create','store']]);
         $this->middleware('permission:program-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:program-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record program";
        $pagination  = 10;
        $programs = Artikel::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('judul', 'like', "%{$request->keyword}%");
            })
            ->where('kategori_id','=','1')
            ->orderBy('id', 'DESC')
            ->paginate($pagination);
        $valuepage = (($programs->currentPage() - 1) * $programs->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $programs->count()) . " Data dari ". $programs->total(). " Data";
        return view('alza_admin.alza_modul.program.index', compact('programs', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record program";
        $kategori = Kategori::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.program.create',compact('title','kategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('gambar');
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/artikel',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,['gambar']);
        }


        Artikel::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'programs.index')->with('success','Data berhasi diproses');
    }

    public function show(Artikel $program)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record program";
        $program = Artikel::find($id);
        $kategori = Kategori::where('aktif','Y')->get();
        return view('alza_admin.alza_modul.program.edit',compact('title','program','kategori'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['judul' => 'required','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $program = Artikel::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');
		if (file_exists($file)) {

            if (Storage::exists('public/artikel/' . $program->gambar)) {
                Storage::delete('public/artikel/' . $program->gambar);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/artikel',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
			$input = Arr::except($input,['gambar','imagenow']);
		}

        $program->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'programs.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Artikel $program)
    {
        if (Storage::exists('public/artikel/' . $program->gambar)) {
            Storage::delete('public/artikel/' . $program->gambar);
        }
        $program->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'programs.index')->with('success','Data berhasi diproses');
    }
}
