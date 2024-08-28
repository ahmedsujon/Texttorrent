<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="logs_account_wrapper sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/log-02.svg') }}" alt="logs icon" class="user_icon" />
                    <h2>Log</h2>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" placeholder="Search" class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>
                    <div class="table_dropdown_area single_menu not_right_border">
                        <div class="dropdown">
                            <button class="icon_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h5>Select</h5>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item active_check">
                                        <span>Received</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item">
                                        <span>SMS Inbox</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item">
                                        <span>Single SMS Outbox</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item">
                                        <span>Bulk SMS Outbox</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item">
                                        <span>Voicemail</span>
                                    </button>
                                </li>

                                <li>
                                    <button type="button" class="dropdown-item border_top">
                                        <span>Delete All SMS Inbox (Prior Years Only)</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item">
                                        <span>Export All SMS Inbox</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Read</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>From number</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>To number</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Name</span>
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
                                        <span>Created</span>
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
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="timezone">Read</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="phone_number">+1 (566) 432-342</h4>
                                </td>
                                <td>
                                    <h4 class="timezone">Test 1</h4>
                                </td>
                                <td>
                                    <h4 class="message_text">Who is this?</h4>
                                </td>
                                <td>
                                    <h4 class="send_number">Today, 9:43 AM</h4>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="log_status">Received</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#chatLogModal">
                                            <img src="{{ asset('assets/app/icons/message-03.svg') }}" alt="message icon" />
                                            <span>Chat</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
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

        <!-- Log Chat Modal  -->
        <div class="modal fade common_modal" id="chatLogModal" tabindex="-1" aria-labelledby="newEventModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Start new chat
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">Sender</label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="" disabled>Choose Number</option>
                                        <option value="1">+1 (332) 262-786</option>
                                        <option value="2">+1 (332) 262-784</option>
                                        <option value="3">+1 (332) 262-788</option>
                                        <option value="4">+1 (332) 262-789</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                                </div>
                                <div class="input_row">
                                    <label for="">Receiver</label>
                                    <input type="text" placeholder="Type Receiver Number" class="input_field"
                                        value="(566) 445-893" disabled />
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Message</label>
                                <textarea name="" id="" rows="5" class="input_field textarea_field"
                                    placeholder="Write here..."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Start chat</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
