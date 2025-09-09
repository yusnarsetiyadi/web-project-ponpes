@extends('frontend.template')
@section('content')
<div class="uk-container">
    <div class="uk-padding">
        <h3 class="uk-text-center">Formulir Penerimaan Santri</h3>
        @if (count($errors) > 0)
            <div class="uk-alert-danger" uk-alert>
                <a href class="uk-alert-close" uk-close></a>
                <strong>Whoops!</strong> terjadi masalah saat proses penginputan.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/santri/penerimaan') }}" method="POST">
            @csrf
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Data Santri</legend>

                <div class="uk-grid uk-child-width-1-2@s uk-grid-small" uk-grid>
                    <div class="uk-width-1-1">
                        <label for="nama_lengkap" class="uk-form-label">Nama Lengkap <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <input class="uk-input" id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>
                    </div>
                    <div>
                        <label for="tempat_lahir" class="uk-form-label">Tempat Lahir <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <input class="uk-input" id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="uk-form-label">Tanggal Lahir <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <input class="uk-input" id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}" required>
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="uk-form-label">Jenis Kelamin <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <select class="uk-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="jurusan_id" class="uk-form-label">Jurusan <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <select class="uk-select" id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusan as $row)
                                <option value="{{ $row->id }}" {{ old('jurusan_id') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tingkat_pendidikan" class="uk-form-label">Tingkat Pendidikan <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <select class="uk-select" id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                            <option value="">Pilih Tingkat Pendidikan</option>
                            <option value="1" {{ old('tingkat_pendidikan') == '1' ? 'selected' : '' }}>SD</option>
                            <option value="2" {{ old('tingkat_pendidikan') == '2' ? 'selected' : '' }}>SMP</option>
                            <option value="3" {{ old('tingkat_pendidikan') == '3' ? 'selected' : '' }}>SMA</option>
                        </select>
                    </div>
                    <div> <label for="no_telepon" class="uk-form-label">No Telpon <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <input class="uk-input" id="no_telepon" name="no_telepon" type="no_telepon" placeholder="Masukkan Nomor Telepon" value="{{ old('eno_telepon') }}" required>
                        <small class="uk-text-danger">Mohon isi dengan nomor telepon yang dapat dihubungi</small>
                    </div></div>
                    <div>
                        <label for="email" class="uk-form-label">Email <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <input class="uk-input" id="email" name="email" type="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        <small class="uk-text-danger">Mohon isi dengan email yang valid. kami akan mengirimkan informasi penerimaan lewat email</small>
                    </div>
                    <div class="uk-width-1-1">
                        <label for="alamat" class="uk-form-label">Alamat <sup class="uk-text-danger">(Wajib diisi)</sup></label>
                        <textarea class="uk-textarea" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
                
                <hr>
                <!-- Form Dinamis Orangtua/Wali -->
                <legend class="uk-legend">Data Orangtua/Wali <sup class="uk-text-danger">(Wajib diisi)</sup></legend>
                <div id="orangtua-wali-wrapper">
                    @if(old('orangtua_wali'))
                        @foreach(old('orangtua_wali') as $key => $wali)
                        <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
                            <div><input class="uk-input" name="orangtua_wali[{{ $key }}][nama]" type="text" placeholder="Nama Orangtua/Wali" value="{{ $wali['nama'] }}" required></div>
                            <div><input class="uk-input" name="orangtua_wali[{{ $key }}][pekerjaan]" type="text" placeholder="Pekerjaan" value="{{ $wali['pekerjaan'] }}"></div>
                            <div><input class="uk-input" name="orangtua_wali[{{ $key }}][penghasilan_perbulan]" type="text" placeholder="Penghasilan Per Bulan" value="{{ $wali['penghasilan_perbulan'] }}"></div>
                            <div><input class="uk-input" name="orangtua_wali[{{ $key }}][kontak]" type="text" placeholder="Kontak" value="{{ $wali['kontak'] }}"></div>
                            <div class="uk-width-1-1">
                                <button type="button" class="uk-button uk-button-danger remove-orangtua-wali">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
                        <div><input class="uk-input" name="orangtua_wali[0][nama]" type="text" placeholder="Nama Orangtua/Wali" required></div>
                        <div><input class="uk-input" name="orangtua_wali[0][pekerjaan]" type="text" placeholder="Pekerjaan"></div>
                        <div><input class="uk-input" name="orangtua_wali[0][penghasilan_perbulan]" type="text" placeholder="Penghasilan Per Bulan"></div>
                        <div><input class="uk-input" name="orangtua_wali[0][kontak]" type="text" placeholder="Kontak"></div>
                        <div class="uk-width-1-1">
                            <button type="button" class="uk-button uk-button-danger remove-orangtua-wali">Hapus</button>
                        </div>
                    </div>
                    @endif
                </div>
                <button type="button" id="add-orangtua-wali" class="uk-button uk-button-primary">Tambah Orangtua/Wali</button>
                <hr>
                <!-- Form Dinamis Pendidikan Akhir -->
                <legend class="uk-legend">Data Pendidikan Akhir <sup class="uk-text-danger">(Wajib diisi)</sup></legend>
                <div id="pendidikan-akhir-wrapper">
                    @if(old('pendidikan_akhir'))
                        @foreach(old('pendidikan_akhir') as $key => $pendidikan)
                        <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
                            <div><input class="uk-input" name="pendidikan_akhir[{{ $key }}][nama_sekolah]" type="text" placeholder="Nama Sekolah" value="{{ $pendidikan['nama_sekolah'] }}" required></div>
                            <div><input class="uk-input" name="pendidikan_akhir[{{ $key }}][tahun_lulus]" type="text" placeholder="Tahun Lulus" value="{{ $pendidikan['tahun_lulus'] }}"></div>
                            <div class="uk-width-1-1">
                                <input class="uk-input" name="pendidikan_akhir[{{ $key }}][nilai_rata_rata]" type="text" placeholder="Nilai Rata-rata" value="{{ $pendidikan['nilai_rata_rata'] }}">
                            </div>
                            <div class="uk-width-1-1">
                                <button type="button" class="uk-button uk-button-danger remove-pendidikan-akhir">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
                        <div><input class="uk-input" name="pendidikan_akhir[0][nama_sekolah]" type="text" placeholder="Nama Sekolah" required></div>
                        <div><input class="uk-input" name="pendidikan_akhir[0][tahun_lulus]" type="text" placeholder="Tahun Lulus"></div>
                        <div class="uk-width-1-1">
                            <input class="uk-input" name="pendidikan_akhir[0][nilai_rata_rata]" type="text" placeholder="Nilai Rata-rata">
                        </div>
                        <div class="uk-width-1-1">
                            <button type="button" class="uk-button uk-button-danger remove-pendidikan-akhir">Hapus</button>
                        </div>
                    </div>
                    @endif
                </div>
                <button type="button" id="add-pendidikan-akhir" class="uk-button uk-button-primary">Tambah Pendidikan Akhir</button>
                <hr>
                <div class="uk-margin">
                    <legend class="uk-legend" for="keterangan">Alasan Memilih {{Alzaget::title()}} <sup class="uk-text-danger">(Wajib diisi)</sup></legend>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea" name="alasan" rows="10" id="body" required>{{ old('alasan') }}</textarea>
                        <small class="uk-text-danger">Wajib diisi: berikan alasan anda kepada kami.</small>
                    </div>
                </div>
                <hr>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@once

@push('scriptjs')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('body', {
        versionCheck: false, // Menonaktifkan pemeriksaan versi
        removePlugins: 'imageupload,filebrowser', // Menonaktifkan plugin upload gambar dan file browser
        toolbar: [
            { name: 'document', items: ['-', 'Save', 'NewPage', 'Preview'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
            { name: 'insert', items: ['HorizontalRule', 'Smiley'] } // Hapus 'Image' dari toolbar
        ]
    });

</script>
<script>
    // Add row for Orangtua/Wali
    document.getElementById('add-orangtua-wali').addEventListener('click', function () {
        const wrapper = document.getElementById('orangtua-wali-wrapper');
        const index = wrapper.children.length;
        const newRow = document.createElement('div');
        newRow.classList.add('uk-margin', 'orangtua-wali-item');
        newRow.innerHTML = `
            <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
            <div><input class="uk-input" name="orangtua_wali[${index}][nama]" type="text" placeholder="Nama Orangtua/Wali" required></div>
            <div><input class="uk-input" name="orangtua_wali[${index}][pekerjaan]" type="text" placeholder="Pekerjaan"></div>
            <div><input class="uk-input" name="orangtua_wali[${index}][penghasilan_perbulan]" type="text" placeholder="Penghasilan Per Bulan"></div>
            <div><input class="uk-input" name="orangtua_wali[${index}][kontak]" type="text" placeholder="Kontak"></div>
            <div class="uk-width-1-1"><button type="button" class="uk-button uk-button-danger remove-orangtua-wali">Hapus</button></div>
            </div>
        `;
        wrapper.appendChild(newRow);
    });

    // Add row for Pendidikan Akhir
    document.getElementById('add-pendidikan-akhir').addEventListener('click', function () {
        const wrapper = document.getElementById('pendidikan-akhir-wrapper');
        const index = wrapper.children.length;
        const newRow = document.createElement('div');
        newRow.classList.add('uk-margin', 'pendidikan-akhir-item');
        newRow.innerHTML = `
        <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
            <div><input class="uk-input" name="pendidikan_akhir[${index}][nama_sekolah]" type="text" placeholder="Nama Sekolah" required></div>
            <div><input class="uk-input" name="pendidikan_akhir[${index}][tahun_lulus]" type="text" placeholder="Tahun Lulus"></div>
            <div class="uk-width-1-1"><input class="uk-input" name="pendidikan_akhir[${index}][nilai_rata_rata]" type="text" placeholder="Nilai Rata-rata"></div>
            <div class="uk-width-1-1"><button type="button" class="uk-button uk-button-danger remove-pendidikan-akhir">Hapus</button></div>
        </div>
        `;
        wrapper.appendChild(newRow);
    });

    // Remove row for Orangtua/Wali
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-orangtua-wali')) {
            e.target.parentElement.remove();
        }
    });

    // Remove row for Pendidikan Akhir
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-pendidikan-akhir')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endpush
@endonce

@endsection
