<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Kategoribayaran;
use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;


class TagihanController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:tagihan-list|tagihan-create|tagihan-edit|tagihan-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:tagihan-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:tagihan-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:tagihan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('alza_admin.alza_modul.tagihan.index', compact('tagihans', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Tagihan";

        return view('alza_admin.alza_modul.tagihan.create',compact('title'));
    }

    public function store(Request $request)
    {

        Tagihan::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'tagihans.index')->with('success','Data berhasi diproses');
    }

    public function show(Tagihan $tagihan)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Tagihan";
        $tagihan = Tagihan::find($id);

        return view('alza_admin.alza_modul.tagihan.edit',compact('title','tagihan'));
    }

    public function update(Request $request, $id)
    {

        $tagihan = Tagihan::find($id);
        $tagihan->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'tagihans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'tagihans.index')->with('success','Data berhasi diproses');
    }


    public function belum(Request $request)
    {
        $title = "Semua Record Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })
            ->where('status_pembyaran','!=','1')
            ->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('alza_admin.alza_modul.datatagihan.tunggakan', compact('tagihans', 'valuepage', 'labelcount','title'));
    }

    public function konfirm(Request $request)
    {
        $title = "Semua Konfirmasi Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })
            ->where('status_pembyaran','=','2')
            ->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('alza_admin.alza_modul.datatagihan.konfirm', compact('tagihans', 'valuepage', 'labelcount','title'));
    }

    public function sudah(Request $request)
    {
        $title = "Semua Record Pelunasan Tagihan";
        $pagination  = 10;
        $tagihans = Tagihan::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })
            ->where('status_pembyaran','1')
            ->orderBy('id', 'ASC')
            ->paginate($pagination);
        $valuepage = (($tagihans->currentPage() - 1) * $tagihans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $tagihans->count()) . " Data dari ". $tagihans->total(). " Data";
        return view('alza_admin.alza_modul.datatagihan.lunas', compact('tagihans', 'valuepage', 'labelcount','title'));
    }

    public function cetak($id)
    {
        $tagihan = Tagihan::with(['santri.jurusan', 'pembayaran'])->findOrFail($id);

        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $pdf = PDF::loadView('alza_admin.alza_modul.datatagihan.cetak', compact('tagihan', 'bulan'))
                ->setPaper('A5', 'portrait');

        return $pdf->stream('bukti_pembayaran_'.$tagihan->id.'.pdf');
    }

    public function viewGenerateTagihan()
    {
        $title = "Generate Tagihan Santri";
        $kategoripembayaran = Kategoribayaran::where('aktif','=','Y')->get();
        return view('alza_admin.alza_modul.generate', compact('title','kategoripembayaran'));
    }

    public function generateTagihan(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'kategoribayaran_id' => 'required',
            'tingkatpendidikan' => 'required',
        ]);

        if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $periodeBulan = $request->bulan;
        $periodeTahun = $request->tahun;
        $tingkat = $request->tingkatpendidikan;
        $kat = $request->kategoribayaran_id;

        $santris = Santri::where('diterima','=','1')->where('tingkat_pendidikan','=',$tingkat)->get();
        $jenisiurans = Kategoribayaran::where('id','=',$kat)->first(); // Asumsi data jenis iuran disimpan di tabel ini.
        // dd($jenisiurans);
        foreach ($santris as $kk) {
            // Periksa apakah data sudah ada
            $exists = Tagihan::where('santri_id', $kk->id)
            ->where('kategoribayaran_id', $jenisiurans->id)
            ->where('tingkatpendidikan', $tingkat)
            ->where('bulan', $periodeBulan)
            ->where('tahun', $periodeTahun)
            ->exists();
            // dd( $kk->id);
            if (!$exists) {
                // Insert data jika belum ada
                Tagihan::create([
                    'santri_id' => $kk->id,
                    'kategoribayaran_id' => $jenisiurans->id,
                    'nominal' => $jenisiurans->nominal,
                    'tingkatpendidikan' => $tingkat,
                    'bulan' => $periodeBulan,
                    'tahun' => $periodeTahun,
                    'status_pembyaran' =>'0',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tagihan berhasil digenerate.');
    }

    public function prosesBayar($id)
    {
        Tagihan::where('id', $id)
        ->where('status_pembyaran', '0')
        ->orWhere('status_pembyaran', '2')
        ->update(['status_pembyaran' => '1']);
        return redirect()->back()->with('success', 'Proses Pembayaran Berhasil');
    }

    public function prosesBatalBayar($id)
    {
        Tagihan::where('id', $id)->where('status_pembyaran', '1')->update(['status_pembyaran' => '0']);
        return redirect()->back()->with('success', 'Proses Batal Bayar Berhasil');
    }


    public function cetakTagihan(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'kategoribayaran_id' => 'required',
            'tingkatpendidikan' => 'required',
            'jenis_pembayaran' => 'required',
        ]);

        if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $periodeBulan = $request->bulan;
        $periodeTahun = $request->tahun;
        $tingkat = $request->tingkatpendidikan;
        $kat = $request->kategoribayaran_id;

        // Ambil semua tagihan untuk ditampilkan di PDF
        $tagihans = Tagihan::where('bulan', $periodeBulan)
        ->where('tahun', $periodeTahun)
        ->where('tingkatpendidikan', $tingkat)
        ->where('kategoribayaran_id', $kat)
        ->where('status_pembyaran', $request->jenis_pembayaran)
        ->get();

        // Buat PDF
        $pdf = PDF::loadView('pdf.lunas', compact('tagihans', 'periodeBulan', 'periodeTahun'));
        return $pdf->stream('tagihan_' . $periodeBulan . '_' . $periodeTahun . '.pdf');
    }

    public function viewLaporanTagihan()
    {
        $title = "Laporan Tagihan Santri";
        $kategoripembayaran = Kategoribayaran::where('aktif','=','Y')->get();
        return view('alza_admin.alza_modul.cetak', compact('title','kategoripembayaran'));
    }

}
