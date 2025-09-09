<!-- Footer -->
<footer class="uk-section uk-section-secondary uk-padding-remove-bottom" style="background-color: #024d09; border-top: 3px solid orange;">
    <div class="uk-container">
        <!-- Maps Section Above Footer Content -->
        <div class="uk-margin-medium-bottom">
            <div class="uk-card uk-card-default uk-box-shadow-small" style="border-radius: 6px; overflow: hidden;">
                {!! Alzaget::maps() !!}
            </div>
        </div>

        <div class="uk-grid-large uk-grid-match uk-child-width-1-3@m" uk-grid>
            <!-- Logo and Contact Info -->
            <div class="uk-text-center uk-text-left@m">
                <div class="logo-container">
                    <img src="{{Alzaget::logo()}}" alt="Logo" class="footer-logo">
                </div>
                <h3 class="uk-text-white uk-margin-small-top uk-margin-remove-bottom" style="font-family: 'Amiri', serif;">{{alzaget::title()}}</h3>
                <p class="uk-text-small uk-margin-small-top" style="color: #f0f0f0 !important;">
                    <i class="fas fa-map-marker-alt uk-margin-small-right"></i> {{alzaget::alamat()}}
                </p>
                <p class="uk-text-small uk-margin-small-top" style="color: #f0f0f0 !important;">
                    <i class="fas fa-phone uk-margin-small-right"></i> {{alzaget::kontak()}}
                </p>
            </div>

            <!-- Main Menu -->
            <div>
                <h4 class="uk-text-white uk-text-bold" style="font-family: 'Amiri', serif;">Menu Utama</h4>
                <ul class="uk-list uk-list-divider uk-margin-top">
                    {!! \App\Helpers\Alzahelpers::buildFrontMenu(Menu::getByName('Footer'),'uk-text-white uk-link-reset hover-effect') !!}
                </ul>
            </div>


        </div>
    </div>

    <!-- Copyright -->
    <div class="uk-section uk-section-xsmall uk-margin-top" style="background-color: rgba(0,0,0,0.2);">
        <div class="uk-container">
            <div class="uk-flex uk-flex-between uk-flex-middle uk-flex-column@s">
                <div class="uk-margin-bottom@s uk-text-center@s">
                    <p class="uk-text-small uk-margin-remove" style="color: #d0d0d0;">
                        &copy; {{ date('Y') }} {{ Alzaget::title() }}. All rights reserved.
                    </p>
                </div>
                <div class="uk-flex uk-flex-center uk-flex-right@s">
                    <a href="#" class="uk-icon-button uk-margin-small-right" style="background-color: #3b5998;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="uk-icon-button uk-margin-small-right" style="background-color: #1da1f2;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="uk-icon-button uk-margin-small-right" style="background-color: #e1306c;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="uk-icon-button" style="background-color: #ff0000;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Footer Styles */
    .footer-logo {
        max-width: 60px;
        max-height: 60px;
        width: auto;
        height: auto;
        transition: transform 0.2s;
    }

    .logo-container {
        display: inline-block;
        overflow: hidden;
    }

    .hover-effect:hover {
        color: #e69500 !important;
        transition: color 0.2s;
    }

    .uk-icon-button {
        transition: transform 0.2s;
    }

    .uk-icon-button:hover {
        transform: scale(1.1);
    }

    /* Responsive Maps Embed */
    .uk-card iframe {
        width: 100%;
        height: 250px;
        border: none;
    }

    @media (min-width: 640px) {
        .uk-card iframe {
            height: 300px;
        }
    }

    @media (min-width: 960px) {
        .uk-card iframe {
            height: 250px;
        }
    }

    @media (max-width: 639px) {
        .footer-logo {
            max-width: 50px;
            max-height: 50px;
        }
    }
</style>
