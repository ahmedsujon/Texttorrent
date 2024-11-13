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
                                    <span class="badge text-dark mb-1"
                                        style="border: 1px solid grey;">{{ $sNum }}</span>
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
                        <h3>Total Credit</h3>
                        <h4>{{ $total_credit }}</h4>
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
            <form class="event_form_area" wire:submit.prevent='storeConfirmation'>
                <div class="message_grid">
                    <div class="setup_bulk_area">
                        <h3>Set up</h3>
                        <div class="setup_checkbox_grid mt-16">
                            @if (isUserPermitted('number-pool'))
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
                            @endif

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
                                    <input type="checkbox" id="opt_out_link" wire:model.live='opt_out_link' />
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
                                    <button class="input_field dropdown-toggle" wire:ignore.self type="button"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="arrow_down_icon" />
                                        <!-- <div class="placeholder_text">Select</div> -->

                                        <div class="title" id="userSelectTitle">
                                            {{ count($numbers) }} items selected
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" wire:ignore.self>
                                        <div class="search_input_form search_input_form_sm">
                                            <input type="search" wire:model.live='selectNumberSearch'
                                                placeholder="Search senders" class="input_search" />
                                            <button type="submit" class="search_icon">
                                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}"
                                                    alt="search icon" />
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
                                                                <input class="form-check-input" type="checkbox"
                                                                    wire:model.live='selectAllNumbers' value="1"
                                                                    id="fromPhone" />
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
                                                    <button type="button"
                                                        class="dropdown-item {{ in_array($activeNumber->number, $numbers) ? 'active_check' : '' }}"
                                                        wire:click.prevent="selectPhoneNumbers({{ $activeNumber->number }})">
                                                        <p class="mb-0">{{ $activeNumber->number }}</p>
                                                    </button>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @error('numbers')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        @if ($opt_out_link)
                            <div class="input_row">
                                <label for="">Appended (Opt-out) message</label>
                                <input type="text" placeholder="STOP to opt out" id="appended_message"
                                    wire:model.blur='appended_message' class="input_field" />
                                @error('appended_message')
                                    <p class="text-danger mb-0" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($batch_process)
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <div class="wire-ignore" wire:ignore>
                                        <label for="">Batch size</label>
                                        <select name="lang" wire:model.blur='batch_size'
                                            class="input_field batch_size">
                                            <option value="">Select</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                            <option value="2500">2500</option>
                                        </select>
                                    </div>
                                    @error('batch_size')
                                        <p class="text-danger mb-0" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row searchable_select">
                                    <div class="wire-ignore" wire:ignore>
                                        <label for="">Batch frequency</label>
                                        <select name="lang" wire:model.blur='batch_frequency'
                                            class="input_field batch_frequency">
                                            <option value="">Select</option>
                                            <option value="2">2 minutes</option>
                                            <option value="5">5 minutes</option>
                                            <option value="10">10 minutes</option>
                                            <option value="30">30 minutes</option>
                                            <option value="60">60 minutes</option>
                                        </select>
                                    </div>
                                    @error('batch_frequency')
                                        <p class="text-danger mb-0" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        {{-- <div class="input_row searchable_select">
                            <div class="wire-ignore" wire:ignore>
                                <label for="">Sending Throttle
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Some Text">
                                        <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info circle"
                                            style="max-width: 12px; margin-left: 8px" />
                                    </span>
                                </label>
                                <select name="lang" wire:model.blur='sending_throttle'
                                    class="input_field sending_throttle">
                                    <option value="">Select</option>
                                    <option value="1">Slow</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Fast</option>
                                </select>
                            </div>
                            @error('sending_throttle')
                                <p class="text-danger mb-0" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                        </div> --}}
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
                                                <div class="icon">{{ Str::limit($contact_list_name, 1, '') }}</div>
                                                <div class="title">
                                                    {{ $contact_list_name ? $contact_list_name : 'Select' }}</div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="search_input_form search_input_form_sm">
                                                <input type="search" placeholder="Search contact list"
                                                    wire:model.live='searchContactList' class="input_search" />
                                                <button type="submit" class="search_icon">
                                                    <img src="{{ asset('assets/app/icons/search-gray.svg') }}"
                                                        alt="search icon" />
                                                </button>
                                            </div>
                                            <ul class="dropdown_list">
                                                <li>
                                                    <h5>Select List</h5>
                                                </li>
                                                @foreach ($contactLists as $item)
                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='selectList({{ $item->id }}, "{{ $item->name }}")'
                                                            class="dropdown-item">
                                                            <span>{{ $item->name }}</span>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @error('contact_list_id')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Message template</label>
                                <select class="bootstrap_select" id="templateSelect">
                                    <option value="">Select</option>
                                    @foreach ($messageTemplates as $item)
                                        <option value="{{ $item->preview_message }}" data-id="{{ $item->id }}">
                                            {{ getSMSTempByID($item->id)->template_name }}</option>
                                    @endforeach
                                </select>
                                @error('inbox_template_id')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="sms_mms_contact_area mt-2">
                            <div class="d-flex">
                                <ul class="nav nav-pills" wire:ignore id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active smsType" data-type="sms" id="pills-home2-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-home2" type="button"
                                            role="tab" aria-controls="pills-home2" aria-selected="true">
                                            SMS
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link smsType" data-type="mms" id="pills-profile2-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-profile2" type="button"
                                            role="tab" aria-controls="pills-profile2" aria-selected="false">
                                            MMS
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" wire:ignore.self id="pills-home2"
                                    role="tabpanel" aria-labelledby="pills-home2-tab" tabindex="0">
                                    <div class="input_row">
                                        <label for="">Default message</label>
                                        <div class="textarea_header_top" wire:ignore>
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
                                                                <button type="button"
                                                                    class="dropdown-item dropdown-item-template"
                                                                    data-variable="[phone_number]">
                                                                    <span>Phone Number</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button"
                                                                    class="dropdown-item dropdown-item-template"
                                                                    data-variable="[email_address]">
                                                                    <span>Email Address</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button"
                                                                    class="dropdown-item dropdown-item-template"
                                                                    data-variable="[first_name]">
                                                                    <span>First Name</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button"
                                                                    class="dropdown-item dropdown-item-template"
                                                                    data-variable="[last_name]">
                                                                    <span>Last Name</span>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button"
                                                                    class="dropdown-item dropdown-item-template"
                                                                    data-variable="[company]">
                                                                    <span>Company</span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="" id="template_preview" rows="6" class="input_field textarea_field"
                                                placeholder="Write a template..." value=""></textarea>
                                        </div>
                                        @error('sms_body')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" wire:ignore.self id="pills-profile2" role="tabpanel"
                                    aria-labelledby="pills-profile2-tab" tabindex="0">
                                    <label for="contactUploadImage" class="d-flex file_upload_area w-100"
                                        id="fileUploadLabel">
                                        <div class="import_icon">
                                            <img src="{{ asset('assets/app/icons/import.svg') }}"
                                                alt="import icon" />
                                        </div>
                                        <h4 id="dropText"><span>Click to upload</span> or drag and drop</h4>
                                        <h5>JPG, JPEG, PNG, PDF, GIF, and MP4 formats, up to 50MB</h5>
                                    </label>

                                    <!-- File Input -->
                                    <input type="file" id="contactUploadImage" accept="*" wire:model="file"
                                        class="position-absolute opacity-0 visually-hidden" />

                                    <!-- Error Message -->
                                    @error('file')
                                        <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror

                                    <div wire:loading wire:target='file' wire:key='file' style="font-size: 15px;">
                                        <i class="fa fa-spinner fa-spin"></i> Uploading...
                                    </div>

                                    @if ($file)
                                        <div class="uploading_status_area mb-5">
                                            <button type="button" class="close_btn"
                                                wire:click.prevent='resetUpload'>
                                                <img src="{{ asset('assets/app/icons/close.svg') }}"
                                                    alt="delete icon" />
                                            </button>
                                            <div class="file_name_grid">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                </svg>
                                                <div>
                                                    <h4>{{ $file->getClientOriginalName() }}</h4>
                                                    <div class="complete_status">
                                                        <div class="circle">
                                                            <img src="{{ asset('assets/app/icons/tick-circle.svg') }}"
                                                                alt="track icon" />
                                                        </div>
                                                        <h5>Completed</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview_area mt-24">
                    <div>
                        <div class="input_row">
                            <label for="">Preview</label>
                            <textarea name="" id="" class="input_field textarea_field" rows="8" readonly>{{ $sms_body }} {{ $opt_out_link ? '' . "\n" . '' . $appended_message : '' }}</textarea>
                            <h5 class="mt-1">1000 of characters</h5>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bulk_btn_grid mt-16">
                        <button type="button" class="schedule_btn" data-bs-toggle="modal"
                            data-bs-target="#scheduleModal">
                            @if ($selected_date && $selected_time)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            @endif Schedule
                        </button>
                        <button type="submit" class="msg_send_btn">{!! loadingStateWithText('storeConfirmation', 'Send Message') !!}</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Confirmation  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="storeConfirmationModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <form wire:submit.prevent='storeData' >
                            <div class="content_area text-center">
                                <h5 class="mb-3">Confirm Campaign Compliance</h5>

                                <div class="text-start">
                                    <p class="text-muted mb-3">
                                        Before sending your campaign, please confirm that your message complies with all applicable
                                        laws and regulations, including ensuring that:
                                        <br>
                                            ● All recipients have opted in to receive SMS messages.
                                        <br>
                                            ● The content of your message adheres to our platform’s guidelines and applicable laws
                                        (e.g., no prohibited content).
                                        By checking this box, you acknowledge that you are responsible for the compliance of this
                                        campaign.
                                    </p>
                                </div>

                                <label for="confirm_chk"><input type="checkbox" id="confirm_chk" required> I confirm that this campaign complies with all legal and regulatory requirements.</label>
                                <div class="text-center mt-4">
                                    <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                        data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" wire:loading.attr='disabled'
                                        class="delete_yes_btn">
                                        {!! loadingStateWithText('storeData', 'Send Message') !!}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="scheduleModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
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
                                    <input type="date" placeholder="Type Name" wire:model.live='schedule_date'
                                        class="input_field" />
                                    @error('schedule_date')
                                        <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Choose Time</label>
                                    <input type="time" placeholder="Type Subject" wire:model.live='schedule_time'
                                        class="input_field" />
                                    @error('schedule_time')
                                        <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='chooseTime' class="create_event_btn">
                            {!! loadingStateWithText('chooseTime', 'Choose Time') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('contactUploadImage');
            const label = document.getElementById('fileUploadLabel');
            const uploadText = document.getElementById('dropText');

            // Highlight label when dragging over it
            label.addEventListener('dragover', function(e) {
                e.preventDefault();
                label.classList.add('border-success');
                uploadText.textContent = 'Drop your file here';
            });

            label.addEventListener('dragleave', function(e) {
                e.preventDefault();
                label.classList.remove('border-success');
                $('#dropText').html('<span>Click to upload</span> or drag and drop');
            });

            label.addEventListener('drop', function(e) {
                e.preventDefault();
                label.classList.remove('border-success');

                // Assign the dropped file to the file input
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;

                    // Trigger the change event so Livewire can detect the file
                    var event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });
        });
    </script>

    <script>
        window.addEventListener('showStoreDataConfirmation', event => {
            $('#storeConfirmationModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#scheduleModal').modal('hide');
            $('#storeConfirmationModal').modal('hide');
        });

        window.addEventListener('reset_form', event => {
            $('#template_preview').val('');
            $('.preview_textarea_field').val('');
        });

        $(".smsType").on('click', function() {
            @this.set('sms_type', $(this).data('type'));
        });
    </script>
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
        const dropdownItems = document.querySelectorAll('.dropdown-item-template');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                let variable = this.getAttribute('data-variable');
                let textarea = document.getElementById('template_preview');

                // Get the cursor position in the textarea
                const cursorPosition = textarea.selectionStart;

                // Insert the variable at the cursor position
                const textBeforeCursor = textarea.value.substring(0, cursorPosition);
                const textAfterCursor = textarea.value.substring(cursorPosition);
                textarea.value = textBeforeCursor + variable + " " + textAfterCursor;

                // Move the cursor to the end of the inserted variable
                textarea.selectionStart = textarea.selectionEnd = cursorPosition + variable.length + 1;

                // Update Livewire and jQuery field
                @this.set('sms_body', textarea.value);
                $('.preview_textarea_field').val(textarea.value);

                // Refocus the textarea
                textarea.focus();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#template_preview').on('change', function() {
                var template = $(this).val();

                @this.set('sms_body', template);
                $('.preview_textarea_field').val(template);

            });

            $('#templateSelect').on('change', function(e) {
                e.preventDefault();

                const selectedOption = templateSelect.options[templateSelect.selectedIndex];
                const selectedId = selectedOption.getAttribute('data-id');
                const selectedPreviewMessage = selectedOption.value;

                $('#template_preview').val(selectedPreviewMessage);
                @this.set('sms_body', selectedPreviewMessage);
                $('.preview_textarea_field').val(selectedPreviewMessage);
                @this.set('selected_template_preview', selectedPreviewMessage);
                @this.set('inbox_template_id', selectedId);

            });

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
                timeZone: '{{ config('app.timezone') }}',
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
