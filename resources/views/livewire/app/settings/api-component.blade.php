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
                        <select class="niceSelect niceSelect_area">
                            <option data-display="Twilio">Twilio</option>
                            <option value="1">Telnyx</option>
                            <option value="1">Nexmo</option>
                            <option value="1">Signalwire</option>
                            <option value="1">Bandwidth</option>
                        </select>
                    </div>
                </div>
                <div class="input_row">
                    <label for="">Account SID</label>
                    <input type="text" placeholder="Type Account SID" class="input_field" />
                </div>
                <div class="input_row">
                    <label for="">Account Auth Token</label>
                    <input type="text" placeholder="Type Auth Token" class="input_field" />
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
