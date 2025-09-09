<div class="uk-container uk-padding-small uk-margin-remove-bottom">

    <!-- Grid Berita -->
    <div class="uk-grid-small uk-child-width-1-3@m uk-grid-match" uk-grid>
        @forelse (\App\Models\Event::where('aktif','Y')->get() as $row)
            <div>
                <a href="{{ url('/detil-event/' . $row->seo) }}" class="uk-link-reset">
                    <div class="uk-card uk-border-rounded">
                        <div class="uk-card-media-top">
                            <img src="{{ url('/storage/event/'.$row->gambar) }}" alt="{{$row->judul}}" class="uk-border-rounded" style="width: 100%;">
                            <span class="uk-label uk-position-top-left uk-margin-small" style="background: #024d09">EVENT</span>
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
                <center><h5>Belum ada event di publish</h5></center>
            </div>
        @endforelse

    </div>

</div>
