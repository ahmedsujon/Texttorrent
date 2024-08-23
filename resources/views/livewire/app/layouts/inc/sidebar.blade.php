<div>
    <!-- Sidebar Section  -->
    <div class="sidebar_wrapper" id="sidebarArea">
        <div>
            <div class="logo_grid">
                <a href="{{ route('app.home') }}" class="logo">
                    <img src="{{ asset('assets/app/images/header/logo.svg') }}" alt="logo" class="desktop_logo" />
                    <img src="{{ asset('assets/app/images/header/short_logo.svg') }}" alt="logo" class="short_logo" />
                </a>
                <button type="button" class="sidebar_expand_btn" id="sidebarCloseBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
            </div>
            <div class="top_menu_area">
                <div class="notification_wrapper">
                    <button type="button" class="menu_grid menu_badge_grid desktop_notification_btn">
                        <div class="icon">
                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#4E4E4E">
                                <path
                                    d="M16.9162 13.3333L17.4052 13.902C17.6777 13.6677 17.7457 13.2732 17.5674 12.9612L16.9162 13.3333ZM1.08292 13.3333L0.431734 12.9612C0.253473 13.2732 0.321493 13.6677 0.59392 13.902L1.08292 13.3333ZM15.2496 10.4167H14.4996V10.6158L14.5984 10.7888L15.2496 10.4167ZM2.74958 10.4167L3.40077 10.7888L3.49958 10.6158V10.4167H2.74958ZM8.99958 16.5833C12.3976 16.5833 15.4769 15.5602 17.4052 13.902L16.4273 12.7647C14.8365 14.1325 12.1357 15.0833 8.99958 15.0833V16.5833ZM0.59392 13.902C2.52226 15.5602 5.60161 16.5833 8.99958 16.5833V15.0833C5.86351 15.0833 3.16266 14.1325 1.57191 12.7647L0.59392 13.902ZM17.5674 12.9612L15.9008 10.0446L14.5984 10.7888L16.2651 13.7054L17.5674 12.9612ZM15.9996 10.4167V7.91666H14.4996V10.4167H15.9996ZM1.99958 7.91666V10.4167H3.49958V7.91666H1.99958ZM2.0984 10.0446L0.431734 12.9612L1.7341 13.7054L3.40077 10.7888L2.0984 10.0446ZM8.99958 0.916656C5.13359 0.916656 1.99958 4.05066 1.99958 7.91666H3.49958C3.49958 4.87909 5.96202 2.41666 8.99958 2.41666V0.916656ZM15.9996 7.91666C15.9996 4.05066 12.8656 0.916656 8.99958 0.916656V2.41666C12.0371 2.41666 14.4996 4.87909 14.4996 7.91666H15.9996Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.5 17.5C7.16345 18.0182 8.03956 18.3333 9 18.3333C9.96044 18.3333 10.8366 18.0182 11.5 17.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="label">Notifications</div>
                        <div class="number">
                            <span>20</span>
                        </div>
                    </button>
                    <a href="/" class="menu_grid menu_badge_grid mobile_notificaton_btn">
                        <div class="icon">
                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#4E4E4E">
                                <path
                                    d="M16.9162 13.3333L17.4052 13.902C17.6777 13.6677 17.7457 13.2732 17.5674 12.9612L16.9162 13.3333ZM1.08292 13.3333L0.431734 12.9612C0.253473 13.2732 0.321493 13.6677 0.59392 13.902L1.08292 13.3333ZM15.2496 10.4167H14.4996V10.6158L14.5984 10.7888L15.2496 10.4167ZM2.74958 10.4167L3.40077 10.7888L3.49958 10.6158V10.4167H2.74958ZM8.99958 16.5833C12.3976 16.5833 15.4769 15.5602 17.4052 13.902L16.4273 12.7647C14.8365 14.1325 12.1357 15.0833 8.99958 15.0833V16.5833ZM0.59392 13.902C2.52226 15.5602 5.60161 16.5833 8.99958 16.5833V15.0833C5.86351 15.0833 3.16266 14.1325 1.57191 12.7647L0.59392 13.902ZM17.5674 12.9612L15.9008 10.0446L14.5984 10.7888L16.2651 13.7054L17.5674 12.9612ZM15.9996 10.4167V7.91666H14.4996V10.4167H15.9996ZM1.99958 7.91666V10.4167H3.49958V7.91666H1.99958ZM2.0984 10.0446L0.431734 12.9612L1.7341 13.7054L3.40077 10.7888L2.0984 10.0446ZM8.99958 0.916656C5.13359 0.916656 1.99958 4.05066 1.99958 7.91666H3.49958C3.49958 4.87909 5.96202 2.41666 8.99958 2.41666V0.916656ZM15.9996 7.91666C15.9996 4.05066 12.8656 0.916656 8.99958 0.916656V2.41666C12.0371 2.41666 14.4996 4.87909 14.4996 7.91666H15.9996Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.5 17.5C7.16345 18.0182 8.03956 18.3333 9 18.3333C9.96044 18.3333 10.8366 18.0182 11.5 17.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="label">Notifications</div>
                        <div class="number">
                            <span>20</span>
                        </div>
                    </a>
                    <div class="notification_list_wrapper">
                        <div class="header d-flex-between">
                            <h3>All notifications</h3>
                            <div class="table_dropdown_area single_menu">
                                <div class="dropdown">
                                    <button class="notification_chat_btn" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ asset('assets/app/icons/filter-mail-circle.svg') }}" alt="filter " />
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <h5>Filter</h5>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item">
                                                <span>All notifications</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item">
                                                <span>Unread</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item">
                                                <span>Archived</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="notification_btn_grid">
                            <button type="button">Mark all as read</button>
                            <button type="button">Archive all</button>
                        </div>
                        <ul class="notifciation_list">
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Email verification check has been completed for the
                                        contact group: Default
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Successfully removed (0) duplicated contacts from all
                                        contact groups
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Successfully removed (0) duplicated contacts from all
                                        contact groups
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>Contacts imported to Default</h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Email verification check has been completed for the
                                        contact group: Default
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Successfully removed (0) duplicated contacts from all
                                        contact groups
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>
                                        Successfully removed (0) duplicated contacts from all
                                        contact groups
                                    </h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/notification-03.svg') }}" alt="notification" />
                                </div>
                                <div class="content">
                                    <h3>Contacts imported to Default</h3>
                                    <h6>Thursday 4:20</h6>
                                </div>
                                <div class="action_area d-flex align-items-center justify-content-end flex-wrap">
                                    <div class="action_btn_list">
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/double-check.svg') }}" alt="double check" />
                                        </button>
                                        <button type="button">
                                            <img src="{{ asset('assets/app/icons/delivery-box-02.svg') }}" alt="archive icon" />
                                        </button>
                                    </div>
                                    <div class="dot"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main_menu_area">
                <h4>Main menu</h4>
                <div class="inner_main_menu">
                    <a href="{{ route('app.home') }}" class="menu_grid active_menu">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#235DE4">
                                <g clip-path="url(#clip0_177_7219)">
                                    <path d="M8.33332 1.66667H1.66666V10H8.33332V1.66667Z" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                    <path d="M8.33332 13.3333H1.66666V18.3333H8.33332V13.3333Z" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                    <path d="M18.3333 10H11.6667V18.3333H18.3333V10Z" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                    <path d="M18.3333 1.66667H11.6667V6.66667H18.3333V1.66667Z" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_177_7219">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="label">Dashboard</div>
                    </a>
                    <a href="{{ route('user.claims') }}" class="menu_grid">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                <g clip-path="url(#clip0_608_805)">
                                    <path
                                        d="M1.66589 8.33957L1.13492 7.80988L0.915894 8.02944V8.33957H1.66589ZM18.3326 8.33957H19.0826V8.02944L18.8635 7.80988L18.3326 8.33957ZM18.3326 18.3335V19.0835C18.7468 19.0835 19.0826 18.7477 19.0826 18.3335H18.3326ZM1.66589 18.3335H0.915894C0.915894 18.7477 1.25168 19.0835 1.66589 19.0835L1.66589 18.3335ZM18.8635 7.80988L16.3635 5.30381L15.3016 6.36318L17.8016 8.86925L18.8635 7.80988ZM17.5826 8.33957V18.3335H19.0826V8.33957H17.5826ZM3.63492 5.30381L1.13492 7.80988L2.19687 8.86925L4.69687 6.36318L3.63492 5.30381ZM0.915894 8.33957V18.3335H2.41589V8.33957H0.915894ZM1.66589 19.0835H18.3326V17.5835H1.66589V19.0835Z"
                                        fill="currentColor" />
                                    <path d="M1.66663 8.3335L9.99996 12.918L18.3333 8.3335" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M4.16663 10.0001V1.66675H15.8333V10.0001" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M7.5 8.3335H12.5M7.5 5.00016H12.5" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_608_805">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="label">Claims</div>
                    </a>
                    <a href="{{ route('user.inbox') }}" class="menu_grid">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                <g clip-path="url(#clip0_608_7416)">
                                    <path d="M5.83337 11.6668L8.33337 8.75016L11.25 11.2502L14.1667 8.3335"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                    <path
                                        d="M5.83335 17.2188L6.2089 16.5696L5.93981 16.4139L5.6395 16.4943L5.83335 17.2188ZM1.66669 18.3337L0.942173 18.1398C0.87294 18.3986 0.946956 18.6746 1.13636 18.864C1.32576 19.0534 1.60179 19.1274 1.86054 19.0582L1.66669 18.3337ZM2.78154 14.167L3.50605 14.3608L3.5864 14.0605L3.43074 13.7914L2.78154 14.167ZM17.5834 10.0003C17.5834 14.1885 14.1882 17.5837 10 17.5837V19.0837C15.0166 19.0837 19.0834 15.0169 19.0834 10.0003H17.5834ZM2.41669 10.0003C2.41669 5.81217 5.81186 2.41699 10 2.41699V0.916992C4.98343 0.916992 0.916687 4.98374 0.916687 10.0003H2.41669ZM10 2.41699C14.1882 2.41699 17.5834 5.81217 17.5834 10.0003H19.0834C19.0834 4.98374 15.0166 0.916992 10 0.916992V2.41699ZM10 17.5837C8.61752 17.5837 7.32354 17.2144 6.2089 16.5696L5.45781 17.868C6.79461 18.6413 8.3468 19.0837 10 19.0837V17.5837ZM5.6395 16.4943L1.47283 17.6091L1.86054 19.0582L6.02721 17.9433L5.6395 16.4943ZM3.43074 13.7914C2.78596 12.6768 2.41669 11.3828 2.41669 10.0003H0.916687C0.916687 11.6536 1.35904 13.2057 2.13233 14.5425L3.43074 13.7914ZM2.3912 18.5275L3.50605 14.3608L2.05702 13.9731L0.942173 18.1398L2.3912 18.5275Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_608_7416">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="label">Inbox</div>
                    </a>
                    <div class="accordion" id="accordionSidebar">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed menu_grid" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <div class="icon">
                                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                            <path d="M2.33337 1.66699H17.3334V18.3337H2.33337V1.66699Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                            <path
                                                d="M6.5 14.1673H13.1667C13.1667 12.3264 11.6743 10.834 9.83333 10.834C7.99238 10.834 6.5 12.3264 6.5 14.1673Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M11.5 7.50065C11.5 8.42113 10.7538 9.16732 9.83333 9.16732C8.91286 9.16732 8.16667 8.42113 8.16667 7.50065C8.16667 6.58018 8.91286 5.83398 9.83333 5.83398C10.7538 5.83398 11.5 6.58018 11.5 7.50065Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path d="M4.00002 5L0.666687 5M4.00002 10L0.666687 10M4.00002 15H0.666687"
                                                stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="label">Contacts</div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    <a href="{{ route('user.contacts.manage') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Manage contacts</div>
                                    </a>
                                    <a href="{{ route('user.contacts.validatorCredits') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Validator credits</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed menu_grid" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                    aria-controls="collapseTwo">
                                    <div class="icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                            <g clip-path="url(#clip0_608_15573)">
                                                <path d="M5.41669 10H12.0834M5.41669 6.66667H9.58335"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M7.27061 14.6351L7.32207 13.8869L7.32206 13.8869L7.27061 14.6351ZM1.68114 9.09757L2.4293 9.04515L1.68114 9.09757ZM15.8189 9.09757L15.0707 9.04515L15.0707 9.04516L15.8189 9.09757ZM10.2294 14.6351L10.178 13.8869L10.178 13.8869L10.2294 14.6351ZM10.2294 1.68131L10.178 2.42954L10.178 2.42954L10.2294 1.68131ZM15.8189 7.21887L15.0707 7.27129L15.0707 7.27129L15.8189 7.21887ZM7.27061 1.68131L7.32206 2.42954L7.32206 2.42954L7.27061 1.68131ZM1.68114 7.21887L2.4293 7.27129L2.4293 7.27129L1.68114 7.21887ZM2.81818 12.1933L3.51332 12.4749L3.67058 12.0867L3.42251 11.7491L2.81818 12.1933ZM1.68114 15.0003L0.986003 14.7187C0.876206 14.9898 0.93398 15.3 1.13401 15.5133C1.33404 15.7267 1.63984 15.8043 1.9174 15.7121L1.68114 15.0003ZM4.85258 13.9477L5.20343 13.2848L4.92033 13.135L4.61632 13.2359L4.85258 13.9477ZM8.21877 2.41699H9.28127V0.916992H8.21877V2.41699ZM9.28127 13.8994H8.21877V15.3994H9.28127V13.8994ZM8.21877 13.8994C7.713 13.8994 7.4981 13.899 7.32207 13.8869L7.21916 15.3834C7.45954 15.3999 7.73793 15.3994 8.21877 15.3994V13.8994ZM0.916687 8.15822C0.916687 8.63424 0.916225 8.91095 0.932973 9.14999L2.4293 9.04515C2.41715 8.87166 2.41669 8.65964 2.41669 8.15822H0.916687ZM15.0834 8.15822C15.0834 8.65964 15.0829 8.87166 15.0707 9.04515L16.5671 9.14999C16.5838 8.91095 16.5834 8.63424 16.5834 8.15822H15.0834ZM9.28127 15.3994C9.76211 15.3994 10.0405 15.3999 10.2809 15.3834L10.178 13.8869C10.0019 13.899 9.78704 13.8994 9.28127 13.8994V15.3994ZM15.0707 9.04516C14.8893 11.6354 12.8066 13.7061 10.178 13.8869L10.2809 15.3834C13.6454 15.152 16.3325 12.4973 16.5671 9.14999L15.0707 9.04516ZM9.28127 2.41699C9.78704 2.41699 10.0019 2.41744 10.178 2.42954L10.2809 0.933077C10.0405 0.916547 9.76211 0.916992 9.28127 0.916992V2.41699ZM16.5834 8.15822C16.5834 7.6822 16.5838 7.40549 16.5671 7.16645L15.0707 7.27129C15.0829 7.44478 15.0834 7.6568 15.0834 8.15822H16.5834ZM10.178 2.42954C12.8066 2.6103 14.8893 4.68108 15.0707 7.27129L16.5671 7.16645C16.3325 3.81911 13.6454 1.16445 10.2809 0.933077L10.178 2.42954ZM8.21877 0.916992C7.73793 0.916992 7.45954 0.916547 7.21916 0.933077L7.32206 2.42954C7.49809 2.41744 7.713 2.41699 8.21877 2.41699V0.916992ZM2.41669 8.15822C2.41669 7.6568 2.41715 7.44478 2.4293 7.27129L0.932973 7.16645C0.916225 7.4055 0.916687 7.6822 0.916687 8.15822H2.41669ZM7.21916 0.933077C3.85459 1.16445 1.16749 3.81911 0.932973 7.16645L2.4293 7.27129C2.61078 4.68108 4.69343 2.6103 7.32206 2.42954L7.21916 0.933077ZM3.42251 11.7491C2.85736 10.9802 2.49992 10.053 2.4293 9.04516L0.932973 9.14999C1.02403 10.4497 1.48587 11.647 2.21386 12.6375L3.42251 11.7491ZM2.12305 11.9117L0.986003 14.7187L2.37627 15.2819L3.51332 12.4749L2.12305 11.9117ZM7.32206 13.8869C6.55819 13.8344 5.84119 13.6224 5.20343 13.2848L4.50172 14.6106C5.32162 15.0445 6.24222 15.3162 7.21916 15.3834L7.32206 13.8869ZM1.9174 15.7121L5.08883 14.6595L4.61632 13.2359L1.44488 14.2885L1.9174 15.7121Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M12.7294 17.9685L12.678 17.2202L12.678 17.2202L12.7294 17.9685ZM18.3189 12.4309L19.0671 12.4833L19.0671 12.4833L18.3189 12.4309ZM9.77061 17.9685L9.82207 17.2202L9.82206 17.2202L9.77061 17.9685ZM18.3189 10.5522L17.5707 10.6046L17.5707 10.6046L18.3189 10.5522ZM17.1819 15.5266L16.5775 15.0825L16.3295 15.42L16.4867 15.8082L17.1819 15.5266ZM18.3189 18.3337L18.0826 19.0455C18.3602 19.1376 18.666 19.06 18.866 18.8466C19.0661 18.6333 19.1238 18.3231 19.014 18.0521L18.3189 18.3337ZM15.1475 17.281L15.3837 16.5692L15.0797 16.4683L14.7966 16.6182L15.1475 17.281ZM10.7188 18.7328H11.7813V17.2328H10.7188V18.7328ZM11.7813 18.7328C12.2621 18.7328 12.5405 18.7332 12.7809 18.7167L12.678 17.2202C12.5019 17.2323 12.287 17.2328 11.7813 17.2328V18.7328ZM17.5834 11.4916C17.5834 11.993 17.5829 12.205 17.5707 12.3785L19.0671 12.4833C19.0838 12.2443 19.0834 11.9676 19.0834 11.4916H17.5834ZM10.7188 17.2328C10.213 17.2328 9.9981 17.2323 9.82207 17.2202L9.71916 18.7167C9.95954 18.7332 10.2379 18.7328 10.7188 18.7328V17.2328ZM19.0834 11.4916C19.0834 11.0155 19.0838 10.7388 19.0671 10.4998L17.5707 10.6046C17.5829 10.7781 17.5834 10.9901 17.5834 11.4916H19.0834ZM17.7862 15.9708C18.5142 14.9804 18.976 13.783 19.0671 12.4833L17.5707 12.3785C17.5001 13.3864 17.1427 14.3135 16.5775 15.0825L17.7862 15.9708ZM16.4867 15.8082L17.6238 18.6152L19.014 18.0521L17.877 15.2451L16.4867 15.8082ZM12.7809 18.7167C13.7578 18.6495 14.6784 18.3779 15.4983 17.9439L14.7966 16.6182C14.1588 16.9557 13.4419 17.1677 12.678 17.2202L12.7809 18.7167ZM18.5552 17.6218L15.3837 16.5692L14.9112 17.9928L18.0826 19.0455L18.5552 17.6218ZM17.3395 9.3947C17.4623 9.77992 17.5413 10.185 17.5707 10.6046L19.0671 10.4998C19.0292 9.9599 18.9274 9.43716 18.7687 8.93929L17.3395 9.3947ZM6.23049 17.4671C7.22459 18.1778 8.42176 18.6275 9.71916 18.7167L9.82206 17.2202C8.80843 17.1505 7.87649 16.7999 7.10289 16.2468L6.23049 17.4671Z"
                                                    fill="currentColor" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_608_15573">
                                                    <rect width="20" height="20" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="label">Campaigns</div>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    <a href="{{ route('user.campaigns.sendBulkMessage') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Send Bulk Message</div>
                                    </a>

                                    <a href="{{ route('user.campaigns.groupQueue') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Group Queue</div>
                                    </a>{{ route('user.campaigns.contactMessageQueue') }}contact-message-queue.html" class="menu_grid single_menu_grid">
                                        <div class="label">Contact Queue</div>
                                    </a>
                                    <a href="{{ route('user.campaigns.batchQueue') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Batch Queue</div>
                                    </a>
                                    <a href="{{ route('user.campaigns.inboxTemplate') }}" class="menu_grid single_menu_grid">
                                        <div class="label">Inbox template</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.calendar') }}" class="menu_grid">
                        <div class="icon">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#4E4E4E">
                                <path d="M13.5833 0.666667V4M4.41666 0.666667V4" stroke="currentColor"
                                    stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M16.5 2.33333H1.5V17.3333H16.5V2.33333Z" stroke="currentColor"
                                    stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M1.5 6.5H16.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="label">Calendar</div>
                    </a>
                </div>
            </div>
        </div>
        <a href="settings.html" class="user_profile_grid">
            <img class="user_image" src="{{ asset(user()->avatar) }}" alt="user image" />
            <div>
                <h3>{{ user()->name }}</h3>
                <h4>{{ user()->email }}</h4>
            </div>
            <div class="user_icon">
                <div>
                    <img src="{{ asset('assets/app/icons/top-down-arrow.svg') }}" alt="top down arrow" />
                </div>
            </div>
        </a>
    </div>
    <div class="overlay" id="sidebarOverlay"></div>
</div>
