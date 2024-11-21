@section('page_title') TextTorrent | Logs @endsection
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
                    <h2>Logs</h2>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" placeholder="Search" wire:model.live='searchTerm' class="input_field" />
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
                            @if ($logs->count() > 0)
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
                            @else
                                <tr>
                                    <td colspan="8" class="text-center pt-5">
                                        <h4>No data available!</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination_area pagination_top_border">
                <div class="d-flex" wire:ignore>
                    <select class="niceSelect sortingValue">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                {{ $logs->links('livewire.app-pagination') }}
            </div>
        </section>

    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });
        });
    </script>
@endpush
