<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Subscription</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Subscription</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e2e7;">
                            <h4 class="card-title" style="float: left;">All Subscription</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3 col-sm-12 mb-2 sort_cont">
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
                                <div class="col-md-3">
                                    <div class="mb-3 row">
                                        <div class="col-md-10">
                                            <select class="form-select">
                                                <option value="">All</option>
                                                <option value="paid">Paid</option>
                                                <option value="unpaid">Unpaid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="position: absolute; text-align: center;" wire:loading
                                    wire:target='searchTerm,sortingValue,previousPage,gotoPage,nextPage'>
                                    <span class="bg-light" style="padding: 5px 15px; border-radius: 2px;"><span
                                            class="spinner-border spinner-border-xs align-middle" role="status"
                                            aria-hidden="true"></span> Processing</span>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 row">
                                        <label class="col-md-2 col-form-label">Select</label>
                                        <div class="col-md-10">
                                            <select class="form-select">
                                                <option>Select Date</option>
                                                <option>Today</option>
                                                <option>Last 7 Days</option>
                                                <option>Last 30 Days</option>
                                                <option>Last 6 Month</option>
                                                <option>This Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-12 mb-2 search_cont">
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
                                                    'id' => 'user_id',
                                                    'thDisplayName' => 'Customer Name',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'package_name',
                                                    'thDisplayName' => 'Package Name',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'amount',
                                                    'thDisplayName' => 'Amount',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'payment_status',
                                                    'thDisplayName' => 'Status',
                                                ]
                                            )
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($subscriptions->count() > 0)
                                            @php
                                                $sl =
                                                    $subscriptions->perPage() * $subscriptions->currentPage() -
                                                    ($subscriptions->perPage() - 1);
                                            @endphp
                                            @foreach ($subscriptions as $subscription)
                                                <tr>
                                                    <td class="align-middle">{{ $sl++ }}</td>
                                                    <td class="align-middle">
                                                        {{ getUserByID($subscription->user_id)->first_name }}
                                                        {{ getUserByID($subscription->user_id)->last_name }}
                                                    </td>
                                                    <td class="align-middle">{{ $subscription->package_name }}</td>
                                                    <td class="align-middle">{{ $subscription->amount }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ $subscription->payment_status }}</td>
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
                            {{ $subscriptions->links('livewire.admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
