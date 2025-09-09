<!-- Navbar -->
<nav class="uk-navbar-container uk-navbar-transparent uk-light uk-sticky" uk-sticky>
    <div class="uk-container">
      <div uk-navbar>
        <!-- Logo -->
        <div class="uk-navbar-left">
          <a class="uk-navbar-item uk-logo" href="{{url('/')}}">
            <img src="{{Alzaget::logo()}}" alt="Logo" width="40" height="40">
          </a>
        </div>

        <!-- Menu Utama -->
        <div class="uk-navbar-right">

          <ul class="uk-navbar-nav uk-visible@m">
            {!! \App\Helpers\Alzahelpers::buildFrontMenu(Menu::getByName('Public')) !!}
          </ul>

          <!-- Tombol Login -->
        @php
          $santri = Auth::guard('santris')->check();
        @endphp
        @if ($santri)
            <form action="{{ url('/santri/keluar') }}" method="POST" class="uk-display-inline">
                @csrf
                <button type="submit" class="uk-button uk-button-small uk-button-login uk-margin-small-left uk-visible@m">
                    Logout
                </button>
            </form>
        @else
            <a href="{{url('/santri/login')}}" class="uk-button uk-button-small uk-button-login uk-margin-small-left uk-visible@m">Login →</a>
        @endif


          <!-- Hamburger Menu (Mobile) -->
          <a class="uk-navbar-toggle uk-hidden@m" href="#" uk-toggle="target: #offcanvas-nav">
            <span uk-navbar-toggle-icon></span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Off-canvas Menu for Mobile -->
  <div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar uk-background-secondary uk-light">
      <button class="uk-offcanvas-close" type="button" uk-close></button>
      <ul class="uk-nav uk-nav-default" uk-nav>
        {!! \App\Helpers\Alzahelpers::buildFrontMenux(Menu::getByName('Public')) !!}
      </ul>
      @php
          $santri = Auth::guard('santris')->check();
      @endphp
      @if ($santri)
        <form action="{{ url('/santri/keluar') }}" method="POST" class="uk-display-inline">
            @csrf
            <button type="submit" class="uk-button uk-button-small uk-button-login uk-margin-top">
                Logout
            </button>
        </form>
      @else
        <a href="{{url('/santri/login')}}" class="uk-button uk-button-small uk-button-login uk-margin-top">Login →</a>
      @endif
    </div>
  </div>
