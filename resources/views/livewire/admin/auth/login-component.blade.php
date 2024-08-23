@section('page_title') Admin Login @endsection
<div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h4 class="text-dark"><strong>Admin Login</strong></h4>
                                        <p>Sign in to continue.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/admin/images/profile-img.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="/" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('assets/images/logo-sm2.png') }}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="/" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('assets/images/logo-sm2.png') }}" alt="" class="" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                                @endif
                                <form class="form-horizontal" wire:submit.prevent='adminLogin'>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" wire:model.blur='email' placeholder="Enter email">
                                        @error('email')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" wire:model.blur='password' placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                        @error('password')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model.live="remember_me" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        @if ($login_status == 1)
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-check-circle" style="font-size: 17px;"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-primary waves-effect waves-light login_btn" {!! disabledOn('adminLogin') !!} type="submit">
                                                {!! loadingStateWithText('adminLogin', 'Log In') !!}
                                            </button>
                                        @endif
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('login_success', event => {
            setTimeout(() => {
                '<?php echo session()->put('login_success', 'Login Successful'); ?>'

                window.location.href = "{{ route('admin.dashboard') }}";
            }, 500);
        });
    </script>
@endpush
