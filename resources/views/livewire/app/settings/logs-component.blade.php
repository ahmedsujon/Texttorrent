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
                                    <button type="button" wire:click.prevent='filterMessage("received")' class="dropdown-item"> <!-- active_check -->
                                        <span>Received Messages</span>
                                    </button>
                                </li>

                                <li>
                                    <button type="button" wire:click.prevent='filterMessage("sent")' class="dropdown-item"> <!-- active_check -->
                                        <span>Sent Messages</span>
                                    </button>
                                </li>

                                <li>
                                    <button type="button" wire:click.prevent='exportAll' class="dropdown-item">
                                        <span>Export All</span>
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
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'Read',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'From number',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'To number',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'Name',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'Message',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'created_at',
                                    'thDisplayName' => 'Created',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'id',
                                    'thDisplayName' => 'Status',
                                ])
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
                                    <td>
                                        <h4 class="timezone">Read</h4>
                                    </td>
                                    <td>
                                        <h4 class="phone_number">{{ $log->from }}</h4>
                                    </td>
                                    <td>
                                        <h4 class="phone_number">{{ getContactNumberName($log->contact_id) ? getContactNumberName($log->contact_id)->number : '---' }}</h4>
                                    </td>
                                    <td>
                                        <h4 class="timezone">{{ getContactNumberName($log->contact_id) ? getContactNumberName($log->contact_id)->first_name . ' ' . getContactNumberName($log->contact_id)->last_name : '' }}</h4>
                                    </td>
                                    <td>
                                        <h4 class="message_text">{{ $log->message }}</h4>
                                    </td>
                                    <td>
                                        <h4 class="send_number">
                                            {{ \Carbon\Carbon::parse($created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($created_at)->format('g:i A') : \Carbon\Carbon::parse($created_at)->format('F j, Y, g:i A') }}
                                        </h4>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="log_status">
                                                @if ($log->direction == 'inbound')
                                                    Received
                                                @else
                                                    {{ ucfirst($log->api_send_status) }}
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                            <a type="button" class="table_edit_btn" wire:click.prevent='viewChat({{ $log->chat_id }}, {{ $key }})'>
                                                {!! loadingStateWithoutText("viewChat($log->chat_id, $key)", '<img src="'.asset('assets/app/icons/message-03.svg').'" />') !!}
                                                <span>Chat</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
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
