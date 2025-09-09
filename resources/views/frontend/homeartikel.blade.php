@php
    $beritas = \App\Models\Artikel::where('status','publish')->where('kategori_id','!=','1')->orderBy('id','DESC')->limit(6)->get();
@endphp

<div class="uk-container uk-padding-small uk-margin-remove-bottom">

    <!-- Grid Berita -->
    <div class="uk-grid-small {!! $beritas->count() > 0 ? 'uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-match' : 'uk-child-width-1-1' !!}" uk-grid>
        @forelse ($beritas as $row)
            <div>
                <a href="{{ url('/detil-artikel/' . $row->seo) }}" class="uk-link-reset">
                    <div class="uk-card uk-border-rounded">
                        <div class="square-wrapper uk-card-media-top">
                            @if ($row->gambar!='' || $row->gambar!=null)
                                <img src="{{ url('/storage/artikel/'.$row->gambar) }}" alt="{{$row->judul}}" class="uk-border-rounded square-image" style="width: 100%;">
                            @else
                                <img src="{{ url('/assets/img/noimage.png') }}" alt="{{$row->judul}}" class="uk-border-rounded square-image" style="width: 100%;">
                            @endif
                            <span class="uk-label uk-position-top-left uk-margin-small" style="background: #024d09">{{$row->kategori->nama}}</span>
                        </div>
                        <div class="uk-padding-small">
                            <span class="uk-text-meta">
                                <span uk-icon="icon: calendar; ratio: 0.8"></span> {{$row->created_at}}
                            </span>

                            <h4 class="uk-card-title uk-margin-small-top uk-text-bold" style="font-size: 16px;">
                                {{$row->judul}}
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div>
                <center><h5>Belum ada artikel di publish</h5></center>
            </div>
        @endforelse

    </div>

</div>
