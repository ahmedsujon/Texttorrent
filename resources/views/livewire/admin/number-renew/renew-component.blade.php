<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Number Renew Alert</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Number Renew Alert</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e2e7;">
                            <h4 class="card-title" style="float: left;">All Number Renew Alert</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                    <label class="font-weight-normal" style="">Show</label>
                                    <select name="sortuserresults" class="sinput" id=""
                                        wire:model.blur="sortingValue" wire:change='resetPage'>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <label class="font-weight-normal" style="">entries</label>
                                </div>

                                <div style="position: absolute; text-align: center;" wire:loading
                                    wire:target='searchTerm,sortingValue,previousPage,gotoPage,nextPage'>
                                    <span class="bg-light" style="padding: 5px 15px; border-radius: 2px;"><span
                                            class="spinner-border spinner-border-xs align-middle" role="status"
                                            aria-hidden="true"></span> Processing</span>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                    <label class="font-weight-normal mr-2">Search:</label>
                                    <input type="search" class="sinput" placeholder="Search..."
                                        wire:model.live="searchTerm" wire:keyup='resetPage' />
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'id',
                                                    'thDisplayName' => 'ID',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'number',
                                                    'thDisplayName' => 'Phone Number',
                                                ]
                                            )

                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'number',
                                                    'thDisplayName' => 'Remaining Days',
                                                ]
                                            )

                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'next_renew_date',
                                                    'thDisplayName' => 'Expire Date',
                                                ]
                                            )

                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'type',
                                                    'thDisplayName' => 'Type',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'region',
                                                    'thDisplayName' => 'Location',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'role',
                                                    'thDisplayName' => 'Capabilities',
                                                ]
                                            )

                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($renew_alerts->count() > 0)
                                            @php
                                                $sl =
                                                    $renew_alerts->perPage() * $renew_alerts->currentPage() -
                                                    ($renew_alerts->perPage() - 1);
                                            @endphp
                                            @foreach ($renew_alerts as $renew_alert)
                                                <tr>
                                                    <td class="align-middle">{{ $sl++ }}</td>
                                                    <td class="align-middle">{{ $renew_alert->number }}</td>
                                                    <td class="align-middle">
                                                        @php
                                                            $remainingDays = \Carbon\Carbon::now()->diffInDays(
                                                                $renew_alert->next_renew_date,
                                                                false,
                                                            );
                                                        @endphp
                                                        {{ $remainingDays > 0 ? $remainingDays . ' days' : 'Expired' }}
                                                    </td>

                                                    <td class="align-middle">{{ $renew_alert->next_renew_date }}</td>
                                                    <td class="align-middle">{{ $renew_alert->type }}</td>
                                                    <td class="align-middle">
                                                        {{ $renew_alert['region'] ? $renew_alert['region'] . ', ' : '' }}{{ $renew_alert['country'] }}
                                                    </td>
                                                    <td class="align-middle">
                                                        @if ($renew_alert['capabilities']['voice'] == 1)
                                                            <div class="capability_status">Voice</div>
                                                        @endif
                                                        @if ($renew_alert['capabilities']['sms'] == 1)
                                                            <div class="capability_status sms">SMS</div>
                                                        @endif
                                                        @if ($renew_alert['capabilities']['mms'] == 1)
                                                            <div class="capability_status mms">MMS</div>
                                                        @endif
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <button
                                                            class="btn btn-sm btn-soft-danger waves-effect waves-light action-btn delete_btn"
                                                            wire:click.prevent='deleteConfirmation({{ $renew_alert->id }})'
                                                            wire:loading.attr='disabled'>
                                                            <i class="bx bx-trash font-size-13 align-middle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center pt-5 pb-5">No data available!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            {{ $renew_alerts->links('livewire.admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteDataModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md" role="document">
            <div class="modal-content p-5 bg-transparent border-0">
                <div class="modal-body pt-4 pb-4 bg-white" style="border-radius: 10px;">
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-11 text-center">
                            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                                <div class="swal2-icon-content">!</div>
                            </div>
                            <h2>Are you sure?</h2>
                            <p class="mb-4">You won't be able to revert this!</p>

                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                                wire:click.prevent='deleteData' wire:loading.attr='disabled'>
                                {!! loadingStateWithText('deleteData', 'Yes, Delete.') !!}
                            </button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">No, Cancel.</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->
</div>

@push('scripts')
    <script>
        window.addEventListener('showEditModal', event => {
            $('#editDataModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
        });

        window.addEventListener('number_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The expired number has been deleted.",
                "success"
            );
        });
    </script>
@endpush
