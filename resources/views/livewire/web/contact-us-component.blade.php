<div>
    <style>
        .form-container {
            width: 300px;
            margin: 50px auto;
            text-align: left;
        }

        .checkbox-label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .checkbox-label a {
            color: #000;
            text-decoration: underline;
        }

        .button {
            background-color: #b30000;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #990000;
        }

        .form-check {
            padding-left: 0px !important;
        }
    </style>
    <main>
        <!-- Hero Section  -->
        <section class="hero_wrapper hero_wrapper_others"
            style="background-image: url(assets/app/images/landing/BackgroundHero.png)">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero_content_area text-center">
                            <h1>Let’s Get in Touch with Us</h1>
                            <h4>
                                We are here to help you succeed with your SMS marketing .
                                Whether you need a demo, have questions, or just want to lean
                                more, reach out to us!
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section  -->
        <section class="contact_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <h2 class="pricing_title text-center">Reach Out to Our Team</h2>
                        <div class="contact_grid">
                            <div class="contact_info_area"
                                style="
                    background-image: url(assets/app/images/landing/contact-background.png);
                  ">
                                <h3>Contact Information</h3>
                                <h5>Say something to start a live chat!</h5>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/bxs_phone-call.svg') }}"
                                                alt="phone icon" />
                                        </div>
                                        <a href="tel:+17867467133">786-746-7133</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/ic_sharp-email.svg') }}"
                                                alt="email icon" />
                                        </div>
                                        <a href="mailto:Info@texttorrent.com">Info@texttorrent.com</a>
                                    </li>
                                    {{-- <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/carbon_location-filled.svg') }}"
                                                alt="location icon" />
                                        </div>
                                        <h6>
                                            132 Dartmouth Street Boston, Massachusetts 02156 United
                                            States
                                        </h6>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="contact_form_area">
                                @if (session()->has('success'))
                                    <div class="alert alert-success mb-5">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent='storeData' class="form_area">
                                    <div class="input_grid">
                                        <div class="input_row">
                                            <input type="text" wire:model.blur="first_name" placeholder="Fast Name"
                                                class="input_filed" required />
                                            @error('first_name')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="input_row">
                                            <input type="text" wire:model.blur="last_name" placeholder="Last Name"
                                                class="input_filed" />
                                            @error('last_name')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="input_grid">
                                        <div class="input_row">
                                            <input type="email" wire:model.blur="email" placeholder="Email"
                                                class="input_filed" />
                                            @error('email')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="input_row">
                                            <input type="number" wire:model.blur="phone" placeholder="Phone Number"
                                                class="input_filed" />
                                            @error('phone')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="input_row">
                                        <textarea wire:model.blur="descriptions" placeholder="Message" class="input_filed"></textarea>
                                        @error('descriptions')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="sms_opt_in">
                                            I would like to receive text messages, and agree to the
                                            <a href="{{ route('app.terms-conditions') }}">Terms of Service</a> & <a
                                                href="{{ route('app.privacy-policy') }}">Privacy
                                                Policy</a>.
                                            Reply STOP to cancel, HELP for help. Msg & data rates may apply.
                                            Message frequency may vary.
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="submit_btn ms-auto">
                                            {!! loadingStateWithText('storeData', 'Send Message') !!}
                                        </button>
                                    </div>
                                </form>
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
                                Our sales team is here to guide you through the process. Let’s
                                discuss how are platform can meet your needs
                            </h4>
                            <div class="ready_btn_grid d-block text-center">
                                <button type="button" class="contact_sale_btn">
                                    Contact Sales
                                </button>
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
@push('scripts')
    <!-- JS Here -->
    {{-- <script src="{{ asset('assets/app/plugins/js/jquery-modal-video.min.js') }}"></script> --}}
    <script src="https://kit.fontawesome.com/64f2c0e60c.js" crossorigin="anonymous"></script>
    <!-- Map Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
@endpush
