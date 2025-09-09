@extends('frontend.dashboard')
@section('contentx')
<div class="uk-container uk-container-expand">
    <div class="uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title uk-text-bold">{{ $title }}</h3>

        @if (count($errors) > 0)
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <h4 class="uk-text-bold">Whoops!</h4>
                <p>Ada kesalahan dalam pengisian data:</p>
                <ul class="uk-list uk-list-bullet">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="uk-margin-medium-top">
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-divider uk-table-hover uk-table-middle">
                    <thead>
                        <tr>
                            <th class="uk-table-shrink uk-text-center">No</th>
                            <th>Tagihan</th>
                            <th class="uk-text-right">Nominal</th>
                            <th>Jurusan</th>
                            <th>Tingkat</th>
                            <th>Periode</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihans as $key => $tagihan)
                        <tr>
                            <td class="uk-text-center">{{ $key + 1 + $valuepage }}</td>
                            <td>{{ optional($tagihan->pembayaran)->nama ?? '-' }}</td>
                            <td class="uk-text-right">{{ $tagihan->nominal ?? '-' }}</td>
                            <td>{{ optional(optional($tagihan->santri)->jurusan)->nama ?? '-' }}</td>
                            <td>
                                @switch($tagihan->tingkatpendidikan)
                                    @case('1') SD @break
                                    @case('2') SMP @break
                                    @default SMA
                                @endswitch
                            </td>
                            <td>{{ $tagihan->bulan ?? '-' }} {{ $tagihan->tahun ?? '' }}</td>
                            <td>
                                @if($tagihan->bukti)
                                    <a href="{{ asset('storage/' . $tagihan->bukti) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $tagihan->bukti) }}" width="50" alt="Bukti">
                                    </a>
                                @else
                                    <span class="uk-text-muted">Belum ada</span>
                                @endif
                            </td>

                            <td>
                                @switch($tagihan->status_pembyaran)
                                    @case('1')
                                        <span class="uk-label uk-label-success">LUNAS</span>
                                        @break
                                    @case('2')
                                        <span class="uk-label uk-label-warning">PENDING</span>
                                        @break
                                    @default
                                        <span class="uk-label uk-label-danger">BELUM BAYAR</span>
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="uk-margin-top uk-text-muted">
                {{ $labelcount }}
            </div>
        </div>

        @if ($tagihans->hasPages())
        <div class="uk-margin-top">
            <ul class="uk-pagination uk-flex-center" uk-margin>
                {{-- Previous Page Link --}}
                @if ($tagihans->onFirstPage())
                <li class="uk-disabled">
                    <a href="#"><span uk-pagination-previous></span></a>
                </li>
                @else
                <li>
                    <a href="{{ $tagihans->previousPageUrl() . '&keyword=' . Request::get('keyword') }}">
                        <span uk-pagination-previous></span>
                    </a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($tagihans->getUrlRange(1, $tagihans->lastPage()) as $page => $url)
                @if ($page == $tagihans->currentPage())
                <li class="uk-active">
                    <span>{{ $page }}</span>
                </li>
                @else
                <li>
                    <a href="{{ $url . '&keyword=' . Request::get('keyword') }}">{{ $page }}</a>
                </li>
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($tagihans->hasMorePages())
                <li>
                    <a href="{{ $tagihans->nextPageUrl() . '&keyword=' . Request::get('keyword') }}">
                        <span uk-pagination-next></span>
                    </a>
                </li>
                @else
                <li class="uk-disabled">
                    <a href="#"><span uk-pagination-next></span></a>
                </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
