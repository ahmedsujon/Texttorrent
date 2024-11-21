@section('page_title') TextTorrent | Dashboard @endsection
<div>
    <style>
        .bonus-percentage-labels {
            display: flex;
            justify-content: space-between;
            /* padding: 0 10px; */
            font-weight: normal;
            font-size: 12px;
            color: #333;
            margin-bottom: 8px;
            /* Adjust for spacing above the slider */
        }

        .percentage-label {
            position: absolute;
            top: -30px;
            /* Adjust for alignment */
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            transform: translateX(-50%);
            color: #333;
        }
    </style>

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
                        <h4>{{ $delivered_message }}</h4>
                    </div>
                </div>
                <div class="item_grid responded_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-done-01.svg') }}" alt="message done icon" />
                    </div>
                    <div>
                        <h3>Responded messages</h3>
                        <h4>{{ $responded_message }}</h4>
                    </div>
                </div>
                <div class="item_grid undelivered_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-delay-01.svg') }}" alt="message delay icon" />
                    </div>
                    <div>
                        <h3>Undelivered</h3>
                        <h4>{{ $un_delivered_message }}</h4>
                    </div>
                </div>
                <div class="item_grid stopped_item">
                    <div class="icon">
                        <img src="{{ asset('assets/app/icons/message-cancel-01.svg') }}" alt="message cancel icon" />
                    </div>
                    <div>
                        <h3>Stopped</h3>
                        <h4>{{ $stopped_message }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- Analytics Chart Section  -->
        <section class="analytics_chart_section" wire:ignore>
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
                @if (isUserPermitted('sms-credits'))
                    <div class="credit_area">
                        <div class="d-flex-between">
                            <h3 class="credit_title">Buy Credits</h3>
                            <button type="button" class="amount_btn" style="color: black; background-color: #e5f9fe;">
                                Credits left: {{ $credits_left }}
                            </button>
                            <button type="button" class="amount_btn amount_btn_pay" wire:click.prevent='buyCredit'>Pay
                                $1000</button>
                        </div>
                        <div class="amount_area mt-24">
                            <h4>Amount</h4>
                            <div class="number">$1000.00</div>
                        </div>
                        <div class="range_area mt-24">
                            <!-- Bonus percentage labels -->
                            {{-- <div class="bonus-percentage-labels">
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 0%</span>
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 10%</span>
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 20%</span>
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 30%</span>
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 40%</span>
                                <span><img src="{{ asset('assets/app/icons/bonus2.svg') }}"> 50%</span>
                            </div> --}}
                            <div class="container_container">
                                <div id="slider"></div>
                            </div>
                        </div>

                        <div class="added_amount">
                            Credits Added: <span class="credit_title">200,000</span>
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
                                    <h5>{{ $totalCredits }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
        @if (isUserPermitted('calendar'))
            <section class="dashboard_calender_wrapper mt-24">
                <div class="calender_full_area">
                    <div id="calendar"></div>
                </div>
            </section>
        @endif
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
                    data: @json($chartData['delivered_messages']),
                },
                {
                    name: "Responded messages",
                    data: @json($chartData['responded_messages']),
                },
                {
                    name: "Undelivered",
                    data: @json($chartData['undelivered']),
                },
                {
                    name: "Stopped",
                    data: @json($chartData['stopped']),
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
            const MAXIMUMVALUE = 10000; // Maximum slider value for 4K

            // Function to format label (e.g., 1000 -> 1K)
            function formatLabel(value) {
                return value >= 1000 ? (value / 1000) + "K" : value;
            }

            // Function to determine credit cost based on amount
            function getCreditCost(amount) {
                // if (amount <= 1000) return 0.0050;
                // if (amount <= 2000) return 0.0045;
                // if (amount <= 3000) return 0.0043;
                // return 0.0041;
                return 0.005;
            }

            // Function to determine bonus percentage based on amount
            function getBonusPercentage(amount) {
                if (amount < 1000) return 0;
                if (amount < 2000) return 10;
                if (amount < 3000) return 20;
                if (amount < 5000) return 30;
                if (amount < 7500) return 40;
                if (amount <= 10000) return 50;
            }

            // Create the slider
            const slider = document.getElementById("slider");
            noUiSlider.create(slider, {
                range: {
                    min: 0,
                    max: MAXIMUMVALUE,
                },
                start: [0],
                step: 100, // Set step increment to 100
                connect: "lower",
                pips: {
                    mode: "positions",
                    values: [0, 10, 20, 30, 50, 75, 100], // Positions for 0, 1K, 2K, 3K, 4K ...
                    density: 1,
                    format: {
                        to: function(value) {
                            return formatLabel(value);
                        },
                        from: function(value) {
                            return value.replace("K", "000");
                        },
                    },
                },
            });

            // Add percentage labels dynamically at the middle points between pips
            const pipsContainer = slider.querySelector('.noUi-pips');
            const percentageValues = [0, 10, 20, 30, 40, 50]; // Corresponding percentage values
            const pipPositions = [0, 1000, 2000, 3000, 5000, 7500, 10000]; // Positions of the pips

            percentageValues.forEach((percentage, index) => {
                // Calculate the midpoint between two pips
                const midpoint = (pipPositions[index] + pipPositions[index + 1]) / 2;

                // Create a container for the image and percentage text
                const percentageContainer = document.createElement('div');
                percentageContainer.className = "percentage-container";

                // Add the image
                const imgElement = document.createElement('img');
                imgElement.src = "{{ asset('assets/app/icons/bonus2.svg') }}";
                imgElement.alt = `${percentage}% Bonus`;
                imgElement.style.width = "16px"; // Adjust the size as needed
                imgElement.style.marginRight = "5px"; // Add spacing between image and text
                percentageContainer.appendChild(imgElement);

                // Add the percentage text
                const percentageLabel = document.createElement('span');
                percentageLabel.textContent = `${percentage}%`;
                percentageLabel.style.fontSize = "12px";
                percentageLabel.style.fontWeight = "bold";
                percentageContainer.appendChild(percentageLabel);

                // Style the container dynamically
                percentageContainer.style.position = "absolute";
                percentageContainer.style.left = `${(midpoint / MAXIMUMVALUE) * 100}%`;
                percentageContainer.style.transform = "translateX(-50%)";
                percentageContainer.style.top = "-40px";
                percentageContainer.style.display = "flex";
                percentageContainer.style.alignItems = "center";

                // Append the container to the pips container
                pipsContainer.appendChild(percentageContainer);
            });

            // Update display and calculations when slider value changes
            slider.noUiSlider.on("update", (values, handle) => {
                const amountValue = parseInt(values[handle], 10);

                // Display selected amount
                document.querySelector(".number").textContent = `$${amountValue.toFixed(0)}`;
                document.querySelector(".amount_btn_pay").textContent = `Pay $${amountValue.toFixed(0)}`;

                // Calculate credits based on cost per range
                const creditCost = getCreditCost(amountValue);
                const creditsAdded = Math.floor(amountValue / creditCost);

                // Calculate bonus based on amount range
                const bonusPercentage = getBonusPercentage(amountValue);
                const bonusCredits = Math.floor(creditsAdded * (bonusPercentage / 100));

                // Total credits including bonus
                const totalCredits = creditsAdded + bonusCredits;

                // Update the "Credits Added" section with calculated credits
                document.querySelector(".added_amount .credit_title").textContent = creditsAdded
                    .toLocaleString();

                // Update displayed values for bonus and total credits
                document.querySelector(".bonus_outer_grid .bonus_grid:nth-child(1) h5").textContent =
                    bonusCredits.toLocaleString();
                document.querySelector(".bonus_outer_grid .bonus_grid:nth-child(2) h5").textContent =
                    totalCredits.toLocaleString();

                // Update bonus percentage label
                // bonusPercentageLabel.textContent = `Bonus: ${bonusPercentage}%`;

                @this.set('creditCost', amountValue.toFixed(0));
                @this.set('bonusCredits', bonusCredits);
                @this.set('totalCredits', totalCredits);
            });
        });
    </script>

    {{-- <script>
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
    </script> --}}
@endpush
