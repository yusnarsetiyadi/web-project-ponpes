@extends('frontend.template')
@section('content')
<div style="background:#ffa500;">
    <div class="uk-container">
        <div class="uk-padding-small uk-padding-remove-horizontal">
            <div class="uk-text-left">
                <nav aria-label="Breadcrumb">
                    <ul class="uk-breadcrumb uk-margin-remove-bottom">
                        <li><a href="{{ url('/') }}" style="color:#fff;">Beranda</a></li>
                        <li class="uk-disabled"><a style="color:#fff;" class="uk-text-truncate">Kategori Galeri</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="uk-container uk-padding">

    <h3 class="uk-heading-divider">Data Galeri</h3>
    <ul class="uk-list uk-list-striped">
        @foreach ($allKategoriGaleri as $row)
            <li>
                <a href="{{url('/detil'.'/'.$row->id.'/galeri')}}" class="uk-link-muted uk-flex" style="justify-content: space-between">
                    <div>
                        {{ $row->judul }}
                    </div>
                    <div>
                        {{$row->galeridata->count()}} Foto
                    </div>
                </a>
            </li>
        @endforeach
    </ul>

</div>

@endsection
