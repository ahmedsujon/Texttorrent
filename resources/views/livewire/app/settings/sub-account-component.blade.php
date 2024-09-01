<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/sub-account.svg') }}" alt="sub account icon" class="user_icon" />
                    <h2>Sub Accounts</h2>
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
                        <span>Add Sub Account</span>
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
                                        <span>Username</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>First Name</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Last Name</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Email</span>
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
                                    <div class="user_grid">
                                        <div class="img"><span>B</span></div>
                                        <h4>Bar 1 <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #efefef">
                                            <span>C</span>
                                        </div>
                                        <h4>China one <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #ffcdb3">
                                            <span>D</span>
                                        </div>
                                        <h4>Default <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #d0c5ff">
                                            <span>J</span>
                                        </div>
                                        <h4>Jv Test <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #ffdfa0">
                                            <span>T</span>
                                        </div>
                                        <h4>Test 1 <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #b6f0b5">
                                            <span>T</span>
                                        </div>
                                        <h4>Text Ivan <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user_grid">
                                        <div class="img" style="background-color: #ffcae7">
                                            <span>U</span>
                                        </div>
                                        <h4>Unique <span>32</span></h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h4 class="group_name">Bar 1</h4>
                                </td>
                                <td>
                                    <h5 class="send_time">rivera@example.com</h5>
                                </td>
                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="table_edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#editSubAccountModal">
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
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Active User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-block">
                                                        <span>Inactive User</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item">
                                                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                        <span>Delete User</span>
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
                        <option data-display="10 Accounts">10 Accounts</option>
                        <option value="1">10 Accounts</option>
                        <option value="2">30 Accounts</option>
                        <option value="3">50 Accounts</option>
                        <option value="4">100 Accounts</option>
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

        <!-- New Sub Account Modal  -->
        <div class="modal fade common_modal sub_account_modal" id="newSubAccountModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Create Sub Account
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <h3>Account Info</h3>
                            </div>

                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">User Name</label>
                                    <input type="text" placeholder="Type User Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type User Name" class="input_field" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="Type First Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Last Name</label>
                                    <input type="text" placeholder="Type Last Name" class="input_field" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Type Password"
                                        class="input_field password_input_filed" id="password_input1" />
                                    <div class="eye_icon_area" id="password_eye_icon_area1">
                                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose1">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="input_row">
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Type Confirm Password"
                                        class="input_field password_input_filed" id="password_input2" />
                                    <div class="eye_icon_area" id="password_eye_icon_area2">
                                        <button type="button" class="eye_open_btn" id="eyeOpen2">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose2">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="permission_area">
                                <h3>Permissions</h3>
                                <div class="permission_grid">
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Get Numbers</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Your Current Plan</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Secondary Number Assigned</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Past Receipts</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Send SMS</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Contact List</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">2-way SMS Chat</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Logs</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Number Pool</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">SMS Credits</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Messages # of Messages</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Groups</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Import Contacts</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Scheduler</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Reports</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Voice Credits</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Current Credit Package</h3>
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
        <!-- Edit Sub Account Modal  -->
        <div class="modal fade common_modal sub_account_modal" id="editSubAccountModal" tabindex="-1"
            aria-labelledby="editEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventModal">
                            Edit Sub Account
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <h3>Account Info</h3>
                            </div>

                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">User Name</label>
                                    <input type="text" placeholder="Type User Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type User Name" class="input_field" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="Type First Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Last Name</label>
                                    <input type="text" placeholder="Type Last Name" class="input_field" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Type Password"
                                        class="input_field password_input_filed" id="password_input1" />
                                    <div class="eye_icon_area" id="password_eye_icon_area1">
                                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose1">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="input_row">
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Type Confirm Password"
                                        class="input_field password_input_filed" id="password_input2" />
                                    <div class="eye_icon_area" id="password_eye_icon_area2">
                                        <button type="button" class="eye_open_btn" id="eyeOpen2">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose2">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="permission_area">
                                <h3>Permissions</h3>
                                <div class="permission_grid">
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Get Numbers</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Your Current Plan</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Secondary Number Assigned</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Past Receipts</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Send SMS</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Contact List</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">2-way SMS Chat</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Logs</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Number Pool</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">SMS Credits</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Messages # of Messages</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Groups</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Import Contacts</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" checked />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Scheduler</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Reports</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Voice Credits</h3>
                                        </div>
                                        <div class="custom_switch_area">
                                            <label class="switch">
                                                <input type="checkbox" />
                                                <span class="slider round"></span>
                                            </label>
                                            <h3 class="switch_title">Current Credit Package</h3>
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
