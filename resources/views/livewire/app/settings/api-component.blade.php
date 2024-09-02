<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Api Section  -->
        <section class="api_wrapper account_border">
            <div class="account_title_area">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/api.svg') }}" alt="api icon" class="user_icon" />
                    <h2>API</h2>
                </div>
            </div>
            <form action="" class="event_form_area">
                <div class="input_row">
                    <label for="">Provide Gateway</label>
                    <div class="nice_select_top_height">
                        <div wire:ignore>
                            <select class="niceSelect niceSelect_area" id="gateway">
                                <option value="Twilio" {{ $gateway == 'Twilio' ? 'selected' : '' }}>Twilio</option>
                                <option value="Telnyx" {{ $gateway == 'Telnyx' ? 'selected' : '' }}>Telnyx</option>
                                <option value="Nexmo" {{ $gateway == 'Nexmo' ? 'selected' : '' }}>Nexmo</option>
                                <option value="Signalwire" {{ $gateway == 'Signalwire' ? 'selected' : '' }}>Signalwire</option>
                                <option value="Bandwidth" {{ $gateway == 'Bandwidth' ? 'selected' : '' }}>Bandwidth</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="input_row">
                    <label for="">Account SID</label>
                    <input type="text" placeholder="Type Account SID" wire:model.blur='account_sid' class="input_field" />
                </div>
                <div class="input_row">
                    <label for="">Account Auth Token</label>
                    <input type="text" placeholder="Type Auth Token" wire:model.blur='auth_token' class="input_field" />
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="create_event_btn">
                        <img src="{{ asset('assets/app/icons/save.svg') }}" alt="save icon" class="save_icon" />
                        Save
                    </button>
                </div>
            </form>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#gateway').on('change', function() {
                var gateway = $(this).val();

                @this.set('gateway', gateway);
            });
        });
    </script>
@endpush
