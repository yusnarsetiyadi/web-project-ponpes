<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class KonfirmasiPembayaranController extends Controller
{

    public function confirmPayment(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'bank_id' => 'required|exists:akunbank,id',
            'bukti' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048', // 2MB max size
        ]);

        // Save the uploaded file
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filePath = $file->store('bukti_pembayaran', 'public');
        }

        // Store payment confirmation details
        $tagihan->status_pembyaran = '2';  // Menunggu Konfirmasi Admin
        $tagihan->bank_id = $validated['bank_id'];
        $tagihan->bukti = $filePath; // Store the file path
        $tagihan->save();

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi dan bukti pembayaran diunggah!');
    }
}
