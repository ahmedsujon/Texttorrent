<div>
    <main class="main_content_wrapper">
        <!-- Claims  Section  -->
        <section class="claims_section_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Claims</h2>
                </div>
            </div>
            <div class="template_filter_area d-flex-between">
                <form action="" class="search_input_form">
                    <input type="search" placeholder="Search folder" wire:model.live='searchTerm' class="input_field" />
                    <button type="button" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                    </button>
                </form>
                <div class="filter_btn_area d-flex align-items-center justify-content-end flex-wrap g-xs">
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/cart.svg') }}" alt="column insert" />
                        <span>Accept</span>
                    </button>
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/user-block-02.svg') }}" alt="column insert" />
                        <span>Blacklist</span>
                    </button>
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="column insert" />
                        <span>Delete</span>
                    </button>

                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="column insert" />
                        <span>Export</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive border_table">
                    <table class="table table_sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="checkbox_name_area">
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" type="checkbox" value="" />
                                        </div>
                                        <div class="column_area">
                                            <span>Number</span>
                                            <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}"
                                                alt="top down arrow" />
                                        </div>
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="column_area">
                                        <span>Message</span>
                                        <img src="{{ asset('assets/app/icons/tp-down-table-arrow.svg') }}"
                                            alt="top down arrow" />
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
                            @if ($claims->count() > 0)
                                @foreach ($claims as $claim)
                                    <tr>
                                        <td>
                                            <div class="checkbox_name_cell_area">
                                                <div class="form-check table_checkbox_area">
                                                    <input class="form-check-input" type="checkbox" value="" />
                                                </div>
                                                <p>{{ $claim->send_to }}</p>
                                            </div>
                                        </td>

                                        <td>

                                            @if ($claim->received_message)
                                                <p>{{ $claim->received_message }}</p>
                                            @else
                                                <p class="text-danger">No message received yet!</p>
                                            @endif

                                        </td>

                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-2">
                                                <button type="button" class="table_edit_btn">
                                                    <img src="{{ asset('assets/app/icons/cart.svg') }}"
                                                        alt="cart icon" />
                                                    <span>Accept</span>
                                                </button>
                                                <button type="button" class="table_edit_btn">
                                                    <img src="{{ asset('assets/app/icons/user-block-04.svg') }}"
                                                        alt="user block icon" />
                                                    <span>Blacklist</span>
                                                </button>
                                                <button type="button" class="table_edit_btn">
                                                    <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                        alt="edit icon" />
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
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
                {{ $claims->links('livewire.app-pagination') }}
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.sortingValue').on('change', function(){
                @this.set('sortingValue', this.value);
            });
        });

        // window.addEventListener('showNumberAssignModal', event => {
        //     $('#assignModal').modal('show');
        // });

        // window.addEventListener('show_release_modal', event => {
        //     $('#releaseModal').modal('show');
        // });

        // window.addEventListener('closeModal', event => {
        //     $('#assignModal').modal('hide');
        // });

        // window.addEventListener('number_deleted', event => {
        //     $('#deleteDataModal').modal('hide');
        //     Swal.fire(
        //         "Deleted!",
        //         "The number has been deleted.",
        //         "success"
        //     );
        // });
    </script>
@endpush
