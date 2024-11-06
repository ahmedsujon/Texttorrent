<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- My Account Section  -->
        <section class="my_account_wrapper account_border">
            <div class="account_title_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" class="user_icon" />
                    <h2>Account</h2>
                </div>
                <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
            </div>
            <form wire:submit.prevent='saveData' class="event_form_area">
                <div class="user_change_image_area position-relative">
                    <div class="user_img_area">
                        @if ($uploaded_avatar)
                            <img src="{{ asset($uploaded_avatar) }}" class="user_img" />
                        @else
                            <div class="user_img chat-avatar">
                                {{ Str::limit(user()->first_name, 1, '') }}{{ Str::limit(user()->last_name, 1,
                                '') }}
                            </div>
                        @endif

                        <div wire:loading wire:target='avatar' wire:key='avatar'>
                            <div class="spinner-container">
                                <button type="button" class="spinner-btn">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="userUploadImage" id="replaceImage">
                            Replace Image
                        </label>
                    </div>
                    <input type="file" name="" id="userUploadImage" wire:model.live='avatar'
                        class="position-absolute opacity-0 visually-hidden" />
                </div>

                <div class="two_grid">
                    <div class="input_row">
                        <label for="">First Name</label>
                        <input type="text" placeholder="Type First Name" wire:model.blur='first_name'
                            class="input_field" />
                        @error('first_name')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input_row">
                        <label for="">Last Name</label>
                        <input type="text" placeholder="Type Last Name" wire:model.blur='last_name'
                            class="input_field" />
                        @error('last_name')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="two_grid">
                    <div class="input_row">
                        <label for="">Email</label>
                        <input type="email" placeholder="Type Email" wire:model.blur='email' class="input_field" />
                        @error('email')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input_row">
                        <label for="">Phone Number</label>
                        <input type="number" placeholder="Type Phone Number" wire:model.blur='phone'
                            class="input_field" />
                        @error('phone')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="input_row">
                    <label for="">Company Name</label>
                    <input type="text" placeholder="Type Company Name" wire:model.blur='company_name'
                        class="input_field" />
                    @error('company_name')
                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input_row searchable_select">
                    <div wire:ignore>
                        <label for="">Timezone</label>
                        <select name="lang" class="js-searchBox timezone" wire:model='timezone'>
                            <option value="">Choose Timezone</option>
                            <option value="America/New_York">Eastern Time (US) GMT-5:00</option>
                            <option value="America/Chicago">Central Time (US) GMT-6:00</option>
                            <option value="America/Denver">Mountain Time (US) GMT-7:00</option>
                            <option value="America/Los_Angeles">Pacific Time (US) GMT-8:00</option>
                            <option value="America/Anchorage">Alaska Time GMT-9:00</option>
                            <option value="Pacific/Honolulu">Hawaii Time GMT-10:00</option>

                        </select>
                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                    </div>
                    @error('timezone')
                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="setting_action_btn_area">
                    <a href="{{ route('app.home') }}" type="button" class="cancel_btn">Cancel</a>
                    <button type="submit" class="create_event_btn">
                        {!! loadingStateWithText('saveData', 'Save Changes') !!}
                    </button>
                </div>
            </form>
        </section>

        <!-- Delete Account Section  -->
        {{-- <section class="delete_account_wrapper account_border mt-24">
            <h4>Delete your account</h4>
            <p>
                Permanently delete the account and remove access from all workspaces.
            </p>
            <button type="button" class="btn btn-secondary ">Delete your account</button>
        </section> --}}
    </main>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.timezone').on('change', function() {
                @this.set('timezone', this.value);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            //Voice mail type functionality
            $("#voiceMailType1").change(function(e) {
                e.preventDefault();
                $("#textVoiceContentArea").fadeIn();
                $("#mp3ContentArea").fadeOut();
            });

            $("#voiceMailType2").change(function(e) {
                e.preventDefault();
                $("#mp3ContentArea").fadeIn();
                $("#textVoiceContentArea").fadeOut();
            });

            //Upload image text functionality
            $("#removeBtn").hover(
                function() {
                    $("#replaceImage").text("Remove Image");
                },
                function() {
                    $("#replaceImage").text("Replace Image");
                }
            );
        });
    </script>
@endpush
