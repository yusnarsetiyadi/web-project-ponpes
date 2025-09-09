@extends('frontend.template')
@section('content')
<div style="background:#ffa500;">
    <div class="uk-container">
        <div class="uk-padding-small uk-padding-remove-horizontal">
            <div class="uk-text-left">
                <nav aria-label="Breadcrumb">
                    <ul class="uk-breadcrumb uk-margin-remove-bottom">
                        <li><a href="{{ url('/') }}" style="color:#fff;">Beranda</a></li>
                        <li><a href="{{ url('/semua/artikel') }}" style="color:#fff;">Artikel</a></li>
                        <li class="uk-disabled"><a style="color:#fff;" class="uk-text-truncate">{{ $artikel->judul }}</a></li>
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
                    <img src="{{ url('/storage/artikel/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="uk-border-rounded" style="width: 100%;">
                </div>

                <div class="uk-card-body">
                    <!-- Judul -->
                    <h2 class="uk-card-title uk-text-bold uk-margin-remove">{{ $artikel->judul }}</h2>

                    <!-- Waktu -->
                    <p class="uk-text-meta uk-margin-small">
                        <span uk-icon="icon: calendar; ratio: 0.8"></span> {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y  H:i') }} , <span uk-icon="icon: list; ratio: 0.8"></span> {{$artikel->kategori->nama}}
                    </p>

                    <!-- Keterangan -->
                    <div class="uk-margin">
                        {!! $artikel->keterangan !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Berita Terkait -->
        <div class="uk-width-1-3@m">
            <h4 class="uk-text-bold">Berita Terkait</h4>

            <div class="uk-list uk-list-divider">
                @forelse ($relatedArticles as $related)
                    <div class="uk-margin-small-bottom">
                        <a href="{{ url('/detil-artikel/' . $related->seo) }}" class="uk-link-reset">
                            <div class="uk-card uk-card-default uk-card-small uk-grid-collapse uk-border-rounded" uk-grid>
                                <div class="uk-card-media-left uk-width-1-3">
                                    <img src="{{ url('/storage/artikel/' . $related->gambar) }}" alt="{{ $related->judul }}" style="width: 100%; height: auto;">
                                    <span class="uk-label uk-position-top-left uk-margin-small" style="background: #024d09">{{$related->kategori->judul}}</span>
                                </div>
                                <div class="uk-width-expand">
                                    <div class="uk-card-body">
                                        <h5 class="uk-card-title uk-margin-remove uk-text-truncate">{{ $related->judul }}</h5>
                                        <p class="uk-text-meta uk-margin-remove-top">{{ \Carbon\Carbon::parse($related->created_at)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>Tidak ada artikel terkait.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
