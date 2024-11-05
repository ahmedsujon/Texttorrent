<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Change Password Section  -->
        <section class="change_password_wrapper account_border">
            <div class="account_title_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <img src="{{ asset('assets/app/icons/lock.svg') }}" alt="user icon" class="user_icon" />
                    <h2>Change Password</h2>
                </div>
                <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
            </div>
            <h5>Update your password</h5>
            <form wire:submit.prevent='changePassword' class="event_form_area">
                <div class="two_grid">
                    <div class="input_row">
                        <label for="">Current Password</label>
                        <input type="password" placeholder="Type Current Password" wire:model.blur='current_password'
                            class="input_field password_input_filed" id="password_input1" />
                        <div class="eye_icon_area" id="password_eye_icon_area1">
                            <button type="button" class="eye_open_btn" id="eyeOpen1">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                            <button type="button" class="eye_close_btn" id="eyeClose1">
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                        </div>

                        @error('current_password')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                        @if (session()->has('error'))
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ session('error') }}</p>
                        @endif
                    </div>
                    <div class="input_row">
                        <label for="">New Password</label>
                        <input type="password" placeholder="Type New Password" class="input_field password_input_filed"
                            wire:model.blur='new_password' id="password_input2" />
                        <div class="eye_icon_area" id="password_eye_icon_area2">
                            <button type="button" class="eye_open_btn" id="eyeOpen2">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                            <button type="button" class="eye_close_btn" id="eyeClose2">
                                <i class="fa-solid fa-eye-slash"></i>
                            </button>
                        </div>

                        @error('new_password')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="setting_action_btn_area">
                    <a href="{{ route('app.home') }}" type="button" class="cancel_btn">Cancel</a>
                    <button type="submit" class="create_event_btn">
                        {!! loadingStateWithText('changePassword', 'Change Password') !!}
                    </button>
                </div>
            </form>
        </section>
    </main>
</div>
