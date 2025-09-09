<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function allevent(Request $request) {
        $pagination  = 12;
        $events = Event::when($request->keyword, function ($query) use ($request) {
            $query->where('seo', 'like', "%{$request->keyword}%")
                  ->orWhere('judul', 'like', "%{$request->keyword}%");
        })
        ->orderBy('id', 'DESC')
        ->paginate($pagination);
        $valuepage = (($events->currentPage() - 1) * $events->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $events->count()) . " Data dari ". $events->total(). " Data";
        return view('frontend.event',compact('events', 'valuepage', 'labelcount'));
    }


    public function show($seo)
    {
        // Ambil event berdasarkan SEO
        $event = Event::where('seo', '=', $seo)->firstOrFail();

        // Perbarui jumlah views
        $event->increment('view'); // Menambah 1 ke kolom views

        // Ambil 5 berita terkait berdasarkan kategori_id, acak
        $relatedEvents = Event::where('id', '!=', $event->id) // Tidak termasuk event yang sedang dibuka
            ->inRandomOrder()
            ->take(5) // Ambil 5 berita secara acak
            ->get();

        // Kirim data ke view
        return view('frontend.detil_event', compact('event', 'relatedEvents'));
    }
}
