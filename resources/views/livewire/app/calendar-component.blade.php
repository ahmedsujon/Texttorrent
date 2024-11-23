@section('page_title') TextTorrent | Calendar @endsection
<div>
    <main class="main_content_wrapper">
        <!-- Calender Section  -->
        <section class="calender_wrapper">
            <div class="d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <button type="button" class="plus_new_btn" data-bs-toggle="modal" data-bs-target="#eventModal">
                        <img src="{{ asset('assets/app/icons/plus.svg') }}" alt="plus icon" />
                        <span>New Event</span>
                    </button>
                </div>

                <ul class="calender_variant_list d-flex align-items-center flex-wrap">
                    <li>
                        <div class="send"></div>
                        <span>Sent</span>
                    </li>
                    <li>
                        <div class="sms"></div>
                        <span>Sms Scheduled</span>
                    </li>
                </ul>
                {{-- <form action="" class="calender_search_area">
                    <button type="submit" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search.svg') }}" alt="search icon" />
                    </button>
                    <input type="search" placeholder="Search anything..." class="input_filed" id="calenderSearch" />
                    <img class="slash_icon" src="{{ asset('assets/app/icons/slash.svg') }}" alt="slash icon" />
                </form> --}}
            </div>
            <div class="calender_full_area" wire:ignore>
                <div id="calendarFull"></div>
            </div>
        </section>

        <!-- New Event Modal  -->
        <div class="modal fade common_modal" wire:ignore.self id="eventModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Create New Event
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="event_form_area">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" wire:model.blur='name' placeholder="Type Name"
                                    class="input_field" />
                                @error('name')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" wire:model.blur='subject' placeholder="Type Subject"
                                    class="input_field" />
                                @error('subject')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" wire:model.blur='date' placeholder="Type Name"
                                        class="input_field" />
                                    @error('date')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" wire:model.blur='time' placeholder="Type Subject"
                                        class="input_field" />
                                    @error('time')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Sender</label>
                                <select name="lang" wire:model.blur='sender_number'
                                    class="js-searchBox sender_number">
                                    <option value="">Choose Sender</option>
                                    @foreach ($active_numbers as $active_number)
                                        <option value="{{ $active_number->number }}">{{ $active_number->number }}
                                        </option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />

                            </div>
                            @error('sender_number')
                                <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Alert Before</label>
                                <select name="lang" wire:model.blur='alert_before' class="js-searchBox alert_before">
                                    <option value="0">Select Minutes</option>
                                    <option value="10">10 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="40">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                                @error('alert_before')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="partipants_area">
                                <div class="d-flex-between">
                                    <h3>Participants</h3>
                                    {{-- <button type="button" class="border_btn" id="addNew">
                                        Add New
                                    </button> --}}
                                </div>
                            </div>
                            <div class="participants_user_area" id="participantsArea">
                                <div class="two_grid">
                                    <div class="input_row searchable_select" wire:ignore>
                                        <label for="">Phone Number</label>
                                        <select name="lang" wire:model.blur='participant_number'
                                            class="js-searchBox participant_number">
                                            <option value="">Choose Number</option>
                                            @foreach ($participant_numbers as $participant_number)
                                                <option value="{{ $participant_number->number }}">{{ $participant_number->number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                        @error('participant_number')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" wire:model.blur='participant_email'
                                            placeholder="Type Participant Email" class="input_field" />
                                        @error('participant_email')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='storeData' class="create_event_btn">
                            {!! loadingStateWithText('storeData', 'Save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Event Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="editEventFormModal" tabindex="-1"
            aria-labelledby="editEventFormModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventFormModal">
                            Edit Event
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="event_form_area" wire:submit.prevent='updateData'>
                        <div class="modal-body">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" wire:model.blur='name' placeholder="Type Name"
                                    class="input_field" />
                                @error('name')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" wire:model.blur='subject' placeholder="Type Subject"
                                    class="input_field" />
                                @error('subject')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" wire:model.blur='date' placeholder="Type Name"
                                        class="input_field" />
                                    @error('date')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" wire:model.blur='time' placeholder="Type Subject"
                                        class="input_field" />
                                    @error('time')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Sender</label>
                                <select name="lang" wire:model.blur='sender_number'
                                    class="js-searchBox sender_number">
                                    <option value="">Choose Sender</option>
                                    @foreach ($active_numbers as $active_number)
                                        <option value="{{ $active_number->number }}">{{ $active_number->number }}
                                        </option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />

                            </div>
                            @error('sender_number')
                                <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Alert Before</label>
                                <select name="lang" wire:model.blur='alert_before'
                                    class="js-searchBox alert_before">
                                    <option value="0">Select Minutes</option>
                                    <option value="10">10 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="40">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                                @error('alert_before')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="partipants_area">
                                <div class="d-flex-between">
                                    <h3>Participants</h3>
                                    {{-- <button type="button" class="border_btn" id="addNew">
                                        Add New
                                    </button> --}}
                                </div>
                            </div>
                            <div class="participants_user_area" id="participantsArea">
                                <div class="two_grid">
                                    <div class="input_row searchable_select" wire:ignore>
                                        <label for="">Phone Number</label>
                                        <select name="lang" wire:model.blur='participant_number'
                                            class="js-searchBox participant_number">
                                            <option value="">Choose Number</option>
                                            @foreach ($participant_numbers as $participant_number)
                                                <option value="{{ $participant_number->number }}">{{ $participant_number->number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                        @error('participant_number')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" wire:model.blur='participant_email'
                                            placeholder="Type Participant Email" class="input_field" />
                                        @error('participant_email')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('updateData', 'Update Event') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Event Content Modal  -->
        <div class="modal fade edit_event_modal" id="editEventModalBtn" tabindex="-1"
            aria-labelledby="editEventModalBtn" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="event_edit_grid">
                            <div class="dot"></div>
                            @if ($selectedEvent)
                                <div class="content_area">
                                    <h2>{{ $selectedEvent->name }}</h2>
                                    <h3>
                                        Subject:
                                        <span> {{ $selectedEvent->subject }}</span>
                                    </h3>
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/clock-01.svg') }}"
                                                alt="clock icon" />
                                        </div>
                                        <h6>{{ Carbon\Carbon::parse($selectedEvent->date)->format('l, M j') }} -
                                            {{ Carbon\Carbon::parse($selectedEvent->time)->format('h:i A') }}</h6>
                                    </div>
                                    <div class="two_grid">
                                        <div class="icon_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/user.svg') }}"
                                                    alt="user icon" />
                                            </div>
                                            <h6>{{ user()->first_name }} {{ user()->last_name }}</h6>
                                        </div>
                                        <div class="icon_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/mail-02.svg') }}"
                                                    alt="mail icon" />
                                            </div>
                                            <h6 class="email">{{ user()->email }}</h6>
                                        </div>
                                    </div>
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/notification-02.svg') }}"
                                                alt="notification icon" />
                                        </div>
                                        <h6>{{ $selectedEvent->alert_before }} minutes before</h6>
                                    </div>
                                    <div class="participant_area" id="participantListArea">
                                        <h4>Participants</h4>
                                        <div class="participant_user_grid">
                                            <div class="user_icon">
                                                <img src="{{ asset('assets/app/icons/user-multiple.svg') }}"
                                                    alt="user icon" />
                                            </div>
                                            <div>
                                                <h5>{{ $selectedEvent->participant_email }}</h5>
                                                <h6>{{ $selectedEvent->participant_number }}</h6>
                                            </div>
                                            {{-- <div class="delete_icon">
                                            <button type="button">
                                                <img src="{{ asset('assets/app/icons/elements.svg') }}"
                                                    alt="cross icon" />
                                            </button>
                                        </div> --}}
                                        </div>
                                        {{-- <div class="participant_user_grid">
                                        <div class="user_icon">
                                            <img src="{{ asset('assets/app/icons/user-multiple.svg') }}"
                                                alt="user icon" />
                                        </div>
                                        <div>
                                            <h5>hi.geto@gmail.com</h5>
                                            <h6>(480) 555-0103</h6>
                                        </div>
                                        <div class="delete_icon">
                                            <button type="button">
                                                <img src="{{ asset('assets/app/icons/elements.svg') }}"
                                                    alt="cross icon" />
                                            </button>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap gap-1">
                                    <button type="button" class="action_btn"
                                        wire:click.prevent='editData({{ $selectedEvent->id }})'>
                                        {!! loadingStateWithoutText(
                                            'editData(' . $selectedEvent->id . ')',
                                            '<img src="' . asset('assets/app/icons/pencil.svg') . '" alt="pencil icon" />',
                                        ) !!}
                                    </button>
                                    <button type="button" class="action_btn" id="openSecondModalBtn"
                                        wire:click.prevent='deleteConfirmation({{ $selectedEvent->id }})'>
                                        {!! loadingStateWithoutText(
                                            'deleteConfirmation(' . $selectedEvent->id . ')',
                                            '<img src="' . asset('assets/app/icons/delete-pin.svg') . '" alt="pencil icon" />',
                                        ) !!}
                                    </button>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="deleteDataModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to permanently delete this event?</h2>
                            <h4>Once deleted, this event will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='deleteData' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('deleteData', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('scripts')
    <script>
        $(".sender_number").on('change', function() {
            @this.set('sender_number', $(this).val());
        });
        $(".alert_before").on('change', function() {
            @this.set('alert_before', $(this).val());
        });
        $(".participant_number").on('change', function() {
            @this.set('participant_number', $(this).val());
        });

        $(".edit_sender_number").on('change', function() {
            @this.set('sender_number', $(this).val());
        });
        $(".edit_alert_before").on('change', function() {
            @this.set('alert_before', $(this).val());
        });
        $(".edit_participant_number").on('change', function() {
            @this.set('participant_number', $(this).val());
        });
    </script>

    <script>
        window.addEventListener('closeModal', event => {
            $('#eventModal').modal('hide');
            $('#editEventFormModal').modal('hide');
        });
        window.addEventListener('show_delete_confirmation_event', event => {
            const myModal = new bootstrap.Modal("#deleteDataModal", {
                backdrop: "static",
            });
            myModal.show();
            setTimeout(() => {
                $('#editEventModalBtn').modal('hide');
            }, 100);
        });

        window.addEventListener('viewEventDetails', event => {
            const myModal = new bootstrap.Modal("#editEventModalBtn", {
                backdrop: "static",
            });
            myModal.show();
        });

        window.addEventListener('showEditModal', event => {
            const myModal = new bootstrap.Modal("#editEventFormModal", {
                backdrop: "static",
            });
            myModal.show();
            setTimeout(() => {
                $('.modal-body').click();
                $('#editEventModalBtn').modal('hide');
            }, 100);
        });

        window.addEventListener('event_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "Event has been deleted successfully",
                "success"
            );
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            //Focus search on slash button press
            document.addEventListener("keyup", (e) => {
                if (e.code !== "Slash") return;

                e.preventDefault();
                document.getElementById("calenderSearch").focus();
            });

            //Calender
            var calendarEl = document.getElementById("calendarFull");

            const jsonData = @json($events);

            const today = new Date();
            const initDate = today.toISOString().split('T')[0];

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "title ",
                    center: "dayGridMonth,timeGridWeek,timeGridDay",
                    right: "today,prev,next",
                },
                buttonText: {
                    today: "Today",
                    month: "Month",
                    week: "Week",
                    day: "Day",
                },
                initialDate: initDate,
                validRange: {
                    start: new Date().toISOString().split('T')[0]
                },
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: false,
                select: function(arg) {
                    @this.setDateTime(arg.startStr);
                    const myModal = new bootstrap.Modal("#eventModal", {
                        backdrop: "static",
                    });
                    myModal.show();
                },
                eventClick: function(arg) {
                    const eventId = arg.event.id;
                    @this.viewData(eventId);
                },
                editable: true,
                dayMaxEvents: 2, // allow "more" link when too many events
                height: "auto",
                displayEventEnd: true,
                eventTimeFormat: {
                    // Use this to format the event time display
                    hour: "2-digit",
                    minute: "2-digit",
                    meridiem: true, // Set to true for AM/PM format
                    hour12: true, // Set to true if you want to show 12-hour format
                },
                events: JSON.parse(jsonData),
            });

            calendar.render();


            // Fetch and load events
            function loadEvents() {
                $.ajax({
                    url: '/get-live-calender-events',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        calendar.removeAllEvents();
                        calendar.addEventSource(data);
                    }
                });
            }

            window.addEventListener('refreshCalendar', event => {
                loadEvents();
            });
        });
    </script>
@endpush
