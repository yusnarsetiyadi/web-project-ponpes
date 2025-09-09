@extends('frontend.dashboard')
@section('contentx')
<div class="uk-container uk-container-small uk-margin-medium-top uk-margin-medium-bottom">
    <!-- Page Header -->
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-small uk-margin-bottom">
        <h2 class="uk-card-title uk-text-primary">
            <span uk-icon="icon: credit-card; ratio: 1.2"></span> {{ $title }}
        </h2>

        <!-- Display Error Messages -->
        @if (count($errors) > 0)
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><strong>Perhatian!</strong> Terdapat kesalahan dalam pengisian:</p>
                <ul class="uk-list uk-list-bullet uk-margin-remove-bottom">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Payments Table Card -->
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-small">
        <!-- Payment Summary Stats -->
        <div class="uk-child-width-1-3@s uk-grid-small uk-text-center" uk-grid>
            <div>
                <div class="uk-card uk-card-small uk-card-body uk-background-muted uk-border-rounded">
                    <span uk-icon="icon: check; ratio: 1.5" class="uk-text-success"></span>
                    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Lunas</h4>
                    <p class="uk-text-bold uk-margin-remove-top">
                        {{ $tagihans->where('status_pembyaran', '1')->count() }}
                    </p>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-card-body uk-background-muted uk-border-rounded">
                    <span uk-icon="icon: clock; ratio: 1.5" class="uk-text-warning"></span>
                    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Pending</h4>
                    <p class="uk-text-bold uk-margin-remove-top">
                        {{ $tagihans->where('status_pembyaran', '2')->count() }}
                    </p>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-card-body uk-background-muted uk-border-rounded">
                    <span uk-icon="icon: warning; ratio: 1.5" class="uk-text-danger"></span>
                    <h4 class="uk-margin-small-top uk-margin-remove-bottom">Belum Bayar</h4>
                    <p class="uk-text-bold uk-margin-remove-top">
                        {{ $tagihans->where('status_pembyaran', '0')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="uk-margin-medium">

        <!-- Table Header -->
        <h3 class="uk-heading-bullet uk-margin-medium-bottom">
            <span>Daftar Tagihan</span>
            <span class="uk-text-muted uk-text-small uk-margin-left">{{ $labelcount }}</span>
        </h3>

        <!-- Payments Table -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-middle uk-table-hover uk-table-responsive">
                <thead class="uk-background-muted">
                    <tr>
                        <th class="uk-table-shrink uk-text-center">No</th>
                        <th>Tagihan</th>
                        <th class="uk-text-right">Nominal</th>
                        <th>Jurusan</th>
                        <th>Tingkat</th>
                        <th>Periode</th>
                        <th class="uk-text-center">Status</th>
                        <th class="uk-text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tagihans as $key => $tagihan)
                    <tr>
                        <td class="uk-text-center">{{ $key + 1 + $valuepage }}</td>
                        <td>
                            <div class="uk-text-bold">{{$tagihan->pembayaran->nama}}</div>
                        </td>
                        <td class="uk-text-right">
                            <span class="uk-text-bold">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</span>
                        </td>
                        <td>{{$tagihan->santri->jurusan->nama}}</td>
                        <td>
                            @if ($tagihan->tingkatpendidikan=='1')
                                <span class="uk-label uk-label-success">SD</span>
                            @elseif ($tagihan->tingkatpendidikan=='2')
                                <span class="uk-label uk-label-warning">SMP</span>
                            @else
                                <span class="uk-label uk-label-primary">SMA</span>
                            @endif
                        </td>
                        <td>
                            <div class="uk-text-small">
                                <span uk-icon="icon: calendar" class="uk-margin-small-right"></span>
                                {{$tagihan->bulan}} {{$tagihan->tahun}}
                            </div>
                        </td>
                        <td class="uk-text-center">
                            @if ($tagihan->status_pembyaran=='1')
                                <span class="uk-label uk-label-success">LUNAS</span>
                            @elseif ($tagihan->status_pembyaran=='2')
                                <span class="uk-label uk-label-warning">PENDING</span>
                            @else
                                <span class="uk-label uk-label-danger">BELUM BAYAR</span>
                            @endif
                        </td>
                        <td class="uk-text-center">
                            @if ($tagihan->status_pembyaran=='0')
                                <button class="uk-button uk-button-primary uk-button-small" type="button" uk-toggle="target: #modal-tagihan-{{$tagihan->id}}">
                                    <span uk-icon="icon: credit-card" class="uk-margin-small-right"></span> Bayar
                                </button>

                                <!-- Payment Confirmation Modal -->
                                <div id="modal-tagihan-{{$tagihan->id}}" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body uk-border-rounded">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <h2 class="uk-modal-title uk-text-center">Konfirmasi Pembayaran</h2>

                                        <div class="uk-alert-primary uk-margin-medium-top uk-margin-medium-bottom" uk-alert>
                                            <div class="uk-grid-small" uk-grid>
                                                <div class="uk-width-auto">
                                                    <span uk-icon="icon: info; ratio: 1.5"></span>
                                                </div>
                                                <div class="uk-width-expand">
                                                    <h4 class="uk-margin-remove-bottom">Detail Tagihan</h4>
                                                    <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom">
                                                        <strong>Tagihan:</strong> {{$tagihan->pembayaran->nama}}<br>
                                                        <strong>Nominal:</strong> Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}<br>
                                                        <strong>Periode:</strong> {{$tagihan->bulan}} {{$tagihan->tahun}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('santri.confirm.payment', $tagihan->id) }}" method="POST" enctype="multipart/form-data" class="uk-form-stacked">
                                            @csrf

                                            <!-- Bank Selection -->
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="bank_id">
                                                    <span uk-icon="icon: credit-card" class="uk-margin-small-right"></span>
                                                    Pilih Bank Tujuan Transfer
                                                </label>
                                                <div class="uk-form-controls">
                                                    <select id="bank_id" name="bank_id" class="uk-select" required>
                                                        <option value="" disabled selected>-- Pilih Bank --</option>
                                                        @foreach($banks as $bank)
                                                            <option value="{{ $bank->id }}">{{ $bank->atas_nama }} ({{ $bank->norek }}) {{ $bank->nama_bank }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Payment Proof File Upload -->
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="bukti">
                                                    <span uk-icon="icon: cloud-upload" class="uk-margin-small-right"></span>
                                                    Upload Bukti Pembayaran
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-margin uk-text-center">
                                                        <div class="js-upload" uk-form-custom>
                                                            <input type="file" id="bukti-{{$tagihan->id}}" name="bukti" accept="image/*,application/pdf" required onchange="displayFileName(this, 'payment-file-name-{{$tagihan->id}}')">
                                                            <button class="uk-button uk-button-default uk-width-1-1" type="button" tabindex="-1">
                                                                <span uk-icon="icon: cloud-upload"></span> Pilih File Bukti Pembayaran
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="payment-file-name-{{$tagihan->id}}" class="uk-text-small uk-text-center uk-margin-small-top uk-background-muted uk-padding-small uk-border-rounded" style="display: none;"></div>
                                                    <div class="uk-text-small uk-text-muted uk-margin-small-top">
                                                        Format file: JPG, PNG, atau PDF. Maksimal 2MB.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="uk-alert-warning" uk-alert>
                                                <p>
                                                    <span uk-icon="icon: warning"></span>
                                                    Pastikan bukti pembayaran jelas dan sesuai dengan nominal tagihan.
                                                </p>
                                            </div>

                                            <div class="uk-margin uk-text-right">
                                                <button class="uk-button uk-button-default uk-modal-close" type="button">Batal</button>
                                                <button class="uk-button uk-button-primary" type="submit">
                                                    <span uk-icon="icon: check" class="uk-margin-small-right"></span>
                                                    Konfirmasi Pembayaran
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @elseif ($tagihan->status_pembyaran=='2')
                                <span class="uk-text-warning">
                                    <span uk-icon="icon: clock" class="uk-margin-small-right"></span>
                                    Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="uk-text-success">
                                    <span uk-icon="icon: check" class="uk-margin-small-right"></span>
                                    Pembayaran Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="uk-text-center uk-text-muted">
                            <div class="uk-margin-medium">
                                <span uk-icon="icon: info; ratio: 2"></span>
                                <p>Tidak ada tagihan yang tersedia saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($tagihans->hasPages())
        <div class="uk-margin-medium-top">
            <ul class="uk-pagination uk-flex-center" uk-margin>
                {{-- Previous Page Link --}}
                @if ($tagihans->onFirstPage())
                <li class="uk-disabled"><span><span uk-pagination-previous></span></span></li>
                @else
                <li>
                    <a href="{{ $tagihans->previousPageUrl() . '&keyword=' . Request::get('keyword') }}" rel="prev">
                        <span uk-pagination-previous></span>
                    </a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($tagihans->getUrlRange(1, $tagihans->lastPage()) as $page => $url)
                @if ($page == $tagihans->currentPage())
                <li class="uk-active"><span>{{ $page }}</span></li>
                @else
                <li>
                    <a href="{{ $url . '&keyword=' . Request::get('keyword') }}">{{ $page }}</a>
                </li>
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($tagihans->hasMorePages())
                <li>
                    <a href="{{ $tagihans->nextPageUrl() . '&keyword=' . Request::get('keyword') }}" rel="next">
                        <span uk-pagination-next></span>
                    </a>
                </li>
                @else
                <li class="uk-disabled"><span><span uk-pagination-next></span></span></li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>
<!-- JavaScript for file selection display -->
<script>
    function displayFileName(input, targetId) {
        const fileNameDisplay = document.getElementById(targetId);

        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            fileNameDisplay.textContent = fileName;
            fileNameDisplay.style.display = 'block';

            // Add success styling
            fileNameDisplay.classList.add('uk-text-success');

            // Show file type icon based on extension
            const fileExt = fileName.split('.').pop().toLowerCase();
            let fileIcon = 'file-text';

            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                fileIcon = 'image';
            } else if (fileExt === 'pdf') {
                fileIcon = 'file-pdf';
            }

            fileNameDisplay.innerHTML = `<span uk-icon="icon: ${fileIcon}" class="uk-margin-small-right"></span>${fileName}`;
        } else {
            fileNameDisplay.style.display = 'none';
            fileNameDisplay.textContent = '';
        }
    }
</script>
@endsection
