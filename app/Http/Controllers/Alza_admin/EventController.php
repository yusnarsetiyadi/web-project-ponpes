<?php

namespace App\Http\Controllers\Alza_admin;

use App\Helpers\AlzaHelpers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class EventController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index','show']]);
         $this->middleware('permission:event-create', ['only' => ['create','store']]);
         $this->middleware('permission:event-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:event-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Event";
        $pagination  = 10;
        $events = Event::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('seo', 'like', "%{$request->keyword}%")->where('judul', 'like', "%{$request->keyword}%")->where('tanggal_mulai', 'like', "%{$request->keyword}%")->where('tanggal_berakhir', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($events->currentPage() - 1) * $events->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $events->count()) . " Data dari ". $events->total(). " Data";
        return view('alza_admin.alza_modul.event.index', compact('events', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Record Event";

        return view('alza_admin.alza_modul.event.create',compact('title'));
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
				'public/event',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,'gambar');
        }

        $input['seo'] = $request->input('seo') == '' ? AlzaHelpers::seo_title($request->input('judul')) : AlzaHelpers::seo_title($request->input('seo'));
        Event::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'events.index')->with('success','Data berhasi diproses');
    }

    public function show(Event $event)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Event";
        $event = Event::find($id);

        return view('alza_admin.alza_modul.event.edit',compact('title','event'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['judul' => 'required','keterangan' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $event = Event::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');


		if (file_exists($file)) {

            if (Storage::exists('public/event/' . $event->gambar)) {
                Storage::delete('public/event/' . $event->gambar);
            }

			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/event',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,'gambar');
        }

        $event->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'events.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Event $event)
    {
        if (Storage::exists('public/event/' . $event->gambar)) {
            Storage::delete('public/event/' . $event->gambar);
        }

        $event->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'events.index')->with('success','Data berhasi diproses');
    }
}
