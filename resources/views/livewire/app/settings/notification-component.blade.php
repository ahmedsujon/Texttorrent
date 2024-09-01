<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/notification.svg') }}" alt="notification icon" class="user_icon" />
                    <h2>Trigger Notification</h2>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" placeholder="Search" class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>

                    <button type="button" class="create_template_btn sub_account_btn" data-bs-toggle="modal"
                        data-bs-target="#newSubAccountModal">
                        <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus icon" />
                        <span>Add Trigger</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Keyword</span>
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
                                        <span>Created</span>
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
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" class="table_delete_btn">
                                            <img src="{{ asset('assets/app/icons/delete-04.svg') }}" alt="delete icon" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer_area d-flex">
                                        <h4 class="customer_name">Customer</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Webahook</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Today, 9:43 AM</h4>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editNotificationModal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
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

        <!-- New Notification Trigger Modal  -->
        <div class="modal fade common_modal" id="newSubAccountModal" tabindex="-1" aria-labelledby="newEventModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">Add Trigger</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="warning_area">
                            <p>
                                <span>IMPORTANT:</span>  Enter your mobile number with country
                                code (US Example: 12025248725)
                            </p>
                            <div class="warning_btn_area d-flex align-items-center flex-wrap">
                                <button type="button" class="ok_btn">
                                    <span>Ok got it!</span>
                                </button>
                                <button type="button" class="learn_more_btn">
                                    Learn more
                                </button>
                            </div>
                        </div>
                        <form action="" class="event_form_area mt-24">
                            <div class="input_row">
                                <label for="">Keyword</label>
                                <input type="text" placeholder="Type Keyword" class="input_field" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Type</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">Email</option>
                                    <option value="2">Phone</option>
                                    <option value="3">Webhook</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <label for="">Email</label>
                                <input type="email" placeholder="Type Email" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Phone</label>
                                <input type="number" placeholder="Type Phone" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Webhook URL</label>
                                <input type="url" placeholder="Email address" class="input_field" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Webhook Format</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">Json</option>
                                    <option value="2">Urlencoded</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="fromPhone" />
                                        <label class="form-check-label mb-0" for="fromPhone">
                                            Send Auto Responder?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Auto Responder Message</label>
                                <textarea name="" id="" rows="4" placeholder="Type between 0-160 characters."
                                    class="input_field"></textarea>
                                <h5>0/ 160 Characters</h5>
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

        <!-- Edit Notification Trigger Modal  -->
        <div class="modal fade common_modal" id="editNotificationModal" tabindex="-1"
            aria-labelledby="editEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventModal">Edit Trigger</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="warning_area">
                            <p>
                                <span>IMPORTANT:</span>  Enter your mobile number with country
                                code (US Example: 12025248725)
                            </p>
                            <div class="warning_btn_area d-flex align-items-center flex-wrap">
                                <button type="button" class="ok_btn">
                                    <span>Ok got it!</span>
                                </button>
                                <button type="button" class="learn_more_btn">
                                    Learn more
                                </button>
                            </div>
                        </div>
                        <form action="" class="event_form_area mt-24">
                            <div class="input_row">
                                <label for="">Keyword</label>
                                <input type="text" placeholder="Type Keyword" class="input_field" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Type</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select Type</option>
                                    <option value="1">Type 1</option>
                                    <option value="2">Type 2</option>
                                    <option value="3">Type 3</option>
                                    <option value="4">Type 4</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <label for="">Email</label>
                                <input type="email" placeholder="Type Email" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Phone</label>
                                <input type="number" placeholder="Type Phone" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Webhook URL</label>
                                <input type="url" placeholder="Email address" class="input_field" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Webhook Format</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">Json</option>
                                    <option value="2">Urlencoded</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow" class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="fromPhone" />
                                        <label class="form-check-label mb-0" for="fromPhone">
                                            Send Auto Responder?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Auto Responder Message</label>
                                <textarea name="" id="" rows="4" placeholder="Type between 0-160 characters."
                                    class="input_field"></textarea>
                                <h5>0/ 160 Characters</h5>
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
