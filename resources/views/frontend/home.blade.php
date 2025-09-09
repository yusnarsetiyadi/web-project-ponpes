@extends('frontend.template')
@section('content')
{{-- Hero Section --}}
{{-- Hero Section --}}
<div class="uk-position-relative">
    <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade; autoplay: true; autoplay-interval: 5000; pause-on-hover: true">
        <ul class="uk-slideshow-items" uk-height-viewport="min-height: 600">
            @forelse (\App\Models\Slider::where('aktif','Y')->get() as $row)
                <li>
                    <div class="uk-position-cover">
                        <img src="{{ asset('hero.jpg') }}" alt="{{$row->judul}}" uk-cover>
                    </div>
                    <div class="uk-position-cover" style="background: linear-gradient(to right, rgba(2, 77, 9, 0.85), rgba(0, 0, 0, 0.6))"></div>
                    <div class="uk-container">
                        <div class="uk-position-center uk-padding uk-width-1-1 uk-width-2-3@m uk-light uk-text-center">
                            <span class="uk-text-small uk-text-uppercase" style="letter-spacing: 3px;">بِسْمِ اللهِ الرَّحْمنِ الرَّحِيْمِ</span>
                            <h1 class="uk-margin-small-top uk-heading-medium uk-text-bold" style="font-family: 'Amiri', serif;">Yayasan Pondok Pesantren Al Falahiyah Daarul Mukhtarin</h1>
                            <div class="uk-divider-small uk-margin-medium-top uk-margin-medium-bottom" style="background: #e69500; height: 3px; margin-left: auto; margin-right: auto;"></div>
                            <h3 class="uk-margin-remove-top uk-text-bold">Program Unggulan Tahfidz 30 juz & Kitab Kuning</h3>
                            <p class="uk-margin-medium-top uk-width-1-1 uk-width-3-4@m uk-margin-auto">Mendidik generasi Qur'ani, berakhlak mulia, dan unggul dalam penguasaan ilmu agama serta keilmuan modern</p>
                            <div class="uk-margin-medium-top">
                                <a href="{{$row->link}}" class="uk-button uk-button-primary text-light uk-button-large" style="background: #0e9b1c; border-radius: 4px; color:aliceblue;">Daftar Sekarang</a>
                                <a href="#program" class="uk-button uk-button-default uk-button-large uk-margin-small-left" style="border-color: #e69500; color: #e69500; border-radius: 4px;">Lihat Program</a>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li>
                    <div class="uk-position-cover" style="background: linear-gradient(45deg, #024d09, #0a3e00)"></div>
                    <div class="uk-container">
                        <div class="uk-position-center uk-padding uk-width-1-1 uk-width-2-3@m uk-light uk-text-center">
                            <span class="uk-text-small uk-text-uppercase" style="letter-spacing: 3px;">بِسْمِ اللهِ الرَّحْمنِ الرَّحِيْمِ</span>
                            <h1 class="uk-margin-small-top uk-heading-medium uk-text-bold" style="font-family: 'Amiri', serif;">Yayasan Pondok Pesantren Al Falahiyah Daarul Mukhtarin</h1>
                            <div class="uk-divider-small uk-margin-medium-top uk-margin-medium-bottom" style="background: #e69500; height: 3px; margin-left: auto; margin-right: auto;"></div>
                            <h3 class="uk-margin-remove-top uk-text-bold">Program Unggulan Tahfidz 30 juz & Kitab Kuning</h3>
                            <p class="uk-margin-medium-top uk-width-1-1 uk-width-3-4@m uk-margin-auto">Mendidik generasi Qur'ani, berakhlak mulia, dan unggul dalam penguasaan ilmu agama serta keilmuan modern</p>
                            <div class="uk-margin-medium-top">
                                <a href="#program" class="uk-button uk-button-primary uk-button-large" style="background: #e69500; border-radius: 4px;">Lihat Program</a>
                                <a href="#" class="uk-button uk-button-default uk-button-large uk-margin-small-left" style="border-color: white; color: white; border-radius: 4px;">Hubungi Kami</a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="uk-position-bottom-center uk-position-small">
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin uk-light"></ul>
        </div>
    </div>
</div>




{{-- card --}}
<div class="uk-section">
    <div class="uk-container">
        <div class="uk-text-center uk-margin-large-bottom">
            <span class="uk-label" style="background: #e69500;">INFORMASI</span>
            <h2 class="uk-margin-small-top uk-text-bold" style="color: #024d09;">Sekilas Infografik</h2>
            <div class="uk-divider-small uk-margin-auto"></div>
        </div>
        @include('frontend.card')
    </div>
</div>

{{-- program --}}
<div id="program" class="uk-section uk-section-muted">
    <div class="uk-container">
        <div class="uk-flex uk-flex-between uk-margin-large-bottom">
            <div class="uk-width-3-4@m">
                <span class="uk-label" style="background: #e69500;">PROGRAM UNGGULAN</span>
                <h2 class="uk-margin-small-top uk-text-bold" style="color: #024d09;">Program {{Alzaget::title()}}</h2>
                <div class="uk-divider-small"></div>
                <p class="uk-text-muted">Mencetak generasi Islam yang hafidz Qur'an dan memahami ilmu agama</p>
            </div>
            <div class="uk-visible@m">
                <a href="{{url('/semua/program')}}" class="uk-button uk-button-primary uk-button-large" style="background: #e69500; border-radius: 4px;">Lihat Semua</a>
            </div>
        </div>
        @include('frontend.homeprogram')
        <div class="uk-hidden@m uk-margin-medium-top uk-text-center">
            <a href="{{url('/semua/program')}}" class="uk-button uk-button-primary" style="background: #e69500; border-radius: 4px;">Lihat Semua Program</a>
        </div>
    </div>
</div>

{{-- event --}}
<div class="uk-section">
    <div class="uk-container">
        <div class="uk-flex uk-flex-between uk-margin-large-bottom">
            <div class="uk-width-3-4@m">
                <span class="uk-label" style="background: #024d09;">AGENDA</span>
                <h2 class="uk-margin-small-top uk-text-bold" style="color: #024d09;">Event {{Alzaget::title()}}</h2>
                <div class="uk-divider-small"></div>
                <p class="uk-text-muted">Event dan kegiatan yang akan diselenggarakan dalam waktu dekat</p>
            </div>
            <div class="uk-visible@m">
                <a href="{{url('/semua/event')}}" class="uk-button uk-button-primary uk-button-large" style="background: #024d09; border-radius: 4px;">Lihat Semua</a>
            </div>
        </div>
        @include('frontend.homeevent')
        <div class="uk-hidden@m uk-margin-medium-top uk-text-center">
            <a href="{{url('/semua/event')}}" class="uk-button uk-button-primary" style="background: #024d09; border-radius: 4px;">Lihat Semua Event</a>
        </div>
    </div>
</div>

{{-- artikel --}}
<div class="uk-section uk-section-muted">
    <div class="uk-container">
        <div class="uk-flex uk-flex-between uk-margin-large-bottom">
            <div class="uk-width-3-4@m">
                <span class="uk-label" style="background: #024d09;">BERITA TERBARU</span>
                <h2 class="uk-margin-small-top uk-text-bold" style="color: #024d09;">Artikel dan Berita</h2>
                <div class="uk-divider-small"></div>
                <p class="uk-text-muted">Aktivitas terbaru {{Alzaget::title()}} dan artikel-artikel bermanfaat</p>
            </div>
            <div class="uk-visible@m">
                <a href="{{url('/semua/artikel')}}" class="uk-button uk-button-primary uk-button-large" style="background: #024d09; border-radius: 4px;">Lihat Semua</a>
            </div>
        </div>
        @include('frontend.homeartikel')
        <div class="uk-hidden@m uk-margin-medium-top uk-text-center">
            <a href="{{url('/semua/artikel')}}" class="uk-button uk-button-primary" style="background: #024d09; border-radius: 4px;">Lihat Semua Artikel</a>
        </div>
    </div>
</div>

{{-- CTA Section --}}
<div class="uk-section uk-light" style="background: linear-gradient(to right, #024d09, #105700);">
    <div class="uk-container">
        <div class="uk-grid-large" uk-grid>
            <div class="uk-width-1-2@m">
                <h2 class="uk-text-bold">Jadilah Bagian dari Keluarga Besar Al Falahiyah Daarul Mukhtarin</h2>
                <p class="uk-text-large">"Barangsiapa yang menempuh jalan untuk mencari ilmu, maka Allah akan memudahkan baginya jalan ke surga." (HR. Muslim)</p>
            </div>
            <div class="uk-width-1-2@m uk-flex uk-flex-middle">
                <div>
                    <p>Pendaftaran santri baru tahun ajaran 2025/2026 telah dibuka. Daftarkan putra-putri Anda sekarang untuk mendapatkan pendidikan Islam terbaik.</p>
                    <a href="#" class="uk-button uk-button-primary uk-button-large" style="background: #e69500; border-radius: 4px;">Daftar Sekarang</a>
                    <a href="#" class="uk-button uk-button-default uk-button-large uk-margin-small-left" style="border-color: white; color: white; border-radius: 4px;">Informasi Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add required styles to head --}}
@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    
    .uk-button {
        font-weight: 600;
        text-transform: none;
        transition: all 0.3s ease;
    }
    
    .uk-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    .uk-label {
        text-transform: none;
        font-weight: 600;
        border-radius: 4px;
        padding: 3px 10px;
    }
    
    .uk-divider-small::after {
        border-top: 3px solid #024d09;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Amiri', serif;
    }
</style>
@endpush
@endsection