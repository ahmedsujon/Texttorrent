@section('page_title') TextTorrent | Validator Credits @endsection
<div>
    <main class="main_content_wrapper">
        <!-- Validator Number Section  -->
        <section class="validator_number_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Number validator results</h2>
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
                                    <div class="form-check table_checkbox_area">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>File Name</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Validator Credits</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total numbers</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total mobile numbers</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}" alt="top down arrow" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total landline numbers</span>
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
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check table_checkbox_area">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                </td>
                                <td>
                                    <div class="icon_text_area">
                                        <img src="{{ asset('assets/app/icons/file.svg') }}" alt="file icon" />
                                        <p>List 1</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="icon_text_area">
                                        <img src="{{ asset('assets/app/icons/coins-dollar.svg') }}" alt="dollar icon" />
                                        <p>10</p>
                                    </div>
                                </td>
                                <td>
                                    <p>32</p>
                                </td>
                                <td>
                                    <div class="icon_text_area">
                                        <img src="{{ asset('assets/app/icons/exists.svg') }}" alt="exists icon" />
                                        <p>32</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="icon_text_area">
                                        <img src="{{ asset('assets/app/icons/telephone.svg') }}" alt="telephone icon" />
                                        <p>12</p>
                                    </div>
                                </td>
                                <td>
                                    <p>Today, 9:43 AM</p>
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
                <div class="d-flex position-relative">
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
