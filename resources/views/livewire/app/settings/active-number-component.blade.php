@section('page_title') TextTorrent | My Numbers @endsection
<div>
    <style>
        .mr-5 {
            margin-right: 5px;
        }
    </style>
    <main class="main_content_wrapper setting_content_wrapper">
        <section class="get_number_wrapper account_border">
            <div class="number_buy_area">
                <div class="account_title_area">
                    <div class="d-flex align-items-center flex-wrap g-sm">
                        <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                            <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                        </button>
                        <img src="{{ asset('assets/app/icons/shopping-cart-02.svg') }}" alt="cart icon"
                            class="user_icon" />
                        <h2>My Numbers</h2>
                    </div>


                    <div class="mt-4">
                        @if (user()->type != 'sub')
                            <button type="button" class="create_event_btn" style="color: white !important;" wire:click.prevent='assignNumberToUser'>
                                {!! loadingStateWithText(
                                    'assignNumberToUser',
                                    'Assign User',
                                ) !!}
                            </button>
                        @endif

                        <button type="button" class="create_event_btn" style="color: white !important;" wire:click.prevent='bulkReleaseConfirmation'>
                            {!! loadingStateWithText(
                                'bulkReleaseConfirmation',
                                'Bulk Release',
                            ) !!}
                        </button>
                    </div>

                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form">
                        <input type="search" placeholder="Search number" wire:model.live='searchTerm'
                            class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>
                    <div wire:ignore>
                        <select class="niceSelect niceSelect_area sort_status">
                            <option value="all">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div wire:ignore>
                        <select class="niceSelect niceSelect_area sort_type">
                            <option value="local">Local</option>
                            <option value="tollfree">Toll-Free</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <span wire:loading wire:target='numberType,sort_type,sort_status,renewConfirmation'><i
                            class="fa fa-spinner fa-spin"></i>
                        Processing...</span>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            wire:change="selectAll" id="formCheckAll" wire:model.live="check_all">
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Phone number</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Type</span>
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
                                        <span>Assigned To</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="text-center" scope="col">
                                    <span>WebHook</span>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($numbers) > 0)
                                @foreach ($numbers as $number)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input contact-checkbox" type="checkbox"
                                                    name="selectedNumbers" wire:model.live="selectedNumbers"
                                                    value="{{ $number->id }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="phone_number_area d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                                <h4 class="timezone">{{ $number->number }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="phone_number_area d-flex align-items-center gap-2">
                                                <h4 class="timezone">{{ $number->type }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="phone_number">
                                                {{ $number['region'] ? $number['region'] . ', ' : '' }}{{ $number['country'] }}
                                            </h4>
                                        </td>

                                        <td>
                                            <div class="capability_status_area">
                                                @if ($number['capabilities']['voice'] == 1)
                                                    <div class="capability_status">Voice</div>
                                                @endif
                                                @if ($number['capabilities']['sms'] == 1)
                                                    <div class="capability_status sms">SMS</div>
                                                @endif
                                                @if ($number['capabilities']['mms'] == 1)
                                                    <div class="capability_status mms">MMS</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="phone_number">{{ getUserByID($number->user_id)->first_name }}
                                                {{ getUserByID($number->user_id)->last_name }}</h4>
                                        </td>
                                        <td class="capability_status_area">
                                            @if ($number['status'] == 1)
                                                <div class="capability_status">Active</div>
                                            @else
                                                <div class="capability_status sms">Inactive</div>
                                            @endif

                                            @if ($number['next_renew_date'] < Carbon\Carbon::parse(now())->format('Y-m-d'))
                                                <div class="capability_status sms">Expired</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary"
                                                wire:click.prevent='setWebhook("{{ $number->number }}")'>{!! loadingStateWithText("setWebhook('" . $number->number . "')", 'Set WebHook') !!}</button>
                                        </td>
                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                                <div class="dropdown">
                                                    <button class="table_dot_btn dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                            alt="dot icon" />
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <h4>Select</h4>
                                                        </li>
                                                        <li>
                                                            @if ($number['next_renew_date'] < Carbon\Carbon::parse(now())->format('Y-m-d'))
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='renewConfirmation({{ $number->id }})'>
                                                                    <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                        alt="copy icon" />
                                                                    <span>Renew</span>
                                                                </button>
                                                            @else
                                                                @if ($number->status == 1)
                                                                    <button type="button" class="dropdown-item"
                                                                        wire:click.prevent='changeStatus({{ $number->id }}, {{ $number->status }})'>
                                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                            alt="copy icon" />
                                                                        <span>Inactive</span>
                                                                    </button>
                                                                @else
                                                                    <button type="button" class="dropdown-item"
                                                                        wire:click.prevent='changeStatus({{ $number->id }}, {{ $number->status }})'>
                                                                        <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                            alt="copy icon" />
                                                                        <span>Active</span>
                                                                @endif
                                                            @endif

                                                            <button type="button" class="dropdown-item"
                                                                wire:click.prevent='releaseConfirmation({{ $number->id }}, {{ $number->status }})'
                                                                wire:loading.attr='disabled'>
                                                                <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                    alt="copy icon" />
                                                                <span>Release</span>
                                                            </button>

                                                            {{-- <button type="button" class="dropdown-item"
                                                                wire:click.prevent='deleteConfirmation({{ $number->id }})'
                                                                wire:loading.attr='disabled'>
                                                                <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                    alt="copy icon" />
                                                                <span>Delete</span>
                                                            </button> --}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center pt-5 pb-0 mb-0">No number found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination_area pagination_top_border">
                <div class="d-flex" wire:ignore>
                    <select class="niceSelect sortingValue">
                        <option value="10">10 Numbers</option>
                        <option value="30">30 Numbers</option>
                        <option value="50">50 Numbers</option>
                        <option value="100">100 Numbers</option>
                    </select>
                </div>
                {{ $numbers->links('livewire.app-pagination') }}
            </div>
        </section>

        <!-- Assign Modal  -->
        <div class="modal fade common_modal" wire:ignore.self id="assignModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Phone Numbers Bulk Assign
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form class="event_form_area" wire:submit.prevent='assignToUser'>
                        <div class="modal-body pb-5">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-2">Selected Numbers</div>
                                @if ($s_numbers)
                                    @foreach ($s_numbers as $sNumber)
                                        <div class="col-md-4 text-center mb-2">
                                            <div class="card card-body ps-3 pe-3 p-1">
                                                {{ $sNumber }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">User</label>
                                <select name="lang" class="js-searchBox user_to_assign">
                                    <option value="">Choose User</option>
                                    @foreach ($sub_accounts as $sub_account)
                                        <option value="{{ $sub_account->id }}">{{ $sub_account->first_name }} {{ $sub_account->last_name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('user_to_assign')
                                <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('assignToUser', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Release  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="releaseModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to release this number?</h2>
                            <h4>Once released, this number will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='releaseNumber'
                                    wire:loading.attr='disabled' class="delete_yes_btn">
                                    {!! loadingStateWithText('releaseNumber', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="deleteDataModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to permanently delete this event?</h2>
                            <h4>Once deleted, this event will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='deleteData' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('deleteData', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk release -->
        <div wire:ignore.self class="modal fade delete_modal" id="bulkReleaseDataModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Are you sure?</h2>
                            <h4>Would you like to release selected numbers?</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='bulkRelease' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('bulkRelease', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Renewal Modal -->
        <div wire:ignore.self class="modal fade delete_modal" id="renewModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Are you sure?</h2>
                            <h4>You want to renew this number?</h4>
                            <h5 class="mt-3">Renew cost: <b>300</b> credits</h5>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='renewNumber' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('renewNumber', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });
        });

        $(document).ready(function() {
            $('.sort_status').on('change', function() {
                @this.set('sort_status', this.value);
            });

            $('.sort_type').on('change', function() {
                @this.set('sort_type', this.value);
            });

            $('.user_to_assign').on('change', function() {
                @this.set('user_to_assign', this.value);
            });
        });

        window.addEventListener('showNumberAssignModal', event => {
            $('#assignModal').modal('show');
        });

        window.addEventListener('show_release_modal', event => {
            $('#releaseModal').modal('show');
        });

        window.addEventListener('showRenewModal', event => {
            $('#renewModal').modal('show');
        });

        window.addEventListener('numberRenewed', event => {
            $('#renewModal').modal('hide');
            Swal.fire(
                "Success!",
                "The number has been renewed successfully.",
                "success"
            );
        });


        window.addEventListener('closeModal', event => {
            $('#assignModal').modal('hide');
            $('#releaseModal').modal('hide');
        });

        window.addEventListener('number_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The number has been deleted.",
                "success"
            );
        });

        window.addEventListener('showBulkReleaseConfirmation', event => {
            $('#bulkReleaseDataModal').modal('show');
        });

        window.addEventListener('numberReleased', event => {
            $('#bulkReleaseDataModal').modal('hide');
            Swal.fire(
                "Released!",
                "Numbers have been released successfully.",
                "success"
            );
        });
    </script>
@endpush
