@section('page_title')
    TextTorrent | Logs
@endsection
<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="logs_account_wrapper sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <a href="{{ route('user.inboxLogs') }}" type="button" class="create_event_btn bg-light"
                        style="font-size: 14px; color: black !important;">
                        Inbox Logs
                    </a>
                    <a href="javascript:void(0)" type="button" class="create_event_btn"
                        style="font-size: 14px; color: black !important; background: rgba(11, 18, 52, 0.15);">
                        Bulk Logs
                    </a>
                </div>

                <div style="position: absolute; left: 43%;" wire:loading wire:target='previousPage,nextPage,sortingValue,searchTerm,gotoPage'><i class="fa fa-spinner fa-spin"></i> Processing...</div>


                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" placeholder="Search" wire:model.live='searchTerm' class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>
                    {{-- <div class="table_dropdown_area single_menu not_right_border">
                        <div class="dropdown">
                            <button class="icon_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h5>Select</h5>
                                </li>
                                <li>
                                    <button type="button" wire:click.prevent='filterMessage("received")'
                                        class="dropdown-item"> <!-- active_check -->
                                        <span>Received Messages</span>
                                    </button>
                                </li>

                                <li>
                                    <button type="button" wire:click.prevent='filterMessage("sent")'
                                        class="dropdown-item"> <!-- active_check -->
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
                    </div> --}}
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Read</th>
                                <th>From number</th>
                                <th>To number</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                            <h4 class="phone_number">{{ $log->send_from }}</h4>
                                        </td>
                                        <td>
                                            <h4 class="phone_number">{{ $log->send_to }}</h4>
                                        </td>
                                        <td>
                                            <h4 class="timezone">{{ $log->first_name }} {{ $log->last_name }}</h4>
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
                                                    {{ ucfirst($log->send_status) }}
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                                <a type="button" class="table_edit_btn" wire:click.prevent='getReplies({{ $log->id }})'>
                                                    {!! loadingStateWithText("getReplies($log->id)", 'Replies') !!}
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

    <!-- New Sub Account Modal  -->
    <div wire:ignore.self class="modal fade common_modal sub_account_modal" id="repliesModal"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newEventModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="newEventModal">Bulk Message Replies</h1>
                    <button type="button" wire:click.prevent='resetForm' class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($replies)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th class="text-center">Replied At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($replies as $reply)
                                    <tr>
                                        <td>{{ $reply->message }}</td>
                                        <td class="text-center" style="width: 25%;">
                                            {{ \Carbon\Carbon::parse($reply->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($reply->created_at)->format('g:i A') : \Carbon\Carbon::parse($reply->created_at)->format('F j, Y, g:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });

            window.addEventListener('showReplies', event => {
                $('#repliesModal').modal('show');
            });
        });
    </script>
@endpush
