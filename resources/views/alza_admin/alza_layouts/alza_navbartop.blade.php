<div class="az-headpanel-left">
    <a id="naviconMenu" href="#" class="az-navicon d-none d-lg-flex">
        <i class="fas fa-chevron-left"></i></a>
    <a id="naviconMenuMobile" href="#" class="az-navicon d-lg-none"><i class="fas fa-bars"></i></a>
</div><!-- az-headpanel-left -->

<div class="az-headpanel-right">
    <div class="dropdown dropdown-profile">
        <a href="{{ url('/' . config('pathadmin.admin_name') . '/home') }}" class="nav-link nav-link-profile"
            data-toggle="dropdown">
            <span class="logged-name">
                <span class="hidden-xs-down">{{ Session::get('nama') }}</span>
                <i class="fa fa-angle-down mg-l-3"></i>
            </span>
        </a>
        <div class="dropdown-menu wd-200">
            <ul class="list-unstyled user-profile-nav">
                {{-- <li><a href="#"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href="#"><i class="icon ion-ios-gear-outline"></i> Settings</a></li> --}}
                <li>
                    <a href="javascript:void" onclick="$('#logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;keluar
                    </a>
                </li>
            </ul>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
