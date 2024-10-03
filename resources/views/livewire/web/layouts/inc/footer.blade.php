<div>
    <footer class="footer_wrapper" style="background-image: url(assets/app/images/landing/BackgroundFooter.png)">
        <div class="container container-custom">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo_area">
                        <a href="{{ route('app.home') }}">
                            <img src="{{ asset('assets/app/images/landing/footer-logo.svg') }}" alt="logo" />
                        </a>
                        <h5>
                            Just as its name suggests, it simplifies the process of creating
                            sms.
                        </h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="menu_grid">
                        <div class="menu_area">
                            <h3>Pages</h3>
                            <ul class="menu_list">
                                <li>
                                    <a href="{{ route('app.home') }}" >Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('app.feature') }}" >Features</a>
                                </li>
                                <li>
                                    <a href="{{ route('app.pricing') }}" >Pricing</a>
                                </li>
                                <li>
                                    <a href="{{ route('app.contact-us') }}" >Contact Us</a>
                                </li>
                            </ul>
                        </div>

                        <div class="menu_area link_menu_area">
                            <h3>Important Links</h3>
                            <ul class="menu_list">
                                <li>
                                    <a href="{{ route('app.privacy-policy') }}" >Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('app.terms-conditions') }}" >Terms and Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="social_list_area d-flex align-items-center justify-content-center flex-wrap">
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/app/icons/globe.svg') }}" alt="globe cion" />
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/app/icons/facebook.svg') }}" alt="facebook cion" />
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/app/icons/twitter.svg') }}" alt="twitter cion" />
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/app/icons/google.svg') }}" alt="google cion" />
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/app/icons/linkedin.svg') }}" alt="linkedin cion" />
                            </a>
                        </li>
                    </ul>
                    <div class="copy_right_area">
                        <p>&copy; Copyright  <?php echo date('Y'); ?> Text Torrent | All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
