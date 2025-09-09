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
                {!! Form::open(['route' => config('pathadmin.admin_prefix').'santris.store', 'method' => 'POST', 'class'
                => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="diterima" value="1">
                        <div class="col-12">
                            <div class="form-group"><label>nama_lengkap</label><input name="nama_lengkap"
                                    class="form-control" type="text" value="{{ old('nama_lengkap') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>Username</label><input name="username"
                                    class="form-control" type="text" value="{{ old('username') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tempat_lahir</label><input name="tempat_lahir"
                                    class="form-control" type="text" value="{{ old('tempat_lahir') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>tanggal_lahir</label><input name="tanggal_lahir"
                                    class="form-control" type="date" value="{{ old('tanggal_lahir') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>jenis_kelamin</label><select name="jenis_kelamin"
                                    class="form-control">
                                    <option value="-">-- select --</option>
                                    <option value="-">-</option>
                                    <option value="laki-laki">laki-laki</option>
                                    <option value="perempuan">perempuan</option>
                                </select></div>
                        </div>


                        <div class="col-12">
                            <label for="tingkat_pendidikan">Tingkat Pendidikan <sup class="text-danger">(Wajib diisi)</sup></label>
                            <select class="form-control" id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                                <option value="">Pilih Tingkat Pendidikan</option>
                                <option value="1" {{ old('tingkat_pendidikan') == '1' ? 'selected' : '' }}>SD</option>
                                <option value="2" {{ old('tingkat_pendidikan') == '2' ? 'selected' : '' }}>SMP</option>
                                <option value="3" {{ old('tingkat_pendidikan') == '3' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><label>Jurusan</label><select name="jurusan_id"
                                    class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($jurusan as $row)
                                        <option value="{{ $row->id }}" {{ old('jurusan_id') == $row->id ? 'selected' : '' }}>{{ $row->nama }}</option>
                                    @endforeach
                                </select></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>No Telepon</label><input name="no_telepon"
                                    class="form-control" type="text" value="{{ old('no_telepon') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>Alamat</label><input name="alamat"
                                    class="form-control" type="text" value="{{ old('alamat') }}"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alasan</label>
                                <input name="alasan" class="form-control" type="alasan" value="{{ old('alasan') }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>email</label>
                                <input name="email" class="form-control" type="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><label>password</label><input name="password" class="form-control"
                                    type="password" value="{{ old('password') }}"></div>
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
