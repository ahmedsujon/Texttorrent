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
                <div class="event_form_area">
                    <div class="input_row">
                        <label for="">Please enter Area code to search for number</label>
                        <form wire:submit.prevent='areaCodeSearch'>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model='areaCode' placeholder="Type Area Code" style="color: #0b1234;font-size: 14px;font-style: normal;font-weight: 400;border: 1px solid #fff;padding: 9px 12px;border-radius: 8px 0px 0px 8px;background: #fff;box-shadow: 0px 1px 2px 0px rgba(11, 18, 52, 0.15), 0px 0px 0px 1px rgba(11, 18, 52, 0.1);">
                                <button type="submit" class="input-group-text" style="color: #0b1234;font-size: 14px;font-style: normal; display: flex; justify-content: center; align-items: center; font-weight: 400;width: 15%;border: 1px solid #fff;padding: 9px 12px;border-radius: 0px 8px 8px 0px;background: #fff; cursor: pointer; box-shadow: 0px 1px 2px 0px rgba(11, 18, 52, 0.15), 0px 0px 0px 1px rgba(11, 18, 52, 0.1);">
                                    {!! loadingStateWithoutText('areaCodeSearch', '<img src="'.asset('assets/app/icons/search-gray.svg').'" alt="search icon" style="height: 15px; width: 15px;">') !!}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="buy_action_grid">
                        <div class="input_row">
                            <input type="text" placeholder="Type number of  buy link"
                                class="input_field quantity_input_field" value="0" wire:model.live='qty' />
                            <button type="button" class="quantity_btn" wire:click.prevent='minusQty'>
                                <img src="{{ asset('assets/app/icons/minus-gray.svg') }}" alt="minus icon" />
                            </button>
                            <button type="button" class="quantity_btn plus_quantity_btn" wire:click.prevent='plusQty'>
                                <img src="{{ asset('assets/app/icons/plus-gray.svg') }}" alt="plus icon" />
                            </button>
                        </div>
                        <button type="button" class="create_template_btn" wire:click.prevent='bulkPurchaseConfirmation'>
                            {!! loadingStateWithoutText('bulkPurchaseConfirmation', '<img src="'.asset('assets/app/icons/shopping-cart.svg').'" alt="cart icon white" />') !!}
                            <span>Buy in bulk</span>
                        </button>
                    </div>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form">
                        <input type="search" placeholder="Search number" class="input_field" />
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
                    <span wire:loading wire:target='numberType'><i class="fa fa-spinner fa-spin"></i> Processing...</span>
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
                            @if (count($numbers) > 0)
                                @foreach ($numbers as $number)
                                    <tr>
                                        <td>
                                            <div class="phone_number_area d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/app/icons/phone.svg') }}" alt="phone icon" />
                                                <h4 class="timezone">{{ $number['phoneNumber'] }}</h4>
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

                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                                <button type="button" class="icon_btn"
                                                    wire:click.prevent='purchaseNumberConfirmation("{{ $number['phoneNumber'] }}", "{{ $number['friendlyName'] }}", "{{ $number['region'] }}", "{{ $number['isoCountry'] }}", "{{ $number['latitude'] }}", "{{ $number['longitude'] }}", "{{ $number['postalCode'] }}")'>
                                                    {{-- data-bs-toggle="modal" data-bs-target="#confirmPurchaseModal" --}}
                                                    <img src="{{ asset('assets/app/icons/shopping-cart.svg') }}"
                                                        alt="" />
                                                </button>
                                                {{-- <div class="dropdown">
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
                                            </div> --}}
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



        <!-- Confirm Modal  -->
        <div wire:ignore.self class="modal fade common_modal confirm_purchase_modal" id="confirmPurchaseModal" tabindex="-1"
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
                            <img class="cart_purchase_icon"
                                src="{{ asset('assets/app/images/others/shopping-cart-02.png') }}" alt="cart icon" />
                            <h3>
                                Buying a phone number will cost you 295 credits per month
                            </h3>
                        </div>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='purchaseNumber' wire:loading.attr="disabled" class="create_event_btn">
                            {!! loadingStateWithText('purchaseNumber', 'Purchase') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade common_modal confirm_purchase_modal" id="confirmBulkPurchaseModal" tabindex="-1"
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
                            <div class="row justify-content-center">
                                @if ($selected_numbers)
                                    @foreach ($selected_numbers as $sNumber)
                                        <div class="col-md-auto text-center mb-2">
                                            <div class="card card-body ps-3 pe-3 p-1">
                                                {{ $sNumber }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            {{-- <img class="cart_purchase_icon"
                                src="{{ asset('assets/app/images/others/shopping-cart-02.png') }}" alt="cart icon" /> --}}
                            <small class="mt-3">
                                Buying a phone number will cost you 295 credits per month
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='bulkPurchaseNumber' wire:loading.attr="disabled" class="create_event_btn">
                            {!! loadingStateWithText('bulkPurchaseNumber', 'Purchase') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade common_modal confirm_purchase_modal" id="purchaseResultModal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Your Purchase Results
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="purchase_area">
                            @if (session()->has('purchase_result'))
                                <table class="table table-bordered">
                                    @foreach (session('purchase_result') as $key => $result)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $result['number'] }}</td>
                                            <td class="text-center">{!! $result['status'] !!}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.sortingValue').on('change', function(){
                @this.set('sortingValue', this.value);
            });

            $('.numberType').on('change', function(){
                @this.set('numberType', this.value);
            });
        });
    </script>
    <script>
        window.addEventListener('showBulkPurchaseModal', event => {
            $('#confirmBulkPurchaseModal').modal('show');
        });

        window.addEventListener('showPurchaseModal', event => {
            $('#confirmPurchaseModal').modal('show');
        });

        window.addEventListener('bulk_purchase_complete', event => {
            $('#confirmBulkPurchaseModal').modal('hide');
            $('#purchaseResultModal').modal('show');
        });

        window.addEventListener('purchase_success', event => {
            $('#confirmPurchaseModal').modal('hide');
            Swal.fire(
                "Success!",
                "Number Purchased Successfully!",
                "success"
            );
        });
    </script>
@endpush
