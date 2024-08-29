<div>
    <main class="main_content_wrapper">
        <!-- Bulk Section   -->
        <section class="bulk_wrapper">
            <div class="bulk_title_area">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn2">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Send Bulk Message</h2>
                </div>
            </div>
            <div class="alert_message_area mt-24">
                <div class="icon">
                    <img src="{{ asset('assets/app/icons/alert-01.svg') }}" alt="alert icon" />
                </div>
                <p>
                    If you want to use your local long code to send bulk SMS, then it's
                    recommended you register your business/brand and campaign/use case
                    with our SMS gateway partners. Most major US carriers are now
                    requiring businesses to register with The Campaign Registry (TCR) in
                    order to use standard 10 digit local numbers to send bulk SMS.
                    Carriers' A2P 10DLC(10 digit long code) offerings provide better
                    delivery quality, higher speed, and lower filtering risk than long
                    code SMS of the past, using the same phone numbers. We can assist
                    with this process, just go to this 10DLC registration form to fill
                    in some details so we can get started.
                </p>
            </div>
            <div class="bulk_grid mt-24">
                <div class="bulk_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/call-03.svg') }}" alt="call icon" />
                    </div>
                    <div>
                        <h3>Send from</h3>
                        <h4>+1 (556) 232-1912</h4>
                        <!-- <div class="select_area">
                  <select class="niceSelect niceSelect_area">
                    <option data-display="+1 (556) 232-1912">
                      +1 (556) 232-1912
                    </option>
                    <option value="1">+1 (556) 232-1915</option>
                    <option value="2">+1 (556) 232-1913</option>
                  </select>
                </div> -->
                    </div>
                </div>
                <div class="bulk_item send_form_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/calculator.svg') }}" alt="calculator icon" />
                    </div>
                    <div>
                        <h3>Send from</h3>
                        <h4>32</h4>
                    </div>
                </div>
                <div class="bulk_item local_time_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/watch.svg') }}" alt="watch icon" />
                    </div>
                    <div>
                        <h3>Local time</h3>
                        <h4>12 May, 2024 9AM</h4>
                    </div>
                </div>
            </div>
            <form class="event_form_area">
                <div class="message_grid">
                    <div class="setup_bulk_area">
                        <h3>Set up</h3>
                        <div class="setup_checkbox_grid mt-16">
                            <div class="custom_switch_area">
                                <label class="switch">
                                    <input type="checkbox" checked />
                                    <span class="slider round"></span>
                                </label>
                                <h6 class="switch_title">
                                    Number pool
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle" />
                                    </span>
                                </h6>
                            </div>
                            <div class="custom_switch_area">
                                <label class="switch">
                                    <input type="checkbox" checked />
                                    <span class="slider round"></span>
                                </label>
                                <h6 class="switch_title">
                                    Execute batch process
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle" />
                                    </span>
                                </h6>
                            </div>
                            <div class="custom_switch_area">
                                <label class="switch">
                                    <input type="checkbox" checked />
                                    <span class="slider round"></span>
                                </label>
                                <h6 class="switch_title">
                                    Add opt-out link
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle" />
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">Phone number</label>
                            <div class="custom_select_dropdown_area contact_custom_select_area">
                                <div class="dropdown">
                                    <button class="input_field dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="arrow_down_icon" />
                                        <!-- <div class="placeholder_text">Select</div> -->

                                        <div class="title">4 items selected</div>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="search_input_form search_input_form_sm">
                                            <input type="search" placeholder="Search senders" class="input_search" />
                                            <button type="submit" class="search_icon">
                                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}"
                                                    alt="search icon" />
                                            </button>
                                        </div>
                                        <ul class="dropdown_list">
                                            <li>
                                                <h5>Select List</h5>
                                            </li>
                                            <li>
                                                <div class="input_row mb-0 mt-2">
                                                    <div class="checkbox_area d-flex align-items-center flex-wrap mb-0">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="fromPhone" />
                                                            <label class="form-check-label mb-0" for="fromPhone">
                                                                Select all
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item active_check">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item active_check">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item active_check">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item active_check">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item">
                                                    <img src="assets/images/inbox/user_main.png') }}" alt="user icon"
                                                        class="user_image" />
                                                    <span>+1 (566) 456-344</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">Appended (Opt-out) message</label>
                            <input type="text" placeholder="STOP to opt out" class="input_field" />
                        </div>
                        <div class="two_grid">
                            <div class="input_row searchable_select">
                                <label for="">Batch size</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">20</option>
                                    <option value="2">50</option>
                                    <option value="2">100</option>
                                    <option value="2">250</option>
                                    <option value="2">500</option>
                                    <option value="2">1000</option>
                                    <option value="2">2500</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Batch frequency</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">2 minutes</option>
                                    <option value="1">5 minutes</option>
                                    <option value="1">10 minutes</option>
                                    <option value="1">30 minutes</option>
                                    <option value="1">60 minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                        </div>
                        <div class="input_row searchable_select">
                            <label for="">Sending Throttle
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                    <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle"
                                        style="max-width: 12px; margin-left: 8px" />
                                </span>
                            </label>
                            <select name="lang" class="js-searchBox">
                                <option value="">Select</option>
                                <option value="1">Slow</option>
                                <option value="1">Medium</option>
                                <option value="1">Slow</option>
                            </select>
                            <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                class="down_arrow" />
                        </div>
                    </div>
                    <div class="pick_list_area">
                        <h3>Pick list</h3>
                        <div class="two_grid mt-16">
                            <div class="input_row">
                                <label for="">Contact list</label>
                                <div class="custom_select_dropdown_area">
                                    <div class="dropdown">
                                        <button class="input_field dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                                alt="down arrow" class="arrow_down_icon" />
                                            <!-- <div class="placeholder_text">Select</div> -->
                                            <div class="dropdown_grid">
                                                <div class="icon">G</div>
                                                <div class="title">List 1</div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="search_input_form search_input_form_sm">
                                                <input type="search" placeholder="Search contact list"
                                                    class="input_search" />
                                                <button type="submit" class="search_icon">
                                                    <img src="{{ asset('assets/app/icons/search-gray.svg') }}"
                                                        alt="search icon" />
                                                </button>
                                            </div>
                                            <ul class="dropdown_list">
                                                <li>
                                                    <h5>Select List</h5>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 1</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 2</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 3</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 4</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 5</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 6</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 7</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 8</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 9</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <span>List 10</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Message template</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">Python</option>
                                    <option value="2">Java</option>
                                    <option value="3">Ruby</option>
                                    <option value="4">C/C++</option>
                                    <option value="5">C#</option>
                                    <option value="6">JavaScript</option>
                                    <option value="7">PHP</option>
                                    <option value="8">Swift</option>
                                    <option value="9">Scala</option>
                                    <option value="10">R</option>
                                    <option value="11">Go</option>
                                    <option value="12">VisualBasic.NET</option>
                                    <option value="13">Kotlin</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                        </div>
                        <div class="sms_mms_contact_area mt-2">
                            <div class="d-flex">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home2-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home2" type="button" role="tab"
                                            aria-controls="pills-home2" aria-selected="true">
                                            SMS
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile2-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile2" type="button" role="tab"
                                            aria-controls="pills-profile2" aria-selected="false">
                                            MMS
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home2" role="tabpanel"
                                    aria-labelledby="pills-home2-tab" tabindex="0">
                                    <div class="input_row">
                                        <label for="">Default message</label>
                                        <div class="textarea_header_top">
                                            <div class="textarea_header">
                                                <div class="table_dropdown_area">
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="merge_btn dropdown-toggle hide_dropdown_arrow"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span>Import merge field</span>
                                                            <img src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                                                alt="down arrow" />
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <h4>Select</h4>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item">
                                                                    <span>Phone Number</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item">
                                                                    <span>Email Address</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item">
                                                                    <span>First Name</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item">
                                                                    <span>Last Name</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item">
                                                                    <span>Company</span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="" id="" rows="8" class="input_field textarea_field"
                                                placeholder="[Hi|Hello|Hey] {customer_name}, how are you? The system will replace {customer_name} with the customer’s name and randomly choose a greeting. For instance, if the customer's name is John, the message could be: Hello John, how are you?"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile2" role="tabpanel"
                                    aria-labelledby="pills-profile2-tab" tabindex="0">
                                    <div class="file_upload_area mb-2">
                                        <div class="import_icon">
                                            <img src="{{ asset('assets/app/icons/import.svg') }}"
                                                alt="import icon" />
                                        </div>
                                        <h4><span>Click to upload</span> or drag and drop</h4>
                                        <h5>JPEG, PNG, PDF, and MP4 formats, up to 50MB</h5>
                                    </div>
                                    <div class="uploading_status_area">
                                        <button type="button" class="close_btn">
                                            <img src="{{ asset('assets/app/icons/close.svg') }}" alt="close icon" />
                                        </button>
                                        <!-- ?After 100% uploading complete display this button  -->
                                        <!-- <button type="button" class="close_btn">
                        <img
                          src="{{ asset('assets/app/icons/delete-01.svg') }}"
                          alt="delete icon"
                        />
                      </button> -->
                                        <div class="file_name_grid">
                                            <img src="{{ asset('assets/app/icons/mp3.svg') }}" alt="mp3" />
                                            <div>
                                                <h4>Uploading...</h4>
                                                <h5>7/16 MB</h5>
                                            </div>
                                        </div>
                                        <div class="progress_grid">
                                            <div class="progress" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 40%"></div>
                                            </div>
                                            <div class="number">40%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview_area mt-24">
                    <div>
                        <div class="input_row">
                            <label for="">Preview</label>
                            <textarea name="" id="" class="input_field textarea_field" rows="8"
                                placeholder="[Hi|Hello|Hey] {customer_name}, how are you? The system will replace {customer_name} with the customer’s name and randomly choose a greeting. For instance, if the customer's name is John, the message could be: Hello John, how are you?"></textarea>
                            <h5 class="mt-1">1000 of characters</h5>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bulk_btn_grid mt-16">
                        <button type="button" class="schedule_btn" data-bs-toggle="modal"
                            data-bs-target="#scheduleModal">
                            Schedule
                        </button>
                        <button type="button" class="msg_send_btn">Send Message</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Schedule Modal  -->
        <div class="modal fade common_modal" id="scheduleModal" tabindex="-1" aria-labelledby="newEventModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Schedule your message
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Choose Date</label>
                                    <input type="date" placeholder="Type Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Choose Time</label>
                                    <input type="time" placeholder="Type Subject" class="input_field" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">
                            Choose Time
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            //Show split content
            $("#pills-home-tab").click(function(e) {
                e.preventDefault();
                $("#groupContent").fadeIn();
                $("#contactContent").fadeOut();
            });
            $("#pills-profile-tab").click(function(e) {
                e.preventDefault();
                $("#groupContent").fadeOut();
                $("#contactContent").fadeIn();
            });
        });
    </script>
@endpush
