@extends('frontend.dashboard')
@section('contentx')
@php
    $warga = Auth::guard('santris')->check();
    if(!$warga){
        header('Location: /santri/login');
        exit;
    }
@endphp
<h2 class="uk-text-bold">Selamat Datang Kembali, {{ Auth::guard('santris')->user()->nama_lengkap }}!</h2>
<p>Senang melihat Anda kembali di halaman dashboard santri. Berikut adalah informasi terbaru untuk Anda.</p>
@endsection
