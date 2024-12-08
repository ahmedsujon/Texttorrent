@section('page_title') TextTorrent | Claims @endsection
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
                    <button type="button" class="import_btn" wire:click.prevent="bulkConfirmation('accept')" wire:loading.attr='disabled'>
                        {!! loadingStateWithoutText("bulkConfirmation('accept')", '<img src="'.asset('assets/app/icons/cart.svg').'" />') !!}
                        <span>Accept</span>
                    </button>
                    <button type="button" class="import_btn" wire:click.prevent="bulkConfirmation('blacklist')" wire:loading.attr='disabled'>
                        {!! loadingStateWithoutText("bulkConfirmation('blacklist')", '<img src="'.asset('assets/app/icons/user-block-02.svg').'" />') !!}
                        <span>Blacklist</span>
                    </button>
                    <button type="button" class="import_btn" wire:click.prevent="bulkConfirmation('delete')" wire:loading.attr='disabled'>
                        {!! loadingStateWithoutText("bulkConfirmation('delete')", '<img src="'.asset('assets/app/icons/delete-03.svg').'" />') !!}
                        <span>Delete</span>
                    </button>

                    <button type="button" class="import_btn" wire:click.prevent="bulkExport" wire:loading.attr='disabled'>
                        {!! loadingStateWithoutText("bulkExport", '<img src="'.asset('assets/app/icons/import.svg').'" />') !!}
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
                                            <input class="form-check-input" value="1" wire:model.live='select_all' type="checkbox" value="" />
                                        </div>
                                        <div class="column_area">
                                            <span>Number</span>
                                        </div>
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="column_area">
                                        <span>Message</span>
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
                                                    <input class="form-check-input" value="{{ $claim->id }}" wire:model.live='bulk_ids' type="checkbox" />
                                                </div>
                                                <p>{{ $claim->send_to }}</p>
                                            </div>
                                        </td>

                                        <td>
                                            @if ($claim->received_message)
                                                <p>{{ $claim->received_message }}</p>
                                            @else
                                                <p>Waiting!</p>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-2">
                                                <button type="button" class="table_edit_btn" wire:click.prevent='acceptConfirmation({{ $claim->id }})' wire:loading.attr='disabled'>
                                                    {!! loadingStateWithoutText('acceptConfirmation('.$claim->id.')', '<img src="'.asset('assets/app/icons/cart.svg').'" />') !!}
                                                    <span>Accept</span>
                                                </button>
                                                <button type="button" class="table_edit_btn" wire:click.prevent='blacklistConfirmation({{ $claim->id }})' wire:loading.attr='disabled'>
                                                    {!! loadingStateWithoutText('blacklistConfirmation('.$claim->id.')', '<img src="'.asset('assets/app/icons/user-block-04.svg').'" />') !!}
                                                    <span>Blacklist</span>
                                                </button>
                                                <button type="button" class="table_edit_btn" wire:click.prevent='deleteConfirmation({{ $claim->id }})' wire:loading.attr='disabled'>
                                                    {!! loadingStateWithoutText('deleteConfirmation('.$claim->id.')', '<img src="'.asset('assets/app/icons/delete-03.svg').'" />') !!}
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center mt-5 pt-5">No claims found!</td>
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
                {{ $claims->links('livewire.app-pagination') }}
            </div>
        </section>
    </main>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="acceptClaimModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to accept this claim?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='acceptClaim' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('acceptClaim', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="blacklistClaimModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to blacklist this contact?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='blacklistClaim' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('blacklistClaim', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="deleteClaimModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to delete this claim?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='deleteClaim' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('deleteClaim', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="acceptClaimBulkModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to accept selected claims?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='acceptClaimBulk' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('acceptClaimBulk', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="blacklistClaimBulkModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to blacklist selected contacts?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='blacklistClaimBulk' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('blacklistClaimBulk', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Accept  Modal  -->
    <div wire:ignore.self class="modal fade delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="deleteClaimBulkModal" tabindex="-1"
    aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content_area">
                        <h2>Are you sure?</h2>
                        <h4>You want to delete selected claims?</h4>
                        <div class="delete_action_area d-flex align-items-center flex-wrap">
                            <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" wire:click.prevent='deleteClaimBulk' wire:loading.attr='disabled'
                                class="delete_yes_btn">
                                {!! loadingStateWithText('deleteClaimBulk', 'Yes') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize socket.io connection if it hasn't been initialized
            if (!window.socket) {
                window.socket = io('{{ env('SOCKET_SERVER') }}'); // Change to your server URL

                // Remove any previous listener to avoid duplication
                window.socket.off('receive_message');

                window.socket.on('receive_message', function(data) {
                    if (data.content.user_id == {{ user()->id }} && data.content.type == 'claim') {
                        @this.refreshComponents();
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.sortingValue').on('change', function(){
                @this.set('sortingValue', this.value);
            });

            window.addEventListener('showClaimAcceptConfirmation', event => {
                $('#acceptClaimModal').modal('show');
            });
            window.addEventListener('showClaimBlacklistConfirmation', event => {
                $('#blacklistClaimModal').modal('show');
            });
            window.addEventListener('showClaimDeleteConfirmation', event => {
                $('#deleteClaimModal').modal('show');
            });
            window.addEventListener('showBulkAcceptConfirmation', event => {
                $('#acceptClaimBulkModal').modal('show');
            });
            window.addEventListener('showBulkBlacklistConfirmation', event => {
                $('#blacklistClaimBulkModal').modal('show');
            });
            window.addEventListener('showBulkDeleteConfirmation', event => {
                $('#deleteClaimBulkModal').modal('show');
            });

            window.addEventListener('closeModal', event => {
                $('#acceptClaimModal').modal('hide');
                $('#blacklistClaimModal').modal('hide');
                $('#deleteClaimModal').modal('hide');
                $('#acceptClaimBulkModal').modal('hide');
                $('#blacklistClaimBulkModal').modal('hide');
                $('#deleteClaimBulkModal').modal('hide');
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
