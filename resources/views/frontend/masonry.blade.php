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
                        <li><a href="{{ url('/semua/galeri') }}" style="color:#fff;">Galeri</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Detail Event -->
<div class="uk-container uk-padding">
    <h3 class="uk-heading-divider">Semua Foto</h3>
    <div class="masonry">
        @foreach ($relatedGaleris as $row)
            <div class="masonry-item"><img src="{{url('/storage/galeri/'.$row->foto)}}" alt="{{$row->judul}}"></div>
        @endforeach
    </div>
</div>

@endsection
