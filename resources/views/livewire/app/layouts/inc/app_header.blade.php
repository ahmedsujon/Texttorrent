<div>
    <header class="header_wrapper" id="headerWrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="haeder_flex d-flex align-items-center justify-content-between flex-wrap g-lg">
                        <div class="logo">
                            <a href="{{ route('app.home') }}">
                                <img src="{{ asset('assets/app/images/landing/footer-logo.svg') }}" alt="logo" />
                            </a>
                        </div>
                        <nav class="nav_area">
                            <ul class="main_menu_list d-flex align-items-center justify-content-center flex-wrap">
                                <li>
                                    <a href="#" class="active_menu">Home</a>
                                </li>

                                <li>
                                    <a href="#">Features</a>
                                </li>
                                <li>
                                    <a href="#">Pricing</a>
                                </li>

                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="header_btn_area d-flex align-items-center justify-content-end flex-wrap">
                            <a href="{{ route('login') }}" class="sign_in_btn sign_in_desk_btn">Sign in</a>
                            <a href="{{ route('register') }}" class="sign_up_btn sign_up_desk_btn">Sign Up</a>
                            <button type="button" class="menu_toggle_btn" id="menuToggleBtn">
                                <img src="{{ asset('assets/app/icons/logs.svg') }}" alt="logs icon" />
                            </button>
                            <!-- Mobile Menu Section  -->
                            <div class="mobile_menu_area" id="mobileMenuListArea">
                                <ul>
                                    <li>
                                        <a href="#" class="active_menu"> Home </a>
                                    </li>
                                    <li>
                                        <a href="#"> Features </a>
                                    </li>
                                    <li>
                                        <a href="#"> Pricing </a>
                                    </li>
                                    <li>
                                        <a href="#"> About </a>
                                    </li>
                                    <li>
                                        <a href="#"> Contact Us </a>
                                    </li>
                                </ul>
                                <a href="{{ route('login') }}" class="sign_up_btn">Sign in</a>
                                <a href="{{ route('register') }}" class="sign_up_btn">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
