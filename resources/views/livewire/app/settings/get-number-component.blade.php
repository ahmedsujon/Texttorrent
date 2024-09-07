<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Get Number Section  -->
        <section class="get_number_wrapper account_border">
            <div class="account_title_area">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/shopping-cart-02.svg') }}" alt="cart icon" class="user_icon" />
                    <h2>Buy Number</h2>
                </div>
            </div>
            <div class="number_buy_area">
                <form class="event_form_area">
                    <div class="input_row">
                        <label for="">Please enter Area code to search for number</label>
                        <input type="number" placeholder="Type Area Code" class="input_field" />
                    </div>
                    <div class="buy_action_grid">
                        <div class="input_row">
                            <input type="text" placeholder="Type number of  buy link"
                                class="input_field quantity_input_field" value="0" id="qtyProductValue" />
                            <button type="button" class="quantity_btn" id="qtyMinusButton">
                                <img src="{{ asset('assets/app/icons/minus-gray.svg') }}" alt="minus icon" />
                            </button>
                            <button type="button" class="quantity_btn plus_quantity_btn" id="qtyPlusButton">
                                <img src="{{ asset('assets/app/icons/plus-gray.svg') }}" alt="plus icon" />
                            </button>
                        </div>
                        <button type="button" class="create_template_btn">
                            <img src="{{ asset('assets/app/icons/shopping-cart.svg') }}" alt="cart icon white" />
                            <span>Buy in bulk</span>
                        </button>
                    </div>
                </form>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form">
                        <input type="search" placeholder="Search number" class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>

                    <select class="niceSelect niceSelect_area">
                        <option data-display="Toll-Free">Toll-Free</option>
                        <option value="1">Local</option>
                    </select>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Phone number</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Location</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Capabilities</span>
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
                                    <div class="phone_number_area d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                        <h4 class="timezone">+1 (677) 739-783</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="phone_number">New York, USA</h4>
                                </td>

                                <td>
                                    <div class="capability_status_area">
                                        <div class="capability_status">Voice</div>
                                        <div class="capability_status sms">SMS</div>
                                        <div class="capability_status mms">MMS</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="icon_btn" data-bs-toggle="modal"
                                            data-bs-target="#confirmPurchaseModal">
                                            <img src="{{ asset('assets/app/icons/shopping-cart.svg') }}" alt="" />
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
                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}" alt="copy icon" />
                                                        <span>Copy</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="phone_number_area d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                        <h4 class="timezone">+1 (677) 739-783</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="phone_number">New York, USA</h4>
                                </td>

                                <td>
                                    <div class="capability_status_area">
                                        <div class="capability_status">Voice</div>
                                        <div class="capability_status sms">SMS</div>
                                        <div class="capability_status mms">MMS</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                        <button type="button" class="icon_btn" data-bs-toggle="modal"
                                            data-bs-target="#confirmPurchaseModal">
                                            <img src="{{ asset('assets/app/icons/shopping-cart.svg') }}" alt="" />
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
                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}" alt="copy icon" />
                                                        <span>Copy</span>
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
            <div class="pagination_area pagination_top_border">
                <div class="d-flex">
                    <select class="niceSelect">
                        <option value="1">10 Numbers</option>
                        <option value="2">30 Numbers</option>
                        <option value="3">50 Numbers</option>
                        <option value="4">100 Numbers</option>
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

        <!-- Active Number Section  -->
        <section class="get_number_wrapper account_border mt-3">
            <div class="d-flex align-items-center flex-wrap g-sm account_title_area">
                <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
                <img src="{{ asset('assets/app/icons/log-02.svg') }}" alt="logs icon" class="user_icon" />
                <h2>Active Numbers</h2>
            </div>
            <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                <form action="" class="search_input_form search_input_form_sm">
                    <input type="search" placeholder="Search" class="input_field" />
                    <button type="submit" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                    </button>
                </form>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Phone number</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Location</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Capabilities</span>
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
                                    <div class="phone_number_area d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                        <h4 class="timezone">+1 (677) 739-783</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="phone_number">New York, USA</h4>
                                </td>

                                <td>
                                    <div class="capability_status_area">
                                        <div class="capability_status">Voice</div>
                                        <div class="capability_status sms">SMS</div>
                                        <div class="capability_status mms">MMS</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
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
                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}" alt="copy icon" />
                                                        <span>Inactive</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="phone_number_area d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                        <h4 class="timezone">+1 (677) 739-783</h4>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="phone_number">New York, USA</h4>
                                </td>

                                <td>
                                    <div class="capability_status_area">
                                        <div class="capability_status">Voice</div>
                                        <div class="capability_status sms">SMS</div>
                                        <div class="capability_status mms">MMS</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
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
                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}" alt="copy icon" />
                                                        <span>Inactive</span>
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
            <div class="pagination_area pagination_top_border">
                <div class="d-flex">
                    <select class="niceSelect">
                        <option value="1">10 Numbers</option>
                        <option value="2">30 Numbers</option>
                        <option value="3">50 Numbers</option>
                        <option value="4">100 Numbers</option>
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

        <!-- Confirm Modal  -->
        <div class="modal fade common_modal confirm_purchase_modal" id="confirmPurchaseModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Confirm purchase
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="purchase_area">
                            <img class="cart_purchase_icon" src="{{ asset('assets/app/images/others/shopping-cart-02.png') }}"
                                alt="cart icon" />
                            <h3>
                                Buying a phone number will cost you 295 credits per month
                            </h3>
                        </div>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
