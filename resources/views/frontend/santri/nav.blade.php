<div class="uk-padding-small uk-card uk-card-default uk-card-body">
    <h4>Menu Navigasi</h4>
    <ul class="uk-list uk-list-divider">
        <li><a href="{{url('/santri/home')}}" class="uk-link-muted uk-link-reset">Home</a></li>
        <li><a href="{{url('/santri/profile')}}" class="uk-link-muted uk-link-reset">Profil</a></li>
        <li><a href="{{url('/santri/tagihan')}}" class="uk-link-muted uk-link-reset">Tagihan</a></li>
        <li><a href="#change-password" class="uk-link-muted uk-link-reset" uk-toggle>Ganti Password</a>

        </li>
        <li><a href="{{url('/santri/pelunasan/tagihan')}}" class="uk-link-muted uk-link-reset">Pembayaran Tagihan</a></li>
    </ul>
</div>
<div id="change-password" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Ganti Password</h2>
        <div class="uk-grid uk-child-width-1-2@s uk-grid-small uk-margin" uk-grid>
            <input type="hidden" name="id" value="{{Session::get("id")}}">
            <div><input class="uk-input" name="password" type="password" placeholder="Password" required></div>
            <div><input class="uk-input" name="password_konfirm" type="password" placeholder="Konfirmasi Password" required></div>
        </div>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Batal</button>
            <button class="uk-button uk-button-primary" type="button" id="submit-change-password">Perbarui</button>
        </p>
    </div>
</div>
