<div>
    <main class="main_content_wrapper">
        <!-- Contact Queue Section  -->
        <section class="batch_queue_wrapper group_queue_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Batch Queue</h2>
                </div>
            </div>
            <div class="template_filter_area d-flex-between">
                <form action="" class="search_input_form">
                    <input type="search" placeholder="Search folder" class="input_field" />
                    <button type="submit" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                    </button>
                </form>
                <div class="filter_btn_area d-flex align-items-center justify-content-end flex-wrap g-xs">
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="column insert" />
                        <span>Export</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive border_table">
                    <table class="table table_sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>City</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>State</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Postal code</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Message</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Type</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Media</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total contacts</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Status</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="city_text">London</p>
                                </td>
                                <td>
                                    <p class="state_name">New York</p>
                                </td>
                                <td>
                                    <p class="postal_code">8932</p>
                                </td>
                                <td>
                                    <p class="message_text">
                                        Hey I am Tom HardyHey I am Tom Hardy
                                    </p>
                                </td>
                                <td>
                                    <p>Voice</p>
                                </td>
                                <td>
                                    <p>Text</p>
                                </td>
                                <td>
                                    <p class="state_name">362</p>
                                </td>
                                <td>
                                    <div class="badge_status_area d-flex">
                                        <div class="badge_status">Badge</div>
                                    </div>
                                </td>

                                <td>
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="table_dot_btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <h4>Select</h4>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                        <span>Export</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="batch_details_table_area">
                <button type="button" class="batch_details_btn d-flex-between w-100" id="batchDetailsTableBtn">
                    <span>Batch details</span>
                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="arrow down" class="arrow_icon" />
                </button>
                <div class="inbox_template_table_area details_table_area" id="batchDetailsTableArea">
                    <div class="table-responsive">
                        <table class="table table_sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="column_area">
                                            <span>Batch</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="column_area">
                                            <span>Batch Contacts</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="column_area">
                                            <span>Send on</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="column_area">
                                            <span>Status</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>Text</p>
                                    </td>
                                    <td>
                                        <p class="state_name">+ 1 (566) 565-343</p>
                                    </td>
                                    <td>
                                        <p class="postal_code">Today, 3:43 PM</p>
                                    </td>
                                    <td>
                                        <p class="message_text">
                                            Hey I am Tom HardyHey I am Tom Hardy
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Text</p>
                                    </td>
                                    <td>
                                        <p class="state_name">+ 1 (566) 565-343</p>
                                    </td>
                                    <td>
                                        <p class="postal_code">Today, 3:43 PM</p>
                                    </td>
                                    <td>
                                        <p class="message_text">
                                            Hey I am Tom HardyHey I am Tom Hardy
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Text</p>
                                    </td>
                                    <td>
                                        <p class="state_name">+ 1 (566) 565-343</p>
                                    </td>
                                    <td>
                                        <p class="postal_code">Today, 3:43 PM</p>
                                    </td>
                                    <td>
                                        <p class="message_text">
                                            Hey I am Tom HardyHey I am Tom Hardy
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Text</p>
                                    </td>
                                    <td>
                                        <p class="state_name">+ 1 (566) 565-343</p>
                                    </td>
                                    <td>
                                        <p class="postal_code">Today, 3:43 PM</p>
                                    </td>
                                    <td>
                                        <p class="message_text">
                                            Hey I am Tom HardyHey I am Tom Hardy
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="pagination_area">
                <div class="d-flex">
                    <select class="niceSelect">
                        <option data-display="10">10</option>
                        <option value="1">10</option>
                        <option value="2">30</option>
                        <option value="3">50</option>
                        <option value="4">100</option>
                    </select>
                </div>
                <ul class="number_list d-flex align-items-center justify-content-center flex-wrap">
                    <li>
                        <a href="#" class="pagination_active"> 1 </a>
                    </li>
                    <li>
                        <a href="#"> 2 </a>
                    </li>
                    <li>
                        <a href="#"> 3 </a>
                    </li>
                    <li>
                        <div class="middle_dot">...</div>
                    </li>
                    <li>
                        <a href="#"> 8 </a>
                    </li>
                    <li>
                        <a href="#"> 9 </a>
                    </li>
                    <li>
                        <a href="#"> 10 </a>
                    </li>
                </ul>
                <div class="pagination_action_list d-flex align-items-center justify-content-end flex-wrap g-sm">
                    <a href="#">
                        <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
                        <span>Previous</span>
                    </a>
                    <a href="#">
                        <span>Next</span>
                        <img src="{{ asset('assets/app/icons//right-arrow-black.svg') }}" alt="right arrow" />
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            //Details table toggle
            $("#batchDetailsTableBtn").click(function(e) {
                e.preventDefault();
                $("#batchDetailsTableArea").fadeToggle();
                $(this).toggleClass("batch_active");
            });
            $();
        });
    </script>
@endpush
