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
                    <li>
                        <div class="voice"></div>
                        <span>Voice Scheduled</span>
                    </li>
                </ul>
                <form action="" class="calender_search_area">
                    <button type="submit" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search.svg') }}" alt="search icon" />
                    </button>
                    <input type="search" placeholder="Search anything..." class="input_filed" id="calenderSearch" />
                    <img class="slash_icon" src="{{ asset('assets/app/icons/slash.svg') }}" alt="slash icon" />
                </form>
            </div>
            <div class="calender_full_area">
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
                        <button type="button" wire:click.prevent='resetForm' class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="event_form_area">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" wire:model.blur='name' placeholder="Type Name"
                                    class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" wire:model.blur='subject' placeholder="Type Subject"
                                    class="input_field" />
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" wire:model.blur='date' placeholder="Type Name"
                                        class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" wire:model.blur='time' placeholder="Type Subject"
                                        class="input_field" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Sender</label>
                                <select name="lang" wire:model.blur='sender_number' class="js-searchBox">
                                    <option value="">Choose Sender</option>
                                    <option value="1">Python</option>
                                    <option value="2">Java</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Alert Before</label>
                                <select name="lang" wire:model.blur='alert_before' class="js-searchBox">
                                    <option value="0">Select Minutes</option>
                                    <option value="10">10 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="40">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
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
                                    <div class="input_row searchable_select">
                                        <label for="">Phone Number</label>
                                        <select name="lang" wire:model.blur='participant_number'
                                            class="js-searchBox">
                                            <option value="">Select Phone Number</option>
                                            <option value="1">0170000001</option>
                                            <option value="2">0170000002</option>
                                            <option value="3">0170000003</option>
                                            <option value="4">0170000004</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" wire:model.blur='participant_email'
                                            placeholder="Type Participant Email" class="input_field" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn"
                            data-bs-dismiss="modal">
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
        <div class="modal fade common_modal" id="editEventFormModal" tabindex="-1"
            aria-labelledby="editEventFormModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventFormModal">
                            Edit Event
                        </h1>
                        <button type="button" class="btn-close" id="eventEventTopCloseBtn"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" placeholder="Type Name" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" placeholder="Type Subject" class="input_field" />
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" placeholder="Type Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" placeholder="Type Subject" class="input_field" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Sender</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Sender</option>
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
                            <div class="input_row searchable_select">
                                <label for="">From Email</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Email</option>
                                    <option value="1">example@gmail.com</option>
                                    <option value="2">example1@gmail.com</option>
                                    <option value="3">example2@gmail.com</option>
                                    <option value="4">example3@gmail.com</option>
                                    <option value="5">example4@gmail.com</option>
                                    <option value="6">example5@gmail.com</option>
                                    <option value="7">example6@gmail.com</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="checkbox_area d-flex align-items-center flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fromPhone" />
                                    <label class="form-check-label mb-0" for="fromPhone">
                                        From Phone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fromEmail" />
                                    <label class="form-check-label mb-0" for="fromEmail">
                                        From Email
                                    </label>
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Alert Before</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select Minutes</option>
                                    <option value="1">10 Minutes</option>
                                    <option value="2">20 Minutes</option>
                                    <option value="3">30 Minutes</option>
                                    <option value="4">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="partipants_area">
                                <div class="d-flex-between">
                                    <h3>Participants</h3>
                                    <button type="button" class="border_btn" id="editAddNew">
                                        Add New
                                    </button>
                                </div>
                            </div>
                            <div class="participants_user_area" id="editParticipantsArea">
                                <div class="two_grid">
                                    <div class="input_row searchable_select">
                                        <label for="">Phone Number</label>
                                        <select name="lang" class="js-searchBox">
                                            <option value="">Select Phone Number</option>
                                            <option value="1">0170000001</option>
                                            <option value="2">0170000002</option>
                                            <option value="3">0170000003</option>
                                            <option value="4">0170000004</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" placeholder="Type Participant Email"
                                            class="input_field" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" id="editEventFormModalCloseBtn">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">
                            Update Event
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Event Content Modal  -->
        <div class="modal fade edit_event_modal" id="editEventModalBtn" tabindex="-1"
            aria-labelledby="editEventModalBtn" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="event_edit_grid">
                            <div class="dot"></div>
                            <div class="content_area">
                                <h2>Meeting with Cameron Williamson for wecraft logo</h2>
                                <h3>
                                    Subject:
                                    <span> Lorem ipsum dolor sit amet, consectetur lodo</span>
                                </h3>
                                <div class="icon_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/clock-01.svg') }}" alt="clock icon" />
                                    </div>
                                    <h6>Friday, Mar 10 - 11:15 AM - 11:45 PM</h6>
                                </div>
                                <div class="two_grid">
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                        </div>
                                        <h6>Royal Parvej</h6>
                                    </div>
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/mail-02.svg') }}" alt="mail icon" />
                                        </div>
                                        <h6 class="email">hi.rooyal@gmail.com</h6>
                                    </div>
                                </div>
                                <div class="icon_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/notification-02.svg') }}"
                                            alt="notification icon" />
                                    </div>
                                    <h6>30 minutes before</h6>
                                </div>
                                <div class="participant_area" id="participantListArea">
                                    <h4>Participants</h4>
                                    <div class="participant_user_grid">
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
                                    </div>
                                    <div class="participant_user_grid">
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
                                    </div>
                                </div>
                            </div>
                            <div class="action_area d-flex align-items-center justify-content-end flex-wrap gap-1">
                                <button type="button" class="action_btn" id="editEventFormModalBtn">
                                    <img src="{{ asset('assets/app/icons/pencil.svg') }}" alt="pencil icon" />
                                </button>
                                <button type="button" class="action_btn" id="openSecondModalBtn">
                                    <img src="{{ asset('assets/app/icons/delete-pin.svg') }}" alt="delete icon" />
                                </button>
                                <div class="dropdown bootstrap_dropdown">
                                    <button class="action_btn dropdown-toggle hide_dropdown_arrow" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/app/icons/more-2-linepng') }}" alt="more  icon" />
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">Drop down menu 1</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Drop down menu 1</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Drop down menu 1</a>
                                        </li>
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete  Modal  -->
        <div class="modal fade delete_modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to permanently delete this event?</h2>
                            <h4>Once deleted, this event will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn">
                                    Cancel
                                </button>
                                <button type="button" class="delete_yes_btn">Yes</button>
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
        document.addEventListener("DOMContentLoaded", () => {
            //Focus search on slash button press
            document.addEventListener("keyup", (e) => {
                if (e.code !== "Slash") return;

                e.preventDefault();
                document.getElementById("calenderSearch").focus();
            });

            //Calender
            var calendarEl = document.getElementById("calendarFull");

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
                initialDate: "2023-01-12",
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: false,
                select: function(arg) {
                    const myModal = new bootstrap.Modal("#eventModal", {
                        backdrop: "static",
                    });
                    myModal.show();
                },
                eventClick: function(arg) {
                    const myModal = new bootstrap.Modal("#editEventModalBtn", {
                        backdrop: "static",
                    });
                    myModal.show();
                },
                editable: true,
                dayMaxEvents: 2, // allow "more" link when too many events
                height: "auto",
                displayEventEnd: true,
                eventTimeFormat: {
                    // Use this to format the event time display
                    hour: "2-digit",
                    minute: "2-digit",
                    meridiem: false, // Set to true for AM/PM format
                    hour12: false, // Set to true if you want to show 12-hour format
                },
                events: [
                    // {
                    //   title: "All Day Event",
                    //   start: "2023-01-01",
                    //   backgroundColor: "#ffcdb3",
                    // },
                    {
                        title: "7:35P: airport",
                        start: "2023-01-07",
                        end: "2023-01-09",
                        backgroundColor: "#b4f3d1",
                    },
                    {
                        groupId: 999,
                        title: "7:35P: train",
                        start: "2023-01-09",
                        backgroundColor: "#B1E5FC",
                    },
                    {
                        groupId: 991,
                        title: "7:35P: train 2",
                        start: "2023-01-09",
                        backgroundColor: "#B1E5FC",
                    },
                    {
                        groupId: 992,
                        title: "7:35P: train 3",
                        start: "2023-01-09",
                        backgroundColor: "#B1E5FC",
                    },
                    {
                        groupId: 992,
                        title: "7:35P: train 4",
                        start: "2023-01-09",
                        backgroundColor: "#B1E5FC",
                    },
                    {
                        groupId: 999,
                        title: "7:35P: Bus",
                        start: "2023-01-16",
                        backgroundColor: "#d0c5ff",
                    },
                    {
                        title: "Conference",
                        start: "2023-01-11",
                        end: "2023-01-11",
                        backgroundColor: "#B1E5FC",
                    },
                    {
                        title: "Meeting",
                        start: "2023-01-12T10:30:00",
                        end: "2023-01-12T02:59:00",
                        // backgroundColor: "#B1E5FC",
                        // eventBackgroundColor: "#d0c5ff",
                        classNames: ["send_event"],
                    },
                    {
                        title: "Meeting with client",
                        start: "2023-01-15T10:30:00",
                        end: "2023-01-15T12:30:00",
                        // backgroundColor: "#B1E5FC",
                        // eventBackgroundColor: "#d0c5ff",
                        classNames: ["sms_event"],
                    },
                    {
                        title: "Meeting with client",
                        start: "2023-01-24T10:30:00",
                        end: "2023-01-24T12:30:00",
                        // backgroundColor: "#B1E5FC",
                        // eventBackgroundColor: "#d0c5ff",
                        classNames: ["voice_event"],
                    },
                    // {
                    //   title: "Lunch",
                    //   start: "2023-01-12T12:00:00",
                    // },

                    {
                        title: "Click for Google",
                        url: "http://google.com/",
                        start: "2023-01-28",
                        backgroundColor: "#d0c5ff",
                    },
                ],
            });

            calendar.render();

            //Get edit content modal
            const editModalActionEl = document.getElementById("editEventModalBtn");
            const toggleEditModalBackdrop = (isShow = true) => {
                if (isShow) {
                    editModalActionEl.style.zIndex = "1055";
                } else {
                    editModalActionEl.style.zIndex = "1040";
                }
            };

            //Edit form modal
            const editEventFormModalBtn = document.querySelector(
                "#editEventFormModalBtn"
            );
            const editEventFormModalCloseBtn = document.querySelector(
                "#editEventFormModalCloseBtn"
            );
            const eventEventTopCloseBtn = document.querySelector(
                "#eventEventTopCloseBtn"
            );
            const editEventModal = new bootstrap.Modal("#editEventFormModal", {
                backdrop: false,
            });

            if (editEventFormModalBtn) {
                editEventFormModalBtn.addEventListener("click", () => {
                    editEventModal.show();
                    //Hide event modal for show backdrop overlay
                    toggleEditModalBackdrop(false);
                });
            }
            if (editEventFormModalCloseBtn) {
                editEventFormModalCloseBtn.addEventListener("click", () => {
                    editEventModal.hide();
                    //Show event modal
                    toggleEditModalBackdrop();
                });
            }
            if (eventEventTopCloseBtn) {
                eventEventTopCloseBtn.addEventListener("click", () => {
                    editEventModal.hide();
                    //Show event modal
                    toggleEditModalBackdrop();
                });
            }

            //Delete modal functionality
            const deleteModalActionBtn =
                document.getElementById("openSecondModalBtn");
            const deleteModalCloseBtn = document.getElementById(
                "deleteModalCloseBtn"
            );
            const deleteModal = new bootstrap.Modal("#deleteModal", {
                backdrop: false,
            });

            if (deleteModalActionBtn) {
                deleteModalActionBtn.addEventListener("click", function() {
                    deleteModal.show();

                    //Hide event modal for show backdrop overlay
                    toggleEditModalBackdrop(false);
                });
            }
            if (deleteModalCloseBtn) {
                deleteModalCloseBtn.addEventListener("click", function() {
                    deleteModal.hide();
                    //Show event modal
                    toggleEditModalBackdrop();
                });
            }

            //Participant delete modal action
            const getParticipantListEl = document.querySelectorAll(
                "#participantListArea .delete_icon button"
            );
            if (getParticipantListEl) {
                getParticipantListEl.forEach((item) => {
                    item.addEventListener("click", () => {
                        deleteModal.show();

                        //Hide event modal for show backdrop overlay
                        toggleEditModalBackdrop(false);
                    });
                });
            }
        });
    </script>
@endpush
