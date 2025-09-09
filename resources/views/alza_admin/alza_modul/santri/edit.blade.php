@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> terjadi masalah saat proses penginputan.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="d-flex flex-column align-items-center mb-3">
                    <form action="{{ url('/santri/profile/update/'.$santri->id) }}" method="post" enctype="multipart/form-data" id="form-foto-{{ $santri->id }}">
                        @csrf
                        <label for="fileInput-{{ $santri->id }}" style="cursor: pointer;">
                            @if ($santri->fotoSantri && $santri->fotoSantri->foto)
                                <img id="preview-{{ $santri->id }}" src="{{ url('/storage/fotosantri/' . $santri->fotoSantri->foto) }}" alt="{{ $santri->nama_lengkap }}" width="160" height="160" style="object-fit: cover; border-radius: 50%;">
                            @else
                                <img id="preview-{{ $santri->id }}" src="{{ asset('assets/img/img11.jpg') }}" alt="{{ $santri->nama_lengkap }}" width="160" height="160" style="object-fit: cover; border-radius: 50%;">
                            @endif
                        </label>
                        <input type="file" name="foto" id="fileInput-{{ $santri->id }}" accept="image/*" style="display: none;">
                        <div class="d-flex flex-column align-items-center mb-1">
                            <button type="submit" id="submitBtn-{{ $santri->id }}" class="btn btn-success btn-sm mt-3 px-4 rounded-pill" style="display: none;">Perbarui Foto</button>
                        </div>
                    </form>
                </div>
                {!! Form::model($santri, ['method' => 'PATCH', 'route' =>
                [config('pathadmin.admin_prefix').'santris.update', $santri->id],'enctype' => 'multipart/form-data'])
                !!}
                <div class="form-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group"><label>nama_lengkap</label><input name="nama_lengkap"
                                    class="form-control" type="text" value="{{$santri->nama_lengkap}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>username</label><input name="username"
                                    class="form-control" type="text" value="{{$santri->username}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tempat_lahir</label><input name="tempat_lahir"
                                    class="form-control" type="text" value="{{$santri->tempat_lahir}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tanggal_lahir</label><input name="tanggal_lahir"
                                    class="form-control" type="date" value="{{$santri->tanggal_lahir}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>jenis_kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="-" {!! (($santri->jenis_kelamin == '-') ? 'selected' : '') !!}>-
                                    </option>
                                    <option value="laki-laki" {!! (($santri->jenis_kelamin == 'laki-laki') ? 'selected'
                                        : '') !!}>laki-laki</option>
                                    <option value="perempuan" {!! (($santri->jenis_kelamin == 'perempuan') ? 'selected'
                                        : '') !!}>perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tingkat_pendidikan">Tingkat Pendidikan <sup class="text-danger">(Wajib diisi)</sup></label>
                            <select class="form-control" id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                                <option value="">Pilih Tingkat Pendidikan</option>
                                <option value="1" {{ $santri->tingkat_pendidikan == '1' ? 'selected' : '' }}>SD</option>
                                <option value="2" {{ $santri->tingkat_pendidikan == '2' ? 'selected' : '' }}>SMP</option>
                                <option value="3" {{ $santri->tingkat_pendidikan == '3' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><label>Jurusan</label><select name="jurusan_id"
                                    class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($jurusan as $row)
                                        <option value="{{ $row->id }}" {{ $santri->jurusan_id == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>No Telepon</label><input name="no_telepon"
                                    class="form-control" type="no_telepon" value="{{$santri->no_telepon}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>alamat</label><input name="alamat"
                                    class="form-control" type="alamat" value="{{$santri->alamat}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>email</label><input name="email" class="form-control"
                                    type="email" value="{{$santri->email}}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>password</label>
                                <input name="password" class="form-control" type="password">
                                <small class="text-danger">Biarkan kosong, jika anda tidak ingin menggnati
                                    password. password saat ini : [ <strong>{{$santri->pw_nohash}}</strong> ]</small>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                href="{{ route(config('pathadmin.admin_prefix').'santris.index') }}"> Batal</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('[id^="fileInput-"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const id = this.id.split('-')[1];
            const file = this.files[0];
            const preview = document.getElementById('preview-' + id);
            const submitBtn = document.getElementById('submitBtn-' + id);

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);

                submitBtn.style.display = 'inline-block';
            }
        });
    });
});
</script>
