<div>
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
                        <h2>Active Numbers</h2>
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
                        <select class="niceSelect niceSelect_area numberType">
                            <option value="local">Local</option>
                            <option value="tollfree">Toll-Free</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <span wire:loading wire:target='numberType'><i class="fa fa-spinner fa-spin"></i>
                        Processing...</span>
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
                                        <span>Status</span>
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
                            @if (count($numbers) > 0)
                                @foreach ($numbers as $number)
                                    <tr>
                                        <td>
                                            <div class="phone_number_area d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                                <h4 class="timezone">{{ $number->number }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="phone_number">{{ $number['region'] }},
                                                {{ $number['isoCountry'] }}</h4>
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
                                        <td class="capability_status_area">
                                            @if ($number['status'] == 0)
                                                <div class="capability_status">Active</div>
                                            @else
                                                <div class="capability_status sms">Inactive</div>
                                            @endif
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
                                                            @if ($number->status == 0)
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

                                                            <button type="button" class="dropdown-item"
                                                                wire:click.prevent='deleteConfirmation({{ $number->id }})'
                                                                wire:loading.attr='disabled'>
                                                                <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                    alt="copy icon" />
                                                                <span>Delete</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center pt-5 pb-0 mb-0">No number found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination_area pagination_top_border">
                <div class="d-flex" wire:ignore>
                    <select class="niceSelect sortingValue">
                        <option value="10">10 Accounts</option>
                        <option value="30">30 Accounts</option>
                        <option value="50">50 Accounts</option>
                        <option value="100">100 Accounts</option>
                    </select>
                </div>
                {{ $numbers->links('livewire.app-pagination') }}
            </div>
        </section>

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
    </main>
</div>
@push('scripts')
    <script>
        window.addEventListener('number_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The number has been deleted.",
                "success"
            );
        });
    </script>
@endpush
