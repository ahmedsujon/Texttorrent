<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Users</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e2e7;">
                            <h4 class="card-title" style="float: left;">All Users</h4>
                            <button class="btn btn-sm btn-dark waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#addDataModal" style="float: right;"><i class="bx bx-plus"></i> Add
                                User</button>
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
                                        wire:model.blur="searchTerm" wire:keyup='resetPage' />
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
                                                    'id' => 'name',
                                                    'thDisplayName' => 'Name',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'username',
                                                    'thDisplayName' => 'Active Plan',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'username',
                                                    'thDisplayName' => 'Current Credits',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'email',
                                                    'thDisplayName' => 'Email',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'phone',
                                                    'thDisplayName' => 'Phone',
                                                ]
                                            )
                                            @include(
                                                'livewire.admin.datatable.admin-datatable-th-sorting',
                                                [
                                                    'id' => 'created_at',
                                                    'thDisplayName' => 'Created Date',
                                                ]
                                            )
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() > 0)
                                            @php
                                                $sl =
                                                    $users->perPage() * $users->currentPage() - ($users->perPage() - 1);
                                            @endphp
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="align-middle">{{ $sl++ }}</td>
                                                    <td class="align-middle">
                                                        @if ($user->avatar)
                                                            <img src="{{ asset($user->avatar) }}"
                                                                class="img-fluid rounded-circle mr-3"
                                                                style="height: 40px; width: 40px;" alt="">
                                                        @else
                                                            <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                                class="img-fluid rounded-circle mr-3"
                                                                style="height: 40px; width: 40px;" alt="">
                                                        @endif
                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $user->latestSubscription->package_name ?? 'No Plan' }}</td>
                                                    <td class="align-middle">{{ $user->credits }}</td>
                                                    <td class="align-middle">{{ $user->email }}</td>
                                                    <td class="align-middle">{{ $user->phone }}</td>
                                                    <td class="align-middle">{{ $user->created_at }}</td>
                                                    <td style="text-align: center;">
                                                        <div class="btn-group" role="group">
                                                            <button id="btnGroupVerticalDrop1" type="button"
                                                                class="btn btn-outline-primary waves-effect waves-light"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Options <i class="mdi mdi-chevron-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="btnGroupVerticalDrop1" style="">
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='editData({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>View Details</button>
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='tenDLCEditData({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>10DLC
                                                                    Registration</button>
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='apiIntrigation({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>API
                                                                    Integration</button>
                                                                <a class="dropdown-item" href="#">Change
                                                                    Password</a>
                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='deleteConfirmation({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>Delete
                                                                    account</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center pt-5 pb-5">No data available!
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            {{ $users->links('livewire.admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Edit Data Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" tabindex="-1" role="dialog"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: white;">
                    <h5 class="modal-title m-0" id="mySmallModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent='storeData' enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">First Name</label>
                                        <input class="form-control" type="text" wire:model.blur="first_name"
                                            placeholder="Enter first name">
                                        @error('first_name')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">Last Name</label>
                                        <input class="form-control" type="text" wire:model.blur="last_name"
                                            placeholder="Enter last name">
                                        @error('last_name')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">Username</label>
                                        <input class="form-control" type="text" wire:model.blur="username"
                                            placeholder="Enter username">
                                        @error('username')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">Email</label>
                                        <input class="form-control" type="email" wire:model.blur="email"
                                            placeholder="Enter email">
                                        @error('email')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">Phone</label>
                                        <input class="form-control" type="number" wire:model.blur="phone"
                                            placeholder="Enter phone">
                                        @error('phone')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-number-input" class="col-form-label">Password</label>
                                        <input class="form-control" type="password" wire:model.blur="password"
                                            placeholder="Enter new password">
                                        @error('password')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <label for="example-number-input" class="col-form-label">Image</label>
                                        <input type="file" class="form-control" wire:model.blur='avatar' />
                                        @error('avatar')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror

                                        <div wire:loading wire:target='avatar' wire:key='avatar'>
                                            <span class="spinner-border spinner-border-xs" role="status"
                                                aria-hidden="true"></span> <small>Uploading</small>
                                        </div>
                                        @if ($avatar)
                                            <img src="{{ $avatar->temporaryUrl() }}" class="img-fluid mt-2"
                                                style="height: 55px; width: 55px;" />
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row mt-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-50">
                                            {!! loadingStateWithText('storeData', 'Add User') !!}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Data Modal -->

    <!-- Edit Data Modal -->
    <div wire:ignore.self class="modal fade" id="editDataModal" tabindex="-1" role="dialog"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card bg-info-subtle">
                                <div class="card-body">
                                    <button style="float: right;" type="button" class="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"
                                        wire:click.prevent='close'></button>
                                    <div class="text-center mb-4">
                                        <img src="{{ asset($user->avatar ? $user->avatar : 'assets/images/placeholder.jpg') }}"
                                            alt="avatar" class="avatar-md rounded-circle mx-auto d-block" />
                                        <h5 class="mt-3 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled hstack gap-3 mb-0 flex-grow-1">
                                            <li>
                                                <i class="bx bx-time align-middle"></i> Last Login: 5 days ago
                                            </li>
                                        </ul>
                                        <div class="hstack gap-2">
                                            <button type="button" class="btn btn-primary">Login Account <i
                                                    class='bx bx-download align-baseline ms-1'></i></button>
                                            {{-- <button type="button" class="btn btn-light"><i
                                                    class='bx bx-bookmark align-baseline'></i></button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled vstack gap-3 mb-0">
                                        <li>
                                            <div class="d-flex">
                                                <i class='bx bx-calendar font-size-18 text-primary'></i>
                                                <div class="ms-3">
                                                    <h6 class="mb-1 fw-semibold">Subscription:</h6>
                                                    <span class="text-muted">{{ $package_name ?? 'No Plan' }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <i class='bx bx-money font-size-18 text-primary'></i>
                                                <div class="ms-3">
                                                    <h6 class="mb-1 fw-semibold">Total Credit Spent:</h6>
                                                    <span class="text-muted">{{ $totalCredit }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <i class='bx bx-money font-size-18 text-primary'></i>
                                                <div class="ms-3">
                                                    <h6 class="mb-1 fw-semibold">Current Credit:</h6>
                                                    <span class="text-muted">{{ $credits }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <i class='bx bx-user font-size-18 text-primary'></i>
                                                <div class="ms-3">
                                                    <h6 class="mb-1 fw-semibold">Sub Accounts:</h6>
                                                    {{ $totalChildUsers }}
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <i class='mdi mdi-book-education font-size-18 text-primary'></i>
                                                <div class="ms-3">
                                                    <h6 class="mb-1 fw-semibold">Total Message Sent:</h6>
                                                    <span class="text-muted">{{ $delivered_message }}</span>
                                                </div>
                                            </div>
                                        </li>

                                        @if ($user->status == 0)
                                            <li class="hstack gap-2 mt-3">
                                                <a href="#!" class="btn btn-soft-success w-100"
                                                    wire:click.prevent="setUserForStatusChange({{ $user->id }}, {{ $user->status }})"
                                                    data-bs-toggle="modal" data-bs-target="#statusModal">
                                                    {!! loadingStateStatus('changeStatus', 'Active Account') !!}
                                                </a>
                                            </li>
                                        @else
                                            <li class="hstack gap-2 mt-3">
                                                <a href="#!" class="btn btn-soft-danger w-100"
                                                    wire:click.prevent="setUserForStatusChange({{ $user->id }}, {{ $user->status }})"
                                                    data-bs-toggle="modal" data-bs-target="#statusModal">
                                                    {!! loadingStateStatus('changeStatus', 'Deactivate Account') !!}
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-3">Personal Info</h5>
                                    <form wire:submit.prevent='updateData' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="example-number-input" class="col-form-label">First
                                                    Name</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="first_name" placeholder="Enter first name">
                                                @error('first_name')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="example-number-input" class="col-form-label">Last
                                                    Name</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="last_name" placeholder="Enter last name">
                                                @error('last_name')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="example-number-input"
                                                    class="col-form-label">Username</label>
                                                <input class="form-control" type="text" wire:model.blur="username"
                                                    placeholder="Enter username">
                                                @error('username')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="example-number-input" class="col-form-label">Email</label>
                                                <input class="form-control" type="email" wire:model.blur="email"
                                                    placeholder="Enter email">
                                                @error('email')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="example-number-input" class="col-form-label">Phone</label>
                                                <input class="form-control" type="number" wire:model.blur="phone"
                                                    placeholder="Enter phone">
                                                @error('phone')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="example-number-input"
                                                    class="col-form-label">Password</label>
                                                <input class="form-control" type="password"
                                                    wire:model.blur="password" placeholder="Enter new password">
                                                @error('password')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <label for="example-number-input" class="col-form-label">Image</label>
                                                <input type="file" class="form-control"
                                                    wire:model.blur='avatar' />
                                                @error('avatar')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror

                                                <div wire:loading wire:target='avatar' wire:key='avatar'>
                                                    <span class="spinner-border spinner-border-xs" role="status"
                                                        aria-hidden="true"></span> <small>Uploading</small>
                                                </div>
                                                @if ($avatar)
                                                    <img src="{{ $avatar->temporaryUrl() }}" class="img-fluid mt-2"
                                                        style="height: 55px; width: 55px;" />
                                                @elseif ($uploadedAvatar)
                                                    <img src="{{ asset($uploadedAvatar) }}" class="img-fluid mt-2"
                                                        style="height: 55px; width: 55px;" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 row mt-4" style="float: right;">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-30">
                                                    {!! loadingStateWithText('updateData', 'Update User') !!}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Data Modal -->

    <!-- API Data Modal -->
    <div wire:ignore.self class="modal fade" id="editAPIDataModal" tabindex="-1" role="dialog"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card bg-info-subtle">
                                <div class="card-body">
                                    <button style="float: right;" type="button" class="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"
                                        wire:click.prevent='close'></button>
                                    <div class="text-center mb-4">
                                        <h3 class="mb-3">API INTRIGATION</h3>
                                        <p class="text-muted mb-3">Gateway: {{ $gateway }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form wire:submit.prevent='updateAPIData'>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="account_sid" class="col-form-label">Account Sid</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="account_sid" placeholder="Enter account sid">
                                                @error('account_sid')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="auth_token" class="col-form-label">Auth Token</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="auth_token" placeholder="Enter auth token">
                                                @error('auth_token')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row mt-4" style="float: right;">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-30">
                                                    {!! loadingStateWithText('updateAPIData', 'Update') !!}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End API Data Modal -->

    <!-- 10 DLC Data Modal -->
    <div wire:ignore.self class="modal fade" id="tenDLCEditData" tabindex="-1" role="dialog"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card bg-info-subtle">
                                <div class="card-body">
                                    <button style="float: right;" type="button" class="btn-close"
                                        data-bs-dismiss="modal" aria-label="Close"
                                        wire:click.prevent='close'></button>
                                    <div class="text-center mb-4">
                                        <h3 class="mb-3">10 DLC REGISTRATION</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form wire:submit.prevent='updateAPIData'>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="account_sid" class="col-form-label">Account Sid</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="account_sid" placeholder="Enter account sid">
                                                @error('account_sid')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="auth_token" class="col-form-label">Auth Token</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="auth_token" placeholder="Enter auth token">
                                                @error('auth_token')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row mt-4" style="float: right;">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-30">
                                                    {!! loadingStateWithText('updateAPIData', 'Update') !!}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End 10 DLC Data Modal -->

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

    <!-- Change Status Modal -->
    <div wire:ignore.self class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md" role="document">
            <div class="modal-content p-5 bg-transparent border-0">
                <div class="modal-body pt-4 pb-4 bg-white" style="border-radius: 10px;">
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-11 text-center">
                            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                                <div class="swal2-icon-content">!</div>
                            </div>
                            <h2>Are you sure?</h2>
                            <p class="mb-4">
                                You are about to {{ $status == 1 ? 'deactivate' : 'activate' }} this account. This
                                action cannot be undone!
                            </p>

                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                                wire:click.prevent="changeStatus" wire:loading.attr="disabled">
                                {!! loadingStateWithText('changeStatus', $status == 1 ? 'Yes, Activate.' : 'Yes, Deactivate.') !!}
                            </button>
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">No, Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        window.addEventListener('showEditModal', event => {
            $('#editDataModal').modal('show');
        });
        window.addEventListener('showAPIModal', event => {
            $('#editAPIDataModal').modal('show');
        });

        window.addEventListener('showTenDLCEditModal', event => {
            $('#tenDLCEditData').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
            $('#editAPIDataModal').modal('hide');
            $('#statusModal').modal('hide');
        });

        window.addEventListener('user_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The user has been deleted.",
                "success"
            );
        });
    </script>
@endpush
