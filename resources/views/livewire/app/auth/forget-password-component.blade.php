<div>
    <section class="login_others_wrapper">
        <a href="{{ route('app.home') }}" class="logo">
            <img src="{{ asset('assets/app/images/header/logo.svg') }}" alt="logo" />
        </a>
        <div class="login_others_form_area">
            <form class="login_form_area" wire:submit.prevent='sendEmail'>
                <h3 class="login_title">Forget Password?</h3>
                <h6 class="page_subtitle">we will send you an email with instructions on how to reset your password.</h6>
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <div class="input_row">
                    <label for="">Email</label>
                    <input type="email" wire:model.blur='email' class="input_filed" placeholder="Enter your email" />
                    @error('email')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="login_btn">{!! loadingStateWithText('sendEmail', 'Send Email') !!}</button>
            </form>
        </div>
    </section>
</div>
