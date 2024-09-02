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
                        <img src="{{ asset($uploaded_avatar) }}" alt="user image" class="user_img" />
                        <div wire:loading wire:target='avatar' wire:key='avatar'>
                            <div class="spinner-container">
                                <button type="button" class="spinner-btn">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="remove_img_btn" id="removeBtn">
                            <img src="{{ asset('assets/app/icons/close-02.svg') }}" alt="" />
                        </button>
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
                <div class="two_grid">
                    <div class="input_row">
                        <label for="">Voicemail Notify Email</label>
                        <input type="text" placeholder="Type Voicemail Notify Email"
                            wire:model.blur='voicemail_notify_email' class="input_field" />
                        @error('voicemail_notify_email')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="input_row voice_mail_type">
                    <label for="">Voicemail Welcome Msg Type</label>
                    <div class="voice_type_area d-flex align-items-center flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="voiceMailType" id="voiceMailType1"
                                wire:model.live='voicemail_message_type' value="text" />
                            <label class="form-check-label" for="voiceMailType1">
                                Text to Voice
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="voiceMailType" wire:model.live='voicemail_message_type'
                                id="voiceMailType2" value="file" />
                            <label class="form-check-label" for="voiceMailType2">
                                MP3/ M4A Audio
                            </label>
                        </div>
                    </div>
                    @error('voicemail_message_type')
                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                    @enderror
                </div>
                <div id="textVoiceContentArea" class="{{ $voicemail_message_type == 'text' ? '' : 'd-hide' }}">
                    <div class="input_row">
                        <label for="">Greetings</label>
                        <textarea name="" id="" rows="6" placeholder="Write here.." wire:model.blur='greetings_text'
                            class="input_field"></textarea>
                        @error('greetings_text')
                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="{{ $voicemail_message_type == 'file' ? '' : 'd-hide' }}" id="mp3ContentArea">
                    <div class="file_upload_area mb-3">
                        <div class="import_icon">
                            <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                        </div>
                        <h4><span>Click to upload</span> or drag and drop</h4>
                        <h5>MP3, MP4(max. 2mb)</h5>
                    </div>
                </div>
                <div class="input_row searchable_select">
                    <label for="">Timezone</label>
                    <select name="lang" class="js-searchBox" wire:model.blur='timezone'>
                        <option value="">Choose Timezone</option>
                        <option value="GTM">GTM</option>
                        <option value="UTC">UTC</option>
                    </select>
                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />

                    @error('timezone')
                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="setting_action_btn_area">
                    <button type="button" class="cancel_btn">Cancel</button>
                    <button type="submit" class="create_event_btn">
                        {!! loadingStateWithText('saveData', 'Save Changes') !!}
                    </button>
                </div>
            </form>
        </section>

        <!-- Delete Account Section  -->
        <section class="delete_account_wrapper account_border mt-24">
            <h4>Delete your account</h4>
            <p>
                Permanently delete the account and remove access from all workspaces.
            </p>
            <button type="button" class="delete_btn">Delete your account</button>
        </section>
    </main>
</div>
@push('scripts')
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
