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
                        <h4>
                            @if (count($numbers) > 0)
                                @foreach ($numbers as $sNum)
                                <span class="badge text-dark" style="border: 1px solid grey;">{{ $sNum }}</span>
                                @endforeach
                            @else
                                ---
                            @endif
                        </h4>
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
                    <div wire:ignore>
                        <h3>Local time</h3>
                        <h4 id="currentTime">{{ \Carbon\Carbon::now()->format('d F, Y h:i:s A') }}</h4>
                    </div>
                </div>
            </div>
            <form class="event_form_area" wire:submit.prevent='storeData'>
                <div class="message_grid">
                    <div class="setup_bulk_area">
                        <h3>Set up</h3>
                        <div class="setup_checkbox_grid mt-16">
                            <div class="custom_switch_area">
                                <label class="switch">
                                    <input type="checkbox" wire:model.live='number_pool' />
                                    <span class="slider round"></span>
                                    @error('number_pool')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
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
                                    <input type="checkbox" wire:model.live='batch_process' />
                                    <span class="slider round"></span>
                                    @error('batch_process')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
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
                                    <input type="checkbox" wire:model.blur='opt_out_link' />
                                    <span class="slider round"></span>
                                    @error('opt_out_link')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </label>
                                <h6 class="switch_title">
                                    Add opt-out link
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle" />
                                    </span>
                                </h6>
                            </div>
                            <div class="custom_switch_area">
                                <label class="switch">
                                    <input type="checkbox" wire:model.live='round_robin_campaign' />
                                    <span class="slider round"></span>
                                    @error('round_robin_campaign')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </label>
                                <h6 class="switch_title">
                                    Round Robin campaign
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle" />
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">Phone number</label>

                            <div class="custom_select_dropdown_area contact_custom_select_area" id="phoneNumberSelect">
                                <div class="dropdown">
                                    <button class="input_field dropdown-toggle" wire:ignore.self type="button" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="arrow_down_icon" />
                                        <!-- <div class="placeholder_text">Select</div> -->

                                        <div class="title" id="userSelectTitle">
                                            {{ count($numbers) }} items selected
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" wire:ignore.self>
                                        <div class="search_input_form search_input_form_sm">
                                            <input type="search" wire:model.live='selectNumberSearch' placeholder="Search senders"
                                                class="input_search" />
                                            <button type="submit" class="search_icon">
                                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                                            </button>
                                        </div>
                                        <ul class="dropdown_list">
                                            <li>
                                                <h5>Select List</h5>
                                            </li>
                                            @if ($number_pool)
                                                <li>
                                                    <div class="input_row mb-0 mt-2">
                                                        <div
                                                            class="checkbox_area d-flex align-items-center flex-wrap mb-0">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" wire:model.live='selectAllNumbers' value="1" id="fromPhone" />
                                                                <label class="form-check-label mb-0" for="fromPhone">
                                                                    Select all
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                            @foreach ($activeNumbers as $activeNumber)
                                                <li>
                                                    <button type="button" class="dropdown-item {{ in_array($activeNumber->number, $numbers) ? 'active_check' : '' }}" wire:click.prevent="selectPhoneNumbers({{ $activeNumber->number }})">
                                                        <img src="{{ asset('assets/app/images/inbox/user_main.png') }}" alt="user icon"
                                                            class="user_image" />
                                                        <span>{{ $activeNumber->number }}</span>
                                                    </button>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">Appended (Opt-out) message</label>
                            <input type="text" placeholder="STOP to opt out" wire:model.blur='appended_message'
                                class="input_field" />
                            @error('appended_message')
                                <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="two_grid">
                            <div class="input_row searchable_select">
                                <div class="wire-ignore" wire:ignore>
                                    <label for="">Batch size</label>
                                    <select name="lang" wire:model.blur='batch_size'
                                        class="js-searchBox batch_size">
                                        <option value="">Select</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                        <option value="2500">2500</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('batch_size')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div class="wire-ignore" wire:ignore>
                                    <label for="">Batch frequency</label>
                                    <select name="lang" wire:model.blur='batch_frequency'
                                        class="js-searchBox batch_frequency">
                                        <option value="">Select</option>
                                        <option value="2">2 minutes</option>
                                        <option value="5">5 minutes</option>
                                        <option value="10">10 minutes</option>
                                        <option value="30">30 minutes</option>
                                        <option value="60">60 minutes</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('batch_frequency')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row searchable_select">
                            <div class="wire-ignore" wire:ignore>
                                <label for="">Sending Throttle
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle"
                                            style="max-width: 12px; margin-left: 8px" />
                                    </span>
                                </label>
                                <select name="lang" wire:model.blur='sending_throttle'
                                    class="js-searchBox sending_throttle">
                                    <option value="">Select</option>
                                    <option value="1">Slow</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Slow</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('sending_throttle')
                                <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="pick_list_area">
                        <h3>Pick list</h3>
                        <div class="two_grid mt-16">
                            <div class="input_row searchable_select">
                                <div class="wire-ignore" wire:ignore>
                                    <label for="">Contact list</label>
                                    <select name="lang" wire:model.blur='contact_list_id'
                                        class="js-searchBox contact_list_id">
                                        <option value="">Select list</option>
                                        @foreach ($contactLists as $item)
                                            <option value="{{ $item->id }}">
                                                {{ getContactListByID($item->id)->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('contact_list_id')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div class="wire-ignore" wire:ignore>
                                    <label for="">Message template</label>
                                    <select name="lang" wire:model.blur='inbox_template_id'
                                        class="js-searchBox inbox_template_id">
                                        <option value="">Select</option>
                                        @foreach ($messageTemplates as $item)
                                            <option value="{{ $item->id }}">
                                                {{ getSMSTempByID($item->id)->template_name }}</option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('inbox_template_id')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
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
                        <button type="submit" class="msg_send_btn">{!! loadingStateWithText('storeData', 'Send Message') !!}</button>
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
        $(".contact_list_id").on('change', function() {
            @this.set('contact_list_id', $(this).val());
        });
        $(".inbox_template_id").on('change', function() {
            @this.set('inbox_template_id', $(this).val());
        });
        $(".batch_size").on('change', function() {
            @this.set('batch_size', $(this).val());
        });
        $(".batch_frequency").on('change', function() {
            @this.set('batch_frequency', $(this).val());
        });
        $(".sending_throttle").on('change', function() {
            @this.set('sending_throttle', $(this).val());
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#phoneNumberSelect .dropdown-item").on("click", function() {
                // Toggle active class
                $(this).toggleClass("active_check");

                // Get all active items
                let selectedValues = $("#phoneNumberSelect .active_check")
                    .map(function() {
                        return $(this).data("value");
                    })
                    .get();

                // Update the title with the selected item count
                let selectedCount = selectedValues.length;
                $("#userSelectTitle").text(`${selectedCount} items selected`);

                // Log selected value
                console.log("Selected values:", selectedValues);
                s;
            });
        });
    </script>

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
    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            const formattedTime = now.toLocaleString('en-US', options);
            document.getElementById('currentTime').innerText = formattedTime;
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endpush
