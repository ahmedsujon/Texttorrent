<div>
    <section class="login_others_wrapper">
        <a href="{{ route('app.home') }}" class="logo">
            <img src="{{ asset('assets/app/images/header/logo.svg') }}" alt="logo" />
        </a>
        <div class="login_others_form_area">
            <form class="login_form_area" wire:submit.prevent='changePassword'>
                <h3 class="login_title">Create new password</h3>
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <div class="input_row">
                    <label for="">Email</label>
                    <input type="email" wire:model.blur="email" class="input_filed" placeholder="Enter your email" />
                    @error('email')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input_row">
                    <label for="">Password</label>
                    <input type="password" wire:model.blur="password" id="password_input1"
                        class="input_filed password_input_filed" placeholder="Enter your password" />
                    <div class="eye_icon_area" id="password_eye_icon_area1">
                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                        <button type="button" class="eye_close_btn" id="eyeClose1">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input_row">
                    <label for="">Confirm Password</label>
                    <input type="password" wire:model.blur="confirm_password" id="password_input2"
                        class="input_filed password_input_filed" placeholder="Enter your password" />
                    <div class="eye_icon_area" id="password_eye_icon_area1">
                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                        <button type="button" class="eye_close_btn" id="eyeClose1">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    @error('confirm_password')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="login_btn">{!! loadingStateWithText('changePassword', 'Create  Password') !!}</button>
        </div>
    </section>
</div>
