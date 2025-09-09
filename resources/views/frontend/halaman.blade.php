@extends('frontend.template')
@section('content')
<div style="background:#ffa500;">
    <div class="uk-container">
        <div class="uk-padding-small uk-padding-remove-horizontal">
            <div class="uk-text-left">
                <nav aria-label="Breadcrumb">
                    <ul class="uk-breadcrumb uk-margin-remove-bottom">
                        <li><a href="{{ url('/') }}" style="color:#fff;">Beranda</a></li>
                        <li class="uk-disabled"><a style="color:#fff;">{{ $artikel->judul }}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="uk-container uk-padding">
    <div class="uk-grid-medium" uk-grid>
        <!-- Kolom Kiri: Detail Artikel -->
        <div class="uk-width-2-3@m">
            <div class="uk-card uk-card-default uk-border-rounded uk-box-shadow-medium">
                <!-- Gambar -->
                <div class="uk-card-media-top">
                    <img src="{{ url('/storage/halaman/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="uk-border-rounded" style="width: 100%;">
                </div>

                <div class="uk-card-body">
                    <!-- Judul -->
                    <h2 class="uk-card-title uk-text-bold uk-margin-remove">{{ $artikel->judul }}</h2>
                    <!-- Keterangan -->
                    <div class="uk-margin">
                        {!! $artikel->keterangan !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Berita Terkait -->
        <div class="uk-width-1-3@m">
            <div class="uk-list uk-list-divider">
                @forelse ($relatedArticles as $related)
                    <div class="uk-margin-small-bottom">
                        <a href="{{ url('/page/' . $related->seo) }}" class="uk-link-reset">
                            <div class="uk-card uk-card-default uk-card-small uk-grid-collapse uk-border-rounded" uk-grid>
                                <div class="uk-width-1">
                                    <div class="uk-card-body">
                                        <h5 class="uk-card-title uk-margin-remove">{{ $related->judul }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>Tidak ada halaman dibuat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
