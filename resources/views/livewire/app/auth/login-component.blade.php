<div>
    <section class="login_wrapper">
        <div class="login_grid">
            <div class="login_left_area">
                <div class="d-flex-between">
                    <a href="{{ route('app.home') }}" class="logo">
                        <img src="{{ asset('assets/app/images/header/logo.svg') }}" alt="logo" />
                    </a>
                    <a href="{{ route('register') }}" class="create_account_btn">Create an account</a>
                </div>

                <div class="d-flex justify-content-center align-items-center flex-column h-100">
                    @if (session()->has('error'))
                        <div class="alert bg-danger text-center text-white">{{ session('error') }}</div>
                    @endif
                    <form class="login_form_area" wire:submit.prevent='userLogin'>
                        <h3 class="login_title">Log in</h3>
                        <h6 class="page_subtitle">
                            Enter your email to login your account.
                        </h6>
                        <div class="input_row">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" wire:model.blur='email'
                                class="input_filed" placeholder="Enter your email" />
                            @error('email')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input_row">
                            <label for="">Password</label>
                            <input type="password" name="" id="password_input1" wire:model.blur='password'
                                class="input_filed password_input_filed" placeholder="Enter your password" />
                            <div class="eye_icon_area" id="password_eye_icon_area1">
                                <button type="button" class="eye_open_btn" id="eyeOpen1">
                                    <img src="{{ asset('assets/app/icons/eye-open.svg') }}" alt="eye open" />
                                </button>
                                <button type="button" class="eye_close_btn" id="eyeClose1">
                                    <img src="{{ asset('assets/app/icons/eye-close.svg') }}" alt="eye close icon" />
                                </button>
                            </div>

                            @error('password')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <a href="{{ route('user.reset.password') }}" class="forget_text">Forgot password?</a>
                        @if ($login_status == 1)
                            <button type="button" class="login_btn"><i class="bx bx-check-circle"
                                    style="font-size: 17px;"></i></button>
                        @else
                            <button type="submit" class="login_btn" {!! disabledOn('userLogin') !!}>
                                {!! loadingStateWithText('userLogin', 'Log In') !!}
                            </button>
                        @endif


                        <div class="or_divider">
                            <span>or</span>
                        </div>
                        <div class="others_option_area">
                            <a href="{{ route('google.redirect') }}" type="button" class="google_login_btn">
                                <img src="{{ asset('assets/app/icons/gmail.png') }}" alt="gmail icon" />
                                <span> Sign in with Google</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="login_content_area">
                <h4>The tool I always desire...</h4>
                <h1 class="page_inner_title">
                    "I was delighted the day I discovered Textorrent. Just as its name
                    suggests, it simplifies the process of creating sms for client is
                    fantastic. It increases my revenue.
                </h1>
                <h3>Mike Johnson</h3>
                <a href="#" class="user_tag">@Flowserve</a>
                <div class="login_img_area">
                    <img src="{{ asset('assets/app/images/landing/hero_image.png') }}" alt="login image" />
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        window.addEventListener('login_success', event => {
            setTimeout(() => {
                window.location.href = "{{ route('app.home') }}";
            }, 500);
        });
    </script>
@endpush
