@extends('frontend.template')
@section('content')
<div class="uk-container">
    <div class="uk-padding-small">
        <div class="uk-card uk-card-default uk-card-body uk-text-center">
            <h3 class="uk-card-title uk-text-success">Data Berhasil Dikirim</h3>
            <p>Terima kasih telah mengirimkan data Anda. Admin kami akan memproses data Anda secepatnya.</p>
            <p>Informasi terkait proses selanjutnya akan dikirimkan ke email Anda.</p>

            <h4>Langkah Selanjutnya:</h4>
            <ol class="uk-list uk-list-decimal uk-text-left uk-align-center uk-width-1-2@s">
                <li>Periksa email Anda secara berkala untuk mendapatkan informasi dari admin.</li>
                <li>Pastikan nomor kontak yang Anda cantumkan aktif untuk dihubungi jika diperlukan.</li>
                <li>Jika dalam 7 hari kerja belum ada kabar, silakan hubungi kami melalui <a href="{{ url('/page/hubungi-kami') }}">halaman kontak</a>.</li>
            </ol>

            <a href="{{ url('/') }}" class="uk-button uk-button-primary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
