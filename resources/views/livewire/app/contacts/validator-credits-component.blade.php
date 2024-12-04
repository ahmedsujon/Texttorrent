@section('page_title') TextTorrent | Validator Credits @endsection
<div>
    <main class="main_content_wrapper">
        <!-- Validator Number Section  -->
        <section class="validator_number_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Number validator results</h2>
                </div>
            </div>
            <div class="template_filter_area">
                <div class="row">
                    <div class="col-md-4">
                        <form class="search_input_form">
                            <input type="search" placeholder="Search lists" wire:model.live='searchTerm' wire:keyup='resetPage' class="input_field" />
                            <button type="button" class="search_icon">
                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-center">
                        <span wire:loading wire:target='deleteConfirmation,previousPage,nextPage,exportItems'><i class="fa fa-spinner fa-spin"></i> Processing...</span>
                    </div>
                    <div class="col-md-4">
                        <div class="filter_btn_area d-flex align-items-center justify-content-end flex-wrap g-xs">
                            <button type="button" wire:click.prevent="exportData" wire:loading.attr='disabled' class="import_btn">
                                {!! loadingStateWithoutText("exportData", '<img src="'.asset('assets/app/icons/import.svg').'" />') !!}
                                <span>Export</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check table_checkbox_area">
                                        <input class="form-check-input" wire:model.live='check_all' type="checkbox" value="1" />
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>File Name</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Validator Credits</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total numbers</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total mobile numbers</span>
                                    </div>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Total landline numbers</span>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <span>Valid Numbers</span>
                                </th>
                                <th class="text-center">
                                    <span>Invalid Numbers</span>
                                </th>
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Created</span>
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
                            @if ($items->count() > 0)
                                @foreach ($items as $itm)
                                <tr>
                                    <td>
                                        <div class="form-check table_checkbox_area">
                                            <input class="form-check-input" wire:model.live='selectedItems' type="checkbox" value="{{ $itm->id }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="icon_text_area">
                                            <img src="{{ asset('assets/app/icons/file.svg') }}" alt="file icon" />
                                            <p>{{ $itm->list_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="icon_text_area">
                                            <img src="{{ asset('assets/app/icons/coins-dollar.svg') }}" alt="dollar icon" />
                                            <p>{{ $itm->total_credits }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{ $itm->total_number }}</p>
                                    </td>
                                    <td>
                                        <div class="icon_text_area">
                                            <img src="{{ asset('assets/app/icons/exists.svg') }}" alt="exists icon" />
                                            <p>
                                                @if ($itm->total_mobile_numbers == NULL)
                                                    ---
                                                @else
                                                    {{ $itm->total_mobile_numbers }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="icon_text_area">
                                            <img src="{{ asset('assets/app/icons/telephone.svg') }}" alt="telephone icon" />
                                            <p>
                                                @if ($itm->total_landline_numbers == NULL)
                                                    ---
                                                @else
                                                    {{ $itm->total_landline_numbers }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($itm->valid_numbers == NULL)
                                            ---
                                        @else
                                            {{ $itm->valid_numbers }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($itm->invalid_numbers == NULL)
                                            ---
                                        @else
                                            {{ $itm->invalid_numbers }}
                                        @endif
                                    </td>
                                    <td>
                                        <p>
                                            {{ \Carbon\Carbon::parse($itm->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($itm->created_at)->format('g:i A') : \Carbon\Carbon::parse($itm->created_at)->format('F j, Y, g:i A') }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                            <div class="dropdown">
                                                <button class="table_dot_btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <h4>Select</h4>
                                                    </li>
                                                    <li>
                                                        <button type="button" wire:click.prevent='exportItems({{ $itm->id }})' class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/import.svg') }}" alt="copy icon" />
                                                            <span>Export</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" wire:click.prevent='deleteConfirmation({{ $itm->id }})' class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
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
                                    <td colspan="8" class="text-center mt-5 pt-5">No data found!</td>
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
                {{ $items->links('livewire.app-pagination') }}
            </div>
        </section>
    </main>

    <!-- Delete  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" id="deleteDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });
        });

        window.addEventListener('data_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "Data deleted successfully",
                "success"
            );
        });
    </script>
@endpush
