<div>
    <style>
        .pricing_title {
            font-size: 50px !important;
        }

        .ready_start_wrapper .ready_content_area h4 {
            font-size: 25px !important;
        }

        .ready_start_wrapper .ready_btn_grid .ready_btn {
            font-size: 27px !important;
            height: 70px !important;
        }

        .ready_start_wrapper .ready_btn_grid h6 {
            font-size: 25px !important;
        }
    </style>
    <main>
        <section class="hero_wrapper hero_wrapper_others"
            style="background-image: url(assets/app/images/landing/BackgroundHero.png)">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero_content_area text-center">
                            <h1>Flexible Pricing, Tailored to Your Needs</h1>
                            <h4>
                                Select the option that works best for your business. Choose
                                between bringing your own SMS gateway or using our
                                all-inclusive platform.
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing Section  -->
        <section class="pricing_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="header_area text-center">
                            <h2 class="pricing_title">Bring Your Own Gateway</h2>
                            <h5>
                                Already have a preferred SMS gateway? Easily integrate it with
                                our platform and choose a plan that suits your needs.
                            </h5>
                        </div>
                        <div class="pricing_grid">
                            <div data-aos="fade-up">
                                <div class="pricing_item" wire:ignore>
                                    <h3>Standard</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>7,000 credits</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Access to essential SMS marketing features</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Real-time delivery reports</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Message templates</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Contact management</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Basic customer support</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>1 sub-account</h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$49 <span>/month </span></h6>

                                    @auth
                                        <button wire:click="standardPlan"
                                            class="choose_btn">{!! loadingStateWithText('standardPlan', 'Choose Your Plan') !!}</button>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @endauth
                                </div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="100">
                                <div class="pricing_item premium_pricing_item">
                                    <h3>Premium</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>15,000 credits</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Everything in Standard and Additionally</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Advanced analytics and reporting</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Automated message scheduling</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Priority customer support</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>3 sub-accounts</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>
                                                API access for seamless integration with your gateway
                                            </h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$99 <span>/month </span></h6>
                                    @auth
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @endauth
                                </div>
                            </div>
                            <div data-aos="fade-up" data-aos-delay="150">
                                <div class="pricing_item">
                                    <h3>Enterprise</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>15,000 credits</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Everything in Premium and Additionally</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Unlimited contact segmentation</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Custom API integrations</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>24/7 dedicated support</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Unlimited sub-accounts</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Advanced security and compliance features</h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$149 <span>/month </span></h6>
                                    @auth
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Inclusive Pricing Section  -->
        <section class="pricing_wrapper inclusive_pricing_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="header_area text-center">
                            <h2 class="pricing_title">All-Inclusive Platform</h2>
                            <h5>
                                Don’t have a gateway? No problem. Use our complete solution
                                and pay per message. Our all-inclusive platform offers
                                everything you need to start your SMS campaigns without any
                                additional setup."
                            </h5>
                        </div>
                        <div class="pricing_grid">
                            <div data-aos="fade-right">
                                <div class="pricing_item">
                                    <h3>Starter</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Access to essential SMS marketing features</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Real-time delivery reports</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Contact management</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Basic customer support</h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$625 <span>/25,000 messages </span></h6>
                                    @auth
                                        <button wire:click="choosePlan" class="choose_btn">Choose Your Plan</button>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn">Choose Your Plan</a>
                                    @endauth
                                </div>
                            </div>
                            <div data-aos="fade-right" data-aos-delay="150">
                                <div class="pricing_item premium_pricing_item">
                                    <h3>Growth</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Everything in Starter and Additionally</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Advanced analytics and reporting</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Automated message scheduling</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Priority customer support</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Customizable message templates</h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$1,250 <span>/50,000 messages </span></h6>
                                    @auth
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @endauth
                                </div>
                            </div>
                            <div data-aos="fade-right" data-aos-delay="150">
                                <div class="pricing_item">
                                    <h3>Pro</h3>
                                    <ul>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Everything in Growth and Additionally</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Unlimited contact segmentation</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Detailed campaign analytics</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>24/7 dedicated support</h4>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                    alt="check icon" />
                                            </div>
                                            <h4>Advanced security and compliance features</h4>
                                        </li>
                                    </ul>
                                    <h6 class="price">$2,550 <span>/100,000 messages</span></h6>
                                    @auth
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @else
                                        <a href="{{ route('login') }}" class="choose_btn"> Choose Your Plan </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Campaign Section  -->
        <section class="campaign_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="campaign_grid dynamic_item mt-0">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/campaings-icon6.svg') }}"
                                        alt="campaigns icon" />
                                </div>
                                <h3>Why Our Platform?</h3>
                                <h5>
                                    A brief overview of key benefits like flexibility, powerful
                                    features, and customer support. Reinforce the idea that
                                    whichever option they choose, they’ll get access to a robust
                                    and reliable platform.
                                </h5>
                            </div>
                            <div class="campaign_image text-md-end">
                                <img src="{{ asset('assets/app/images/landing/why-platform.png') }}" alt="dp image"
                                    style="max-width: 314px; max-height: 421px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ready To Start Section  -->
        <section class="ready_start_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="ready_content_area">
                            <h2 class="pricing_title">Ready to Get Started?</h2>
                            <h4>
                                Choose the plan that’s right for you and start reaching your
                                audience today.
                            </h4>
                            <div class="ready_btn_grid">
                                <div>
                                    <h6>Bring Your Own Gateway</h6>
                                    <button type="button" class="ready_btn">
                                        Choose Package
                                    </button>
                                </div>
                                <div>
                                    <h6>All-Inclusive Platform</h6>
                                    <button type="button" class="ready_btn">Select Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/app/images/landing/Background-Integrations.png') }}" alt="ready start curve"
                class="ready_start_curve" />
        </section>
    </main>
</div>
