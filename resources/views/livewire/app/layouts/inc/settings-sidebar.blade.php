<div>
    <div class="sidebar_wrapper setting_sidebar_wrapper">
        <div>
            <div class="logo_grid">
                <a href="{{ route('user.dashboard') }}" class="setting_back d-flex align-items-center flex-wrap">
                    <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
                    <span>Settings</span>
                </a>
                <button type="button" class="sidebar_expand_btn" id="sidebarCloseBtn">
                    <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                </button>
            </div>
            <div class="main_top_area">
                <div class="top_menu_area">
                    <h4>ACCOUNT</h4>
                    <a href="{{ route('user.myAccount') }}"
                        class="{{ request()->is('settings/my-account') || request()->is('settings/my-account/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                <path
                                    d="M2.5 18.3337H17.5C17.5 14.6518 14.1421 11.667 10 11.667C5.85786 11.667 2.5 14.6518 2.5 18.3337Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M13.75 5.41699C13.75 7.48806 12.0711 9.16699 10 9.16699C7.92893 9.16699 6.25 7.48806 6.25 5.41699C6.25 3.34592 7.92893 1.66699 10 1.66699C12.0711 1.66699 13.75 3.34592 13.75 5.41699Z"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </div>
                        <div class="label">My Account</div>
                    </a>
                    <a href="{{ route('user.changePassword') }}"
                        class="{{ request()->is('settings/change-password') || request()->is('settings/change-password/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                <g clip-path="url(#clip0_117_14559)">
                                    <path
                                        d="M18.3332 10.0003C18.3332 14.6027 14.6022 18.3337 9.99984 18.3337C5.39746 18.3337 1.6665 14.6027 1.6665 10.0003C1.6665 5.39795 5.39746 1.66699 9.99984 1.66699C14.6022 1.66699 18.3332 5.39795 18.3332 10.0003Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                    <path
                                        d="M9.99967 10.8333C10.9201 10.8333 11.6663 10.0871 11.6663 9.16667C11.6663 8.24619 10.9201 7.5 9.99967 7.5C9.0792 7.5 8.33301 8.24619 8.33301 9.16667C8.33301 10.0871 9.0792 10.8333 9.99967 10.8333ZM9.99967 10.8333L9.99967 14.1667"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_117_14559">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="label">Change Password</div>
                    </a>
                    @if (isUserPermitted('current-plan'))
                        <a href="{{ route('user.subscription') }}"
                            class="{{ request()->is('settings/subscription') || request()->is('settings/subscription/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                    <path d="M12 1V23" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M17 5H9.5C8.57174 5 7.6815 5.36875 7.02513 6.02513C6.36875 6.6815 6 7.57174 6 8.5C6 9.42826 6.36875 10.3185 7.02513 10.9749C7.6815 11.6313 8.57174 12 9.5 12H14.5C15.4283 12 16.3185 12.3687 16.9749 13.0251C17.6313 13.6815 18 14.5717 18 15.5C18 16.4283 17.6313 17.3185 16.9749 17.9749C16.3185 18.6313 15.4283 19 14.5 19H6"
                                        stroke="#696F8C" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="label">Subscription</div>
                        </a>
                    @endif
                    @if (user()->type != 'sub')
                        <a href="{{ route('user.subAccount') }}"
                            class="{{ request()->is('settings/sub-account') || request()->is('settings/sub-account/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                            <div class="icon">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                    <path d="M11.6665 5.5H15.8332" stroke="currentColor" stroke-width="1.5"
                                        stroke-linejoin="round" />
                                    <path d="M11.6665 8.41699H14.1665" stroke="currentColor" stroke-width="1.5"
                                        stroke-linejoin="round" />
                                    <path d="M1.6665 0.916992H18.3332V15.0837H1.6665V0.916992Z" stroke="currentColor"
                                        stroke-width="1.5" stroke-linejoin="round" />
                                    <path
                                        d="M4.1665 11.75C5.17343 9.59911 8.92666 9.45758 9.99984 11.75M8.74984 5.91667C8.74984 6.83714 8.00365 7.58333 7.08317 7.58333C6.1627 7.58333 5.4165 6.83714 5.4165 5.91667C5.4165 4.99619 6.1627 4.25 7.08317 4.25C8.00365 4.25 8.74984 4.99619 8.74984 5.91667Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="label">Sub- Account</div>
                        </a>
                    @endif
                </div>
                <div class="main_menu_area">
                    <h4>WORKSPACE</h4>
                    <div class="inner_main_menu">
                        @if (isUserPermitted('get-numbers'))
                            <a href="{{ route('user.getNumber') }}"
                                class="{{ request()->is('settings/get-number') || request()->is('settings/get-number/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                        <g clip-path="url(#clip0_117_18425)">
                                            <path
                                                d="M3.14786 9.95229C2.35784 8.57475 1.97638 7.44989 1.74637 6.30967C1.40619 4.62331 2.18468 2.976 3.47432 1.92489C4.01938 1.48064 4.6442 1.63242 4.96651 2.21066L5.69416 3.51608C6.27091 4.5508 6.55929 5.06815 6.50209 5.61665C6.44489 6.16515 6.05598 6.61188 5.27815 7.50533L3.14786 9.95229ZM3.14786 9.95229C4.74693 12.7406 7.25637 15.2514 10.0479 16.8523M10.0479 16.8523C11.4254 17.6423 12.5503 18.0238 13.6905 18.2538C15.3769 18.594 17.0242 17.8155 18.0753 16.5258C18.5195 15.9808 18.3677 15.356 17.7895 15.0337L16.4841 14.306C15.4494 13.7293 14.932 13.4409 14.3835 13.4981C13.835 13.5553 13.3883 13.9442 12.4948 14.722L10.0479 16.8523Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_117_18425">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="label">Get Number</div>
                            </a>
                        @endif
                        @if (isUserPermitted('my-numbers'))
                            <a href="{{ route('user.activeNumber') }}"
                                class="{{ request()->is('settings/active-numbers') || request()->is('settings/active-numbers/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                        <path
                                            d="M12.5415 4.16536C13.3555 4.32417 14.1035 4.72225 14.6899 5.30864C15.2763 5.89504 15.6744 6.64308 15.8332 7.45703M12.5415 0.832031C14.2326 1.01989 15.8095 1.77718 17.0134 2.97954C18.2173 4.1819 18.9765 5.75787 19.1665 7.4487M18.3332 14.0987V16.5987C18.3341 16.8308 18.2866 17.0605 18.1936 17.2732C18.1006 17.4858 17.9643 17.6767 17.7933 17.8336C17.6222 17.9905 17.4203 18.1099 17.2005 18.1843C16.9806 18.2586 16.7477 18.2863 16.5165 18.2654C13.9522 17.9867 11.489 17.1105 9.32486 15.707C7.31139 14.4276 5.60431 12.7205 4.32486 10.707C2.91651 8.53303 2.04007 6.05786 1.76653 3.48203C1.7457 3.25159 1.77309 3.01933 1.84695 2.80005C1.9208 2.58077 2.03951 2.37927 2.1955 2.20838C2.3515 2.03749 2.54137 1.90096 2.75302 1.80747C2.96468 1.71398 3.19348 1.66558 3.42486 1.66536H5.92486C6.32928 1.66138 6.72136 1.8046 7.028 2.06831C7.33464 2.33202 7.53493 2.69824 7.59153 3.0987C7.69705 3.89875 7.89274 4.6843 8.17486 5.44036C8.28698 5.73863 8.31125 6.06279 8.24478 6.37443C8.17832 6.68607 8.02392 6.97212 7.79986 7.1987L6.74153 8.25703C7.92783 10.3433 9.65524 12.0707 11.7415 13.257L12.7999 12.1987C13.0264 11.9746 13.3125 11.8202 13.6241 11.7538C13.9358 11.6873 14.2599 11.7116 14.5582 11.8237C15.3143 12.1058 16.0998 12.3015 16.8999 12.407C17.3047 12.4641 17.6744 12.668 17.9386 12.9799C18.2029 13.2918 18.3433 13.69 18.3332 14.0987Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="label">My Numbers</div>
                            </a>
                        @endif
                        @if (isUserPermitted('logs'))
                            <a href="{{ route('user.inboxLogs') }}"
                                class="{{ request()->is('settings/inbox-logs') || request()->is('settings/inbox-logs/*') || request()->is('settings/bulk-logs') || request()->is('settings/bulk-logs/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                                <div class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                        <path
                                            d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M13 2V9H20" stroke="#696F8C" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="label">Logs</div>
                            </a>
                        @endif
                        @if (isUserPermitted('api'))
                            <a href="{{ route('user.apis') }}"
                                class="{{ request()->is('settings/apis') || request()->is('settings/apis/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                        <path d="M18.3332 17.5V2.5H1.6665V17.5L18.3332 17.5Z" stroke="currentColor"
                                            stroke-width="1.5" stroke-linejoin="round" />
                                        <path
                                            d="M6.66634 7.49967L7.37785 7.2625L7.20691 6.74967H6.66634V7.49967ZM5.83301 7.49967V6.74967H5.24743L5.1054 7.31777L5.83301 7.49967ZM10.4163 7.49967V6.74967H9.66634V7.49967H10.4163ZM6.66634 6.74967H5.83301V8.24967H6.66634V6.74967ZM5.1054 7.31777L4.27207 10.6511L5.72728 11.0149L6.56061 7.68158L5.1054 7.31777ZM4.27207 10.6511L3.8554 12.3178L5.31061 12.6816L5.72728 11.0149L4.27207 10.6511ZM5.95483 7.73685L7.06594 11.0702L8.48896 10.5958L7.37785 7.2625L5.95483 7.73685ZM7.06594 11.0702L7.6215 12.7368L9.04452 12.2625L8.48896 10.5958L7.06594 11.0702ZM4.99967 11.583H7.77745V10.083H4.99967V11.583ZM10.4163 8.24967H12.083V6.74967H10.4163V8.24967ZM9.66634 7.49967V9.99967H11.1663V7.49967H9.66634ZM9.66634 9.99967V12.4997H11.1663V9.99967H9.66634ZM12.083 9.24967H10.4163V10.7497H12.083V9.24967ZM12.583 8.74967C12.583 9.02582 12.3592 9.24967 12.083 9.24967V10.7497C13.1876 10.7497 14.083 9.85424 14.083 8.74967H12.583ZM12.083 8.24967C12.3592 8.24967 12.583 8.47353 12.583 8.74967H14.083C14.083 7.64511 13.1876 6.74967 12.083 6.74967V8.24967ZM14.6663 7.08301V12.9163H16.1663V7.08301H14.6663Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                                <div class="label">API</div>
                            </a>
                        @endif
                        @if (getActiveSubscription()['type'] == 'text-torrent')
                            <a href="{{ route('user.dlcRegistration') }}"
                                class="{{ request()->is('settings/dlc-registration') || request()->is('settings/dlc-registration/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2 10C2 9.58579 2.33579 9.25 2.75 9.25L9.53701 9.25L7.6989 7.25871C7.41794 6.95434 7.43692 6.47985 7.74129 6.1989C8.04566 5.91794 8.52015 5.93692 8.8011 6.24129L11.8011 9.49129C12.0663 9.77859 12.0663 10.2214 11.8011 10.5087L8.8011 13.7587C8.52015 14.0631 8.04566 14.0821 7.74129 13.8011C7.43692 13.5201 7.41794 13.0457 7.6989 12.7413L9.53701 10.75L2.75 10.75C2.33579 10.75 2 10.4142 2 10ZM10 18.25C10 17.8358 10.3358 17.5 10.75 17.5L15.25 17.5C15.9404 17.5 16.5 16.9404 16.5 16.25L16.5 3.75C16.5 3.05964 15.9404 2.5 15.25 2.5L10.75 2.5C10.3358 2.5 10 2.16421 10 1.75C10 1.33579 10.3358 1 10.75 1L15.25 1C16.7688 1 18 2.23122 18 3.75L18 16.25C18 17.7688 16.7688 19 15.25 19L10.75 19C10.3358 19 10 18.6642 10 18.25Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                                <div class="label">10 DLC Registration</div>
                            </a>
                        @endif
                        <a href="{{ route('user.triggerNotification') }}"
                            class="{{ request()->is('settings/trigger-notification') || request()->is('settings/trigger-notification/*') ? 'menu_grid active_menu' : 'menu_grid' }}">
                            <div class="icon">
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" currentColor="#696F8C">
                                    <path
                                        d="M1.10843 11.9954C0.93122 13.1229 1.72349 13.9055 2.69354 14.2955C6.4125 15.7908 11.5878 15.7908 15.3068 14.2955C16.2768 13.9055 17.0691 13.1229 16.8919 11.9954C16.783 11.3024 16.2445 10.7254 15.8455 10.162C15.3229 9.41493 15.271 8.60009 15.2709 7.73317C15.2709 4.38291 12.4634 1.66699 9.00016 1.66699C5.53694 1.66699 2.72943 4.38291 2.72943 7.73317C2.72936 8.60009 2.67743 9.41493 2.15484 10.162C1.75586 10.7254 1.21734 11.3024 1.10843 11.9954Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M6.5 17.5C7.16345 18.0182 8.03956 18.3333 9 18.3333C9.96044 18.3333 10.8366 18.0182 11.5 17.5"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="label">Trigger Notification</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay" id="sidebarOverlay"></div>
</div>
