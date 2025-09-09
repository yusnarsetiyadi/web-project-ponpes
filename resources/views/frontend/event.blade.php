@extends('frontend.template')
@section('content')

<div style="background:#ffa500;">
    <div class="uk-container">
        <div  class="uk-padding-small">
            <div class="uk-text-center uk-padding-small">
                <h4 class="uk-text-bold uk-margin-remove-bottom" style="color: #fff">Semua Event</h4>
            </div>
        </div>
    </div>
</div>

<div class="uk-container  uk-margin-top">
    <!-- Form Pencarian -->
    <form method="GET" action="" class="uk-margin">
        @csrf
        <div class="uk-grid-small uk-child-width-expand@s" uk-grid>
            <div>
                <input class="uk-input" type="text" name="keyword" value="{{ old('keyword',request('keyword')) }}" placeholder="Cari Buku">
            </div>
            <div class="uk-width-1-6">
                <button class="uk-button uk-button-primary">Cari</button>
            </div>
        </div>
    </form>
</div>

<div class="uk-container uk-padding-small uk-margin-remove-bottom">

    <!-- Grid event -->
    <div class="uk-grid-small {!!$events->count() > 0 ? 'uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-match' : 'uk-child-width-1-1' !!} " uk-grid>
        @forelse ($events as $row)
            <div>
                <a href="{{ url('/detil-event/' . $row->seo) }}" class="uk-link-reset">
                    <div class="uk-card uk-border-rounded">
                        <div class="square-wrapper uk-card-media-top uk-border-rounded uk-box-shadow-small">
                            @if ($row->gambar=='' || $row->gambar == null)
                                <img src="{{ url('/assets/img/noimage.png') }}" alt="{{$row->judul}}" class="uk-border-rounded square-image" style="width: 100%;">
                            @else
                                <img src="{{ url('/storage/event/'.$row->gambar) }}" alt="{{$row->judul}}" class="uk-border-rounded square-image" style="width: 100%;">
                            @endif
                        </div>
                        <div class="uk-padding-small">
                            <span class="uk-text-meta">
                                <span uk-icon="icon: calendar; ratio: 0.8"></span> {!! Alzaget::formatTanggal($row->created_at) !!}
                            </span>
                            <h4 class="uk-card-title uk-margin-small-top uk-text-bold" style="font-size: 16px;">
                                {!! $row->judul !!}
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div>
                <div class="uk-text-center uk-text-danger"><h5 class="uk-text-center uk-text-danger">Belum ada event di publish. <a href="{{url('/')}}">Kembali</a></h5></div>
            </div>
        @endforelse

    </div>

    <div class="uk-margin">
        @if ($events->hasPages())
        <ul class="uk-pagination uk-flex-center uk-margin-medium-top" uk-margin>
            {{-- Previous Page Link --}}
            @if ($events->onFirstPage())
            <li class="uk-disabled"><span uk-icon="icon: chevron-left"></span></li>
            @else
            <li>
                <a href="{{ $events->previousPageUrl() . '&keyword=' . Request::get('keyword') }}"
                    rel="prev" uk-icon="icon: chevron-left"></a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
            @if ($page == $events->currentPage())
            <li class="uk-active"><span>{{ $page }}</span></li>
            @else
            <li><a
                    href="{{ $url . '&keyword=' . Request::get('keyword') }}">{{
                    $page }}</a></li>
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($events->hasMorePages())
            <li>
                <a href="{{ $events->nextPageUrl() . '&keyword=' . Request::get('keyword') }}"
                    rel="next" uk-icon="icon: chevron-right"></a>
            </li>
            @else
            <li class="uk-disabled"><span uk-icon="icon: chevron-right"></span></li>
            @endif
        </ul>
        @endif
    </div>

</div>

@endsection
