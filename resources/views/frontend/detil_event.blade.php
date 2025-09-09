@extends('frontend.template')
@section('content')

<!-- Header Event -->
<div style="background:#ffa500;">
    <div class="uk-container">
        <div class="uk-padding-small uk-padding-remove-horizontal">
            <div class="uk-text-left">
                <nav aria-label="Breadcrumb">
                    <ul class="uk-breadcrumb uk-margin-remove-bottom">
                        <li><a href="{{ url('/') }}" style="color:#fff;">Beranda</a></li>
                        <li><a href="{{ url('/semua/event') }}" style="color:#fff;">Event</a></li>
                        <li class="uk-disabled"><a style="color:#fff;">{{ $event->judul }}</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Detail Event -->
<div class="uk-container uk-padding">
    <div class="uk-grid-medium" uk-grid>
        <!-- Kolom Kiri: Detail Event -->
        <div class="uk-width-2-3@m">
            <div class="uk-card uk-card-default uk-border-rounded uk-box-shadow-medium">
                <!-- Gambar -->
                <div class="uk-card-media-top">
                    <img src="{{ url('/storage/event/' . $event->gambar) }}" alt="{{ $event->judul }}" class="uk-border-rounded" style="width: 100%;">
                </div>

                <div class="uk-card-body">
                    <!-- Judul -->
                    <h2 class="uk-card-title uk-text-bold uk-margin-remove">{{ $event->judul }}</h2>

                    <!-- Waktu Event dan Status -->
                    @php
                        $today = \Carbon\Carbon::today();
                        $startDate = \Carbon\Carbon::parse($event->tanggal_mulai);
                        $endDate = \Carbon\Carbon::parse($event->tanggal_berakhir);
                        $status = '';

                        if ($endDate->lt($today)) {
                            $status = 'Berakhir';
                        } elseif ($startDate->isSameDay($today) || ($startDate->lte($today) && $endDate->gte($today))) {
                            $status = 'Sedang Berlangsung';
                        } else {
                            $status = 'Akan Datang';
                        }
                    @endphp

                    <p class="uk-text-meta uk-margin-small">
                        <span uk-icon="icon: calendar; ratio: 0.8"></span>
                        {{ $startDate->translatedFormat('d F Y') }} - {{ $endDate->translatedFormat('d F Y') }}
                        <span class="uk-label uk-margin-small-left {{ $status == 'Berakhir' ? 'uk-label-danger' : ($status == 'Sedang Berlangsung' ? 'uk-label-success' : 'uk-label-warning') }}">
                            {{ $status }}
                        </span>
                    </p>

                    <!-- Keterangan -->
                    <div class="uk-margin">
                        {!! $event->keterangan !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Event Lainnya -->
        <div class="uk-width-1-3@m">
            <h4 class="uk-text-bold">Event Lainnya</h4>

            <div class="uk-list uk-list-divider">
                @forelse ($relatedEvents as $related)
                    <div class="uk-margin-small-bottom">
                        <a href="{{ url('/detil-event/' . $related->seo) }}" class="uk-link-reset">
                            <div class="uk-card uk-card-default uk-card-small uk-grid-collapse uk-border-rounded" uk-grid>
                                <div class="uk-card-media-left uk-width-1-3">
                                    <img src="{{ url('/storage/event/' . $related->gambar) }}" alt="{{ $related->judul }}" style="width: 100%; height: auto;">
                                </div>
                                <div class="uk-width-expand">
                                    <div class="uk-card-body">
                                        <h5 class="uk-card-title uk-margin-remove uk-text-truncate">{{ $related->judul }}</h5>
                                        <p class="uk-text-meta uk-margin-remove-top">{{ \Carbon\Carbon::parse($related->tanggal_mulai)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>Tidak ada event lainnya.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
