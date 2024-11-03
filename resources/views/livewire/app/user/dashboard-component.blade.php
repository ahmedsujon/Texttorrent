<div>
    <main class="main_content_wrapper" wire:ignore>
        <!-- Dashboard Section  -->
        <section class="dashboard_overview_wrapper">
            <div class="d-flex align-items-center flex-wrap gap-1">
                <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
                <h2 class="dashboard_title">Dashboard</h2>
            </div>
            <div class="overview_grid mt-32">
                <div class="item_grid">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-outgoing-01.svg') }}"
                            alt="message outgoing icon" />
                    </div>
                    <div>
                        <h3>Delivered messages</h3>
                        <h4>443</h4>
                    </div>
                </div>
                <div class="item_grid responded_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-done-01.svg') }}" alt="message done icon" />
                    </div>
                    <div>
                        <h3>Responded messages</h3>
                        <h4>32</h4>
                    </div>
                </div>
                <div class="item_grid undelivered_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-delay-01.svg') }}" alt="message delay icon" />
                    </div>
                    <div>
                        <h3>Undelivered</h3>
                        <h4>0</h4>
                    </div>
                </div>
                <div class="item_grid stopped_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-cancel-01.svg') }}" alt="message cancel icon" />
                    </div>
                    <div>
                        <h3>Stopped</h3>
                        <h4>0</h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- Analytics Chart Section  -->
        <section class="analytics_chart_section">
            <div class="d-flex-between gap-3">
                <div class="title_area d-flex align-items-center flex-wrap gap-3">
                    <h2>Analytics</h2>
                    <div class="month_area" id="monthFilterLists">
                        <button type="button" class="active_month">12 months</button>
                        <button type="button">30days</button>
                        <button type="button">7days</button>
                    </div>
                </div>
                <div class="date_range_area d-flex align-items-center flex-wrap gap-2">
                    <div>
                        <div class="date_range_input_area" id="reportrange">
                            <img src="{{ asset('assets/app/icons/calender.svg') }}" alt="calender icon" />
                            &nbsp;
                            <span> </span>
                            <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="arrow down icon"
                                class="ms-1" />
                        </div>
                    </div>
                    <div class="custom_switch_area">
                        <label class="switch">
                            <input type="checkbox" checked />
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <h4>Date range</h4>
                </div>
            </div>
            <div class="chart_area" id="analyticsChart"></div>
        </section>
        <!-- Credit And Activity Section  -->
        <section class="credit_activity_wrapper mt-24">
            <div class="credit_outer_grid">
                <div class="credit_area">
                    <div class="d-flex-between">
                        <h3 class="credit_title">Buy Credits</h3>
                        <button type="button" class="amount_btn" style="color: black; background-color: #e5f9fe;">
                            Credits left: {{ $total_credits }}
                        </button>
                        <button type="button" class="amount_btn">Pay $1000</button>
                    </div>
                    <div class="amount_area mt-24">
                        <h4>Amount</h4>
                        <div class="number">$1000.00</div>
                    </div>
                    <div class="range_area mt-24">
                        <div class="container_container">
                            <div id="slider"></div>
                        </div>
                    </div>

                    <div class="added_amount">
                        Credits Added: <span class="credit_title"> 200,000</span>
                    </div>
                    <div class="bonus_outer_grid">
                        <div class="bonus_grid">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/bonus.svg') }}" alt="bonus" />
                            </div>
                            <div>
                                <h4>Bonus Credits</h4>
                                <h5>0</h5>
                            </div>
                        </div>
                        <div class="bonus_grid">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/bonus.svg') }}" alt="bonus" />
                            </div>
                            <div>
                                <h4>Total Credits</h4>
                                <h5>{{ $total_credits }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="activity_area">
                    <h3 class="credit_title">Activity</h3>
                    <div class="activity_item_area">
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>Today, 3:23 PM</h4>
                                <h5>Messages accepted with attachments.</h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>Fri, 4:12 AM</h4>
                                <h5>
                                    Send email notifications of subscriptions and deletions to
                                    list owner.
                                </h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>1 week ago</h4>
                                <h5>Messages accepted with attachments.</h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>1 week ago</h4>
                                <h5>
                                    Send email notifications of subscriptions and deletions to
                                    list owner.
                                </h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>2 month ago</h4>
                                <h5>Messages accepted with attachments.</h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>2 month ago</h4>
                                <h5>
                                    Send email notifications of subscriptions and deletions to
                                    list owner.
                                </h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>2 month ago</h4>
                                <h5>Messages accepted with attachments.</h5>
                            </div>
                        </div>
                        <div class="acitivity_item">
                            <div class="icon">
                                <img src="{{ asset('assets/app/icons/message-001.svg') }}" alt="message icon" />
                            </div>
                            <div>
                                <h4>2 month ago</h4>
                                <h5>
                                    Send email notifications of subscriptions and deletions to
                                    list owner.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Calender Section  -->
        <section class="dashboard_calender_wrapper mt-24">
            <div class="calender_full_area">
                <div id="calendar"></div>
            </div>
        </section>
    </main>

    <!-- Edit Event Content Modal  -->
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
                                        <img src="{{ asset('assets/app/icons/clock-01.svg') }}" alt="clock icon" />
                                    </div>
                                    <h6>{{ Carbon\Carbon::parse($selectedEvent->date)->format('l, M j') }} -
                                        {{ Carbon\Carbon::parse($selectedEvent->time)->format('h:i A') }}</h6>
                                </div>
                                <div class="two_grid">
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                        </div>
                                        <h6>{{ user()->first_name }} {{ user()->last_name }}</h6>
                                    </div>
                                    <div class="icon_grid">
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/mail-02.svg') }}" alt="mail icon" />
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
                                    </div>
                                </div>
                            </div>
                            <div class="action_area d-flex align-items-center justify-content-end flex-wrap gap-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var options = {
            series: [{
                    name: "Delivered messages",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 160, 170, 180],
                },
                {
                    name: "Responded messages",
                    data: [30, 41, 45, 80, 90, 80, 120, 160, 148, 49, 62, 69],
                },
                {
                    name: "Undelivered",
                    data: [50, 141, 235, 351, 449, 262, 369, 291, 148, 160, 170, 180],
                },
                {
                    name: "Stopped",
                    data: [0, 20, 100, 80, 70, 60, 220, 185, 168, 149, 162, 169],
                },
            ],
            chart: {
                height: 450,
                type: "line",
                zoom: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "top",
            },
            stroke: {
                curve: "smooth",
            },
            markers: {
                size: 3,
            },
            colors: ["#4152EC", "#38DBFE", "#9271F0", "#0C0D0E"],
            // title: {
            //   text: "Product Trends by Month",
            //   align: "left",
            // },
            grid: {
                row: {
                    colors: ["transparent", "transparent"], // takes an array which will be repeated on columns
                    opacity: 0.7,
                },
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#analyticsChart"),
            options
        );
        chart.render();
    </script>

    <script>
        window.addEventListener('viewEventDetails', event => {
            const myModal = new bootstrap.Modal("#editEventModalBtn", {
                backdrop: "static",
            });
            myModal.show();
        });
    </script>

    <!-- Calender Month View  -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById("calendar");

            const jsonData = @json($events);

            const today = new Date();
            const initDate = today.toISOString().split('T')[0];

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: initDate,
                eventClick: function(arg) {
                    const eventId = arg.event.id;
                    @this.viewData(eventId);
                },
                editable: false,
                selectable: false,
                businessHours: false,
                dayMaxEvents: 2, // allow "more" link when too many events
                height: "650px",
                events: JSON.parse(jsonData)
            });

            calendar.render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const MAXIMUMVALUE = 4000;

            //Format Label
            function formatLabel(value) {
                console.log("formatLabel - value:", value);
                if (value >= 1000) {
                    return value / 1000 + "k";
                }
                return value;
            }

            //Calculate Percentage Value
            function formatPercentage(value) {
                if (value !== 0) {
                    return (value / MAXIMUMVALUE) * 100;
                }
                return 0;
            }

            const slider = document.getElementById("slider");
            noUiSlider.create(slider, {
                range: {
                    min: 0,
                    max: MAXIMUMVALUE,
                },
                start: [1000],
                connect: "lower",
                pips: {
                    mode: "count",
                    values: 5,
                    format: {
                        to: function(value) {
                            return (
                                formatLabel(value) +
                                `<div class='percentage_icon'> <span>  ${formatPercentage(
                  value
                )} %</span>  <img src="{{ asset('assets/app/icons/bonus2.svg') }}" alt="bonus icon"> </div> `
                            );
                        },
                        from: function(value) {
                            return value.replace("k", "000").replace(" 🥇", "");
                        },
                    },
                },
            });
            // Disable the slider
            // slider.setAttribute("disabled", true);
        });
    </script>
@endpush
