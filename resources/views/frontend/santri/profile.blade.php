@extends('frontend.dashboard')
@section('contentx')
<div class="uk-container uk-container-small uk-margin-medium-top uk-margin-medium-bottom">
    <!-- Page Header -->
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-small uk-margin-bottom">
        <h2 class="uk-card-title uk-text-primary">{{ $title }}</h2>

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

    <!-- Main Content Grid -->
    <div uk-grid class="uk-grid-match">
        <!-- Left Column - Student Photo -->
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body uk-text-center uk-border-rounded uk-box-shadow-small">
                <h4 class="uk-card-title">Foto Profil</h4>
                <div class="uk-inline-clip uk-transition-toggle uk-margin-small-bottom" tabindex="0">
                    @if (!$santri_foto)
                        <img src="{{ asset('assets/img/img11.jpg') }}" alt="{{ $santri->nama_lengkap }}" class="uk-border-circle" width="180" height="180">
                    @else
                        <img src="{{ url('/storage/fotosantri/' . $santri_foto->foto) }}" alt="{{ $santri->nama_lengkap }}" class="uk-border-circle" width="180" height="180">
                    @endif
                    <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle">
                        <p class="uk-margin-remove uk-text-small">Klik tombol di bawah untuk mengubah foto</p>
                    </div>
                </div>

                {{-- <form action="{{ url('/santri/profile/update/'.Session::get('id')) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="uk-margin">
                        <div class="uk-form-custom uk-width-1-1">
                            <input type="file" name="foto">
                            <button class="uk-button uk-button-default uk-width-1-1" type="button" tabindex="-1">Pilih Foto</button>
                        </div>
                    </div>
                    <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Perbarui Foto</button>
                </form> --}}
            </div>
        </div>

        <!-- Right Column - Student Information -->
        <div class="uk-width-2-3@m">
            <!-- Personal Information Card -->
            <div class="uk-card uk-card-default uk-card-body uk-margin-bottom uk-border-rounded uk-box-shadow-small">
                <h3 class="uk-card-title uk-margin-remove-top">
                    <span uk-icon="icon: user; ratio: 1.2"></span> Informasi Pribadi
                </h3>
                <hr class="uk-divider-small">

                <dl class="uk-description-list uk-description-list-divider">
                    <dt><span uk-icon="icon: user"></span> Nama Lengkap</dt>
                    <dd class="uk-text-primary uk-text-bold">{{ $santri->nama_lengkap }}</dd>

                    <dt><span uk-icon="icon: location"></span> Tempat, Tanggal Lahir</dt>
                    <dd>{{ $santri->tempat_lahir }}, {{ date('d F Y', strtotime($santri->tanggal_lahir)) }}</dd>

                    <dt><span uk-icon="icon: heart"></span> Jenis Kelamin</dt>
                    <dd>{{ $santri->jenis_kelamin }}</dd>

                    <dt><span uk-icon="icon: info"></span> Alamat</dt>
                    <dd>{{ $santri->alamat }}</dd>

                    <dt><span uk-icon="icon: phone"></span> No Telepon</dt>
                    <dd>{{ $santri->no_telepon }}</dd>

                    <dt><span uk-icon="icon: mail"></span> Email</dt>
                    <dd>{{ $santri->email }}</dd>

                    <dt><span uk-icon="icon: list"></span> Tingkat Pendidikan</dt>
                    <dd>
                        @if($santri->tingkat_pendidikan == 1)
                            SD
                        @elseif($santri->tingkat_pendidikan == 2)
                            SMP
                        @elseif($santri->tingkat_pendidikan == 3)
                            SMA
                        @else
                            -
                        @endif
                    </dd>

                </dl>
            </div>

            <!-- Family Information Card -->
            <div class="uk-card uk-card-default uk-card-body uk-margin-bottom uk-border-rounded uk-box-shadow-small">
                <h3 class="uk-card-title uk-margin-remove-top">
                    <span uk-icon="icon: users; ratio: 1.2"></span> Informasi Orang Tua/Wali
                    <a href="#add-walimurid" title="Tambah Data Wali Murid" uk-toggle class="uk-icon-link uk-float-right" uk-icon="plus-circle"></a>
                </h3>
                <hr class="uk-divider-small">

                <!-- Orang Tua/Wali Table -->
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-divider uk-table-middle uk-table-hover uk-table-responsive">
                        <thead class="uk-background-muted">
                            <tr>
                                <th class="uk-table-shrink">No</th>
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($santri_ortu as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->pekerjaan ?: '-' }}</td>
                                    <td><a href="tel:{{ $row->kontak }}" class="uk-link-text">{{ $row->kontak ?: '-' }}</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="uk-text-center uk-text-muted">Belum ada data orang tua/wali</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Education Background Card -->
            <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-small">
                <h3 class="uk-card-title uk-margin-remove-top">
                    <span uk-icon="icon: album; ratio: 1.2"></span> Riwayat Pendidikan
                    <a href="#add-pendidikan" title="Tambah Riwayat Pendidikan" uk-toggle class="uk-icon-link uk-float-right" uk-icon="plus-circle"></a>
                </h3>
                <hr class="uk-divider-small">

                <!-- Pendidikan Table -->
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-divider uk-table-middle uk-table-hover uk-table-responsive">
                        <thead class="uk-background-muted">
                            <tr>
                                <th class="uk-table-shrink">No</th>
                                <th>Nama Sekolah</th>
                                <th>Tahun Lulus</th>
                                <th>Nilai Rata-Rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($santri_pen_akhir as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->nama_sekolah }}</td>
                                    <td>{{ $row->tahun_lulus ?: '-' }}</td>
                                    <td>{{ $row->nilai_rata_rata ?: '-' }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('scriptjs')
<script>
    $(document).ready(function() {
        // Submit handler for Wali/Orang Tua form
        $('#submit-walimurid').click(function() {
            // Validate required fields
            if (!$('input[name="nama"]').val()) {
                UIkit.notification({message: 'Nama Orang Tua/Wali harus diisi!', status: 'danger'});
                return false;
            }

            // Collect form data
            let data = {
                santri_id: $('input[name="santri_id"]').val(),
                nama: $('input[name="nama"]').val(),
                pekerjaan: $('input[name="pekerjaan"]').val(),
                penghasilan_perbulan: $('input[name="penghasilan_perbulan"]').val(),
                kontak: $('input[name="kontak"]').val(),
                _token: '{{ csrf_token() }}'
            };

            // Show loading indicator
            const loadingNotification = UIkit.notification({message: '<div uk-spinner></div> Menyimpan data...', timeout: 0});

            // Submit data via AJAX
            $.ajax({
                url: "{{ route('santri.update-walisantri') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    loadingNotification.close();
                    UIkit.notification({message: 'Data berhasil disimpan!', status: 'success'});
                    UIkit.modal('#add-walimurid').hide();
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    loadingNotification.close();
                    let errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    UIkit.notification({message: errorMsg, status: 'danger'});
                }
            });
        });

        // Submit handler for Pendidikan form
        $('#submit-pendidikan').click(function() {
            // Validate required fields
            if (!$('input[name="nama_sekolah"]').val()) {
                UIkit.notification({message: 'Nama Sekolah harus diisi!', status: 'danger'});
                return false;
            }

            // Collect form data
            let data = {
                santri_id: $('input[name="santri_id"]').val(),
                nama_sekolah: $('input[name="nama_sekolah"]').val(),
                tahun_lulus: $('input[name="tahun_lulus"]').val(),
                nilai_rata_rata: $('input[name="nilai_rata_rata"]').val(),
                _token: '{{ csrf_token() }}'
            };

            // Show loading indicator
            const loadingNotification = UIkit.notification({message: '<div uk-spinner></div> Menyimpan data...', timeout: 0});

            // Submit data via AJAX
            $.ajax({
                url: "{{ route('santri.update-pendidikan') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    loadingNotification.close();
                    UIkit.notification({message: 'Data berhasil disimpan!', status: 'success'});
                    UIkit.modal('#add-pendidikan').hide();
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    loadingNotification.close();
                    let errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    UIkit.notification({message: errorMsg, status: 'danger'});
                }
            });
        });

        // Clear form fields when modals are opened
        UIkit.util.on('#add-walimurid', 'shown', function() {
            $('#add-walimurid input:not([name="santri_id"]):not([name="_token"])').val('');
        });

        UIkit.util.on('#add-pendidikan', 'shown', function() {
            $('#add-pendidikan input:not([name="santri_id"]):not([name="_token"])').val('');
        });
    });
</script>
@endpush
@endonce
@endsection
