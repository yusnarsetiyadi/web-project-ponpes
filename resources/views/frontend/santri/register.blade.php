@extends('frontend.template')
@section('content')
@php
    $santri = Auth::guard('santris')->check();
    if($santri){
        header('Location: /santri/home');
        exit;
    }
@endphp
<div class="uk-container">
    <div class="uk-padding">
        <div class="uk-flex uk-flex-between">
            <div class="uk-card uk-card-default uk-card-body uk-width-medium">
                <div class="uk-text-center">
                    <h4 class="uk-text-bold">Daftar Sebagai Santri</h4>
                </div>
                <form action="{{url('/santri/registrasi')}}" method="POST">
                    @csrf
                    @method('POST')
                    <fieldset class="uk-fieldset">

                        <div class="uk-margin">
                            <label for="nama_lengkap" class="uk-form-label">Nama Lengkap</label>
                            <input class="uk-input" id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Masukkan nama lengkap" required value="{{old('nama_lengkap')}}">
                        </div>

                        <div class="uk-margin">
                            <label for="email" class="uk-form-label">Email</label>
                            <input class="uk-input" id="email" name="email" type="email" placeholder="Masukkan email" required value="{{old('email')}}">
                        </div>

                        <div class="uk-margin">
                            <label for="password" class="uk-form-label">Password</label>
                            <input class="uk-input" id="password" name="password" type="password" placeholder="Masukkan password" required value="{{old('password')}}">
                        </div>

                        <div class="uk-margin">
                            <label for="confirm_password" class="uk-form-label">Konfirmasi Password</label>
                            <input class="uk-input" id="confirm_password" name="confirm_password" type="password" placeholder="Konfirmasi password" required value="{{old('confirm_password')}}">
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Daftar</button>
                        </div>
                        <small class="uk-text-center">Sudah punya akun? <a href="{{url('/santri/login')}}">Masuk Disini</a></small>
                    </fieldset>
                </form>


            </div>
            <div class="uk-width-expand">
                <div class="uk-card uk-card-body uk-padding-small">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
