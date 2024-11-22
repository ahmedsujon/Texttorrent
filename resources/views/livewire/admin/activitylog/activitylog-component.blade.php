<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Activity</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Activity</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e2e7;">
                            <h4 class="card-title" style="float: left;">All Activity</h4>
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
                                            <th class="align-middle">#</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle">Event</th>
                                            <th class="align-middle text-center">Details</th>
                                            <th class="align-middle text-center" style="width: 15%;">Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($activities->count() > 0)
                                            @php
                                                $sl =
                                                    $activities->perPage() * $activities->currentPage() -
                                                    ($activities->perPage() - 1);
                                            @endphp

                                            @foreach ($activities as $activity)
                                                <tr>
                                                    <td class="align-middle">{{ $sl++ }}</td>
                                                    @if ($activity->causer_id)
                                                    <td class="align-middle">{{ getAdminByID($activity->causer_id)->name }}</td>
                                                    @else
                                                    <td class="align-middle">null</td>

                                                    @endif
                                                    <td class="align-middle">{{ $activity->event }}</td>

                                                    @php
                                                        $properties = json_decode($activity->properties, true);
                                                    @endphp

                                                    <td class="align-middle">
                                                        @if (isset($properties['old']))
                                                            <strong>Old Data:</strong>
                                                            <ul>
                                                                @foreach ($properties['old'] as $key => $value)
                                                                    <li><strong>{{ ucfirst($key) }}:</strong>
                                                                        {{ $value }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>No old data available.</p>
                                                        @endif

                                                        @if (isset($properties['attributes']))
                                                            <strong>Updated Data:</strong>
                                                            <ul>
                                                                @foreach ($properties['attributes'] as $key => $value)
                                                                    <li><strong>{{ ucfirst($key) }}:</strong>
                                                                        {{ $value }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>No updated data available.</p>
                                                        @endif
                                                    </td>


                                                    <td class="align-middle">{{ $activity->created_at }}</td>
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
                            {{ $activities->links('livewire.admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
