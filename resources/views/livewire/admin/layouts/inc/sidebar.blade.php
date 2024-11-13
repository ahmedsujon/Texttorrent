<div>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Menu</li>

                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="waves-effect {{ request()->is('admin/dashboard') ? 'active_menu' : '' }}">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-dashboard">Dashboard</span>
                        </a>
                    </li>

                    @if (is_permitted('manage_admins'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/all-admins') || request()->is('admin/all-admins/*') ? 'active_menu' : '' }}">
                                <i class="bx bx-group"></i>
                                <span key="t-multi-level">Admins</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_admins'))
                                    <li>
                                        <a href="{{ route('admin.allAdmins') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/all-admins') ? 'active_sub_menu' : '' }}">All
                                            Admins</a>
                                    </li>
                                @endif

                                @if (is_permitted('manage_roles_permissions'))
                                    <li>
                                        <a href="{{ route('admin.adminRolePermissions') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/all-admins/role-permissions') ? 'active_sub_menu' : '' }}">Roles
                                            & Permissions</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (is_permitted('manage_users'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/all-users') || request()->is('admin/all-users/*') ? 'active_menu' : '' }}">
                                <i class="bx bx-group"></i>
                                <span key="t-multi-level">Customers</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_users'))
                                    <li>
                                        <a href="{{ route('admin.allUsers') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/all-users') ? 'active_sub_menu' : '' }}">All
                                            Customer</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (is_permitted('manage_users'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/contact-message') || request()->is('admin/contact-message/*') ? 'active_menu' : '' }}">
                                <i class="bx bx-message-rounded-dots"></i>
                                <span key="t-multi-level">Messages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_users'))
                                    <li>
                                        <a href="{{ route('admin.contact-message') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/contact-message') ? 'active_sub_menu' : '' }}">Messages</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (is_permitted('manage_users'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/subscriptions') || request()->is('admin/subscriptions/*') ? 'active_menu' : '' }}">
                                <i class="bx bxs-report"></i>
                                <span key="t-multi-level">Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_users'))
                                    <li>
                                        <a href="{{ route('admin.subscriptions') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/subscriptions') ? 'active_sub_menu' : '' }}">Subscription</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (is_permitted('manage_settings'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active_menu' : '' }}">
                                <i class="bx bx-bar-chart"></i>
                                <span key="t-multi-level">Activity Log</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_console'))
                                    <li>
                                        <a href="#" key="t-level-1-1"
                                            class="{{ request()->is('admin/settings/console') ? 'active_sub_menu' : '' }}">Logs</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (is_permitted('manage_settings'))
                        <li>
                            <a href="javascript: void(0);"
                                class="has-arrow waves-effect {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active_menu' : '' }}">
                                <i class="bx bx-cog"></i>
                                <span key="t-multi-level">Settings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @if (is_permitted('manage_console'))
                                    <li>
                                        <a href="{{ route('admin.console') }}" key="t-level-1-1"
                                            class="{{ request()->is('admin/settings/console') ? 'active_sub_menu' : '' }}">Console</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active_menu' : '' }}">
                            <i class="bx bx-box"></i>
                            <span key="t-multi-level">Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('admin.allProducts') }}" key="t-level-1-1" class="{{ request()->is('admin/products/all') ? 'active_sub_menu' : '' }}">All Products</a></li>
                            <li><a href="{{ route('admin.categories') }}" key="t-level-1-1" class="{{ request()->is('admin/products/categories') ? 'active_sub_menu' : '' }}">Categories</a></li>
                        </ul>
                    </li> --}}


                    {{-- <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-share-alt"></i>
                            <span key="t-multi-level">Multi Level</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);" key="t-level-1-1">Level 1.1</a></li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Level 1.2</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" key="t-level-2-1">Level 2.1</a></li>
                                    <li><a href="javascript: void(0);" key="t-level-2-2">Level 2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}

                </ul>
            </div>

        </div>
    </div>
</div>
