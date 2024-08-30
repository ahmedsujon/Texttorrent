<div>
    <main class="main_content_wrapper">
        <!-- Group Queue  Section  -->
        <section class="group_queue_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Group Queue</h2>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="checkbox_name_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <div class="column_area">
                                            <span>Send on</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                        </div>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Timezone</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Send from</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Group</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
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
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">Today, 9:43 AM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">Yesterday, 10:63 PM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">Monday, 8:32 AM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">July 7, 3:78 AM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">Today, 9:43 AM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
                                    <div class="checkbox_name_cell_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <p class="send_time">Today, 9:43 AM</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="timezone">GMT</p>
                                </td>
                                <td>
                                    <p class="send_number">+1 (445) 743-833</p>
                                </td>
                                <td>
                                    <p class="group_name">Arcadia drive</p>
                                </td>
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
                                    <div
                                        class="table_dropdown_area action_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editQueueModal">
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
            <div class="pagination_area">
                <div class="d-flex">
                    <select class="niceSelect">
                        <option data-display="10">10</option>
                        <option value="1">10</option>
                        <option value="2">20</option>
                        <option value="3">30</option>
                        <option value="4">50</option>
                        <option value="5">100</option>
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
        <!-- Edit  Queue Modal  -->
        <div class="modal fade common_modal edit_queue_modal" id="editQueueModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Edit group message queue
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row searchable_select">
                                <label for="">Select group</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Group</option>
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
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">City</label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Choose City</option>
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
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                                </div>
                                <div class="input_row">
                                    <label for="">State</label>
                                    <input type="text" placeholder="Type State" class="input_field" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">Postal code</label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Choose Postal code</option>
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
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">Time Zone</label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Choose Time Zone</option>
                                        <option value="1">GTM</option>
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
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                                </div>
                            </div>
                            <div class="d-flex">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">
                                            Text to voice
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                            MP3/M4A audio
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="input_row">
                                        <textarea name="" id="" rows="6" placeholder="Write Message"
                                            class="input_field textarea_field"></textarea>
                                        <h5 class="bottom_text">0/ 1,500 Characters</h5>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="file_upload_area mb-2">
                                        <div class="import_icon">
                                            <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                                        </div>
                                        <h4><span>Click to upload</span> or drag and drop</h4>
                                        <h5>MP3, MP4(max. 2mb)</h5>
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
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            placeholder: "Write a text...",
            height: 170,
            toolbar: [
                ["style", ["bold", "italic", "underline"]]
            ],
        });
    });
</script>
