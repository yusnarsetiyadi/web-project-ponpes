@extends('frontend.template')
@section('content')
@php
    $santri = Auth::guard('santris')->check();
    if($santri){
        header('Location: /santri/home');
        exit;
    }
@endphp

<div class="uk-section uk-section-muted uk-flex uk-flex-middle" style="min-height: 80vh;">
    <div class="uk-container">
        <div class="uk-grid uk-grid-large uk-child-width-1-2@m uk-flex-middle" uk-grid>
            <!-- Left Side - Login Form -->
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large uk-border-rounded">
                    <div class="uk-text-center uk-margin-medium-bottom">
                        <img src="http://127.0.0.1:8000/storage/logo/logo.png" alt="Logo Pesantren" width="80" class="uk-margin-small-bottom">
                        <h3 class="uk-card-title uk-text-bold uk-margin-remove-top">Masuk ke Portal Santri</h3>
                        <p class="uk-text-muted uk-margin-remove-top">Akses informasi Santri</p>
                    </div>
                    
                    @if (count($errors) > 0)
                        <div class="uk-alert-danger uk-border-rounded" uk-alert>
                            <a href class="uk-alert-close" uk-close></a>
                            <div class="uk-flex uk-flex-middle">
                                <span uk-icon="icon: warning; ratio: 0.8" class="uk-margin-small-right"></span>
                                <p class="uk-margin-remove">Terjadi kesalahan saat masuk:</p>
                            </div>
                            <ul class="uk-margin-small-top">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{url('/santri/login-check')}}" method="POST" class="uk-form-stacked">
                        @csrf
                        @method('POST')
                        <fieldset class="uk-fieldset">
                            <div class="uk-margin">
                                <label for="username" class="uk-form-label uk-text-bold">Username</label>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <input class="uk-input uk-border-rounded" id="email" name="username" type="text" 
                                           placeholder="Masukkan username Anda" required value="{{old('username')}}"
                                           autocomplete="username">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="uk-flex uk-flex-between">
                                    <label for="password" class="uk-form-label uk-text-bold">Password</label>
                                    <a href="#" class="uk-text-small uk-link-muted">Lupa password?</a>
                                </div>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <input class="uk-input uk-border-rounded" id="password" name="password" 
                                           type="password" placeholder="Masukkan password Anda" required 
                                           autocomplete="current-password">
                                </div>
                            </div>
                            
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label><input class="uk-checkbox" type="checkbox" name="remember"> Ingat saya</label>
                            </div>

                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-width-1-1 uk-border-rounded uk-box-shadow-small" 
                                        type="submit" style="background-color: #024d09; padding: 10px 0;">
                                    <span uk-icon="sign-in" class="uk-margin-small-right"></span>
                                    Masuk
                                </button>
                            </div>
                        </fieldset>
                    </form>
                    
                    {{-- <div class="uk-text-center uk-margin-top">
                        <p class="uk-margin-remove">Belum memiliki akun?</p>
                        <a href="{{url('/formulir/penerimaan')}}" class="uk-button uk-button-text uk-text-bold">
                            Daftar Sebagai Santri Baru
                        </a>
                    </div> --}}
                </div>
            </div>
            
            <!-- Right Side - Welcome Information -->
            <div class="uk-visible@m">
                <div class="uk-text-left uk-padding">
                    <h2 class="uk-text-bold" style="color: #024d09;">Selamat Datang di Portal Santri</h2>
                    <div class="uk-divider-small"></div>
                    <p class="uk-text-lead">Akses Informasi dalam satu platform.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .uk-button-primary {
        transition: all 0.3s ease;
    }
    
    .uk-button-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    .uk-card {
        transition: all 0.3s ease;
    }
    
    .uk-input:focus, .uk-select:focus, .uk-textarea:focus {
        border-color: #024d09;
    }
    
    .uk-checkbox:checked {
        background-color: #024d09;
    }
    
    .uk-button-text {
        color: #024d09;
    }
</style>
@endpush
@endsection