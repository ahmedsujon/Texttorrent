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
                                                    'id' => 'parent_id',
                                                    'thDisplayName' => 'Account Type',
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
                                                    <td>
                                                        @if ($user->parent_id)
                                                            <p>Sub Account</p> <b>Main AC:
                                                                {{ getUserByID($user->parent_id)->email }}</b>
                                                        @else
                                                            <p>Main Account</p>
                                                        @endif
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

                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='creditsEditData({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>Credits</button>

                                                                <button type="button" class="dropdown-item"
                                                                    wire:click.prevent='changePasswordData({{ $user->id }})'
                                                                    wire:loading.attr='disabled'>Change
                                                                    Password</button>

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
                                        <img src="{{ asset($avatar ? $avatar : 'assets/images/placeholder.jpg') }}"
                                            alt="avatar" class="avatar-md rounded-circle mx-auto d-block" />
                                        <h5 class="mt-3 mb-1">{{ $first_name }} {{ $last_name }}</h5>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled hstack gap-3 mb-0 flex-grow-1">
                                            <li>
                                                <i class="bx bx-time align-middle"></i> Last Login: 5 days ago
                                            </li>
                                        </ul>
                                        <div class="hstack gap-2">
                                            <a href="javascript:void(0)" type="button" target="_blank"
                                                onclick="event.preventDefault(); document.getElementById('login-form_{{ $edit_id }}').submit();"
                                                class="btn btn-primary">Login Account <i
                                                    class='bx bx-download align-baseline ms-1'></i></a>

                                            <form id="login-form_{{ $edit_id }}" style="display: none;"
                                                method="POST" action="{{ route('loginAsUser') }}">
                                                @csrf
                                                <input type="text" name="email" value="{{ $email }}"
                                                    id="email">
                                                <input type="text" name="password" value="{{ $password }}"
                                                    id="password">
                                            </form>
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

                                        @if ($status == 0)
                                            <li class="hstack gap-2 mt-3">
                                                <a href="#!" class="btn btn-soft-success w-100"
                                                    wire:click.prevent="setUserForStatusChange({{ $edit_id }}, {{ $status }})"
                                                    data-bs-toggle="modal" data-bs-target="#statusModal">
                                                    {!! loadingStateStatus('changeStatus', 'Active Account') !!}
                                                </a>
                                            </li>
                                        @else
                                            <li class="hstack gap-2 mt-3">
                                                <a href="#!" class="btn btn-soft-danger w-100"
                                                    wire:click.prevent="setUserForStatusChange({{ $edit_id }}, {{ $status }})"
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist" wire:ignore>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home1"
                                                role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Brand Registration</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab"
                                                aria-selected="false" tabindex="-1">
                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                <span class="d-none d-sm-block">Campaign Registration</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active show" id="home1" role="tabpanel"
                                            wire:ignore.self>
                                            <form wire:submit.prevent='saveBrandData'>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="company_name" class="col-form-label">Company
                                                            Name</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="company_name"
                                                            placeholder="Enter company name">
                                                        @error('company_name')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="company_phone" class="col-form-label">Company
                                                            phone
                                                            number</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="company_phone"
                                                            placeholder="Enter company phone">
                                                        @error('company_phone')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="company_website" class="col-form-label">Company
                                                            Website</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="company_website"
                                                            placeholder="Enter company website">
                                                        @error('company_website')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="industry" class="col-form-label">Industry</label>
                                                        <select class="form-select" wire:model.blur='industry'>
                                                            <option value="">Select Industry</option>
                                                            <option value="AGRICULTURE">Agriculture</option>
                                                            <option value="COMMUNICATION">Communication</option>
                                                            <option value="CONSTRUCTION">Construction</option>
                                                            <option value="EDUCATION">Education</option>
                                                            <option value="ENERGY">Energy</option>
                                                            <option value="ENTERTAINMENT">Entertainment</option>
                                                            <option value="FINANCIAL">Financial</option>
                                                            <option value="GAMBLING">Gambling</option>
                                                            <option value="GOVERNMENT">Government</option>
                                                            <option value="HEALTHCARE">Healthcare</option>
                                                            <option value="HOSPITALITY">Hospitality</option>
                                                            <option value="INSURANCE">Insurance</option>
                                                            <option value="MANUFACTURING">Manufacturing</option>
                                                            <option value="NGO">NGO</option>
                                                            <option value="REAL_ESTATE">Real Estate</option>
                                                            <option value="RETAIL">Retail</option>
                                                            <option value="TECHNOLOGY">Technology</option>
                                                        </select>
                                                        @error('industry')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="organization_type"
                                                            class="col-form-label">Organization
                                                            type</label>
                                                        <select class="form-select"
                                                            wire:model.blur="organization_type">
                                                            <option value="">Select type</option>
                                                            <option value="PUBLIC_PROFIT">
                                                                Publicly Traded Company
                                                            </option>
                                                            <option value="PRIVATE_PROFIT">Private Company</option>
                                                            <option value="NON_PROFIT">
                                                                Charity/Non-Proft Organization
                                                            </option>
                                                        </select>
                                                        @error('organization_type')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="country_of_registration"
                                                            class="col-form-label">Country of
                                                            registration</label>
                                                        <select class="form-select"
                                                            wire:model.blur="country_of_registration">
                                                            <option value="">Select Country</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antarctica">Antarctica</option>
                                                            <option value="Antigua and Barbuda">
                                                                Antigua and Barbuda
                                                            </option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">
                                                                Bosnia and Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Bouvet Island">Bouvet Island</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="British Indian Ocean Territory">
                                                                British Indian Ocean Territory
                                                            </option>
                                                            <option value="Brunei Darussalam">
                                                                Brunei Darussalam
                                                            </option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">
                                                                Central African Republic
                                                            </option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos Keeling Islands">
                                                                Cocos Keeling Islands
                                                            </option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo">Congo</option>
                                                            <option value="Congo The Democratic Republic of The">
                                                                Congo The Democratic Republic of The
                                                            </option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">
                                                                Dominican Republic
                                                            </option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">
                                                                Equatorial Guinea
                                                            </option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands Malvinas">
                                                                Falkland Islands Malvinas
                                                            </option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">
                                                                French Southern Territories
                                                            </option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="Gambia">Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guernsey">Guernsey</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Heard Island and Mcdonald Islands">
                                                                Heard Island and Mcdonald Islands
                                                            </option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran Islamic Republic of">
                                                                Iran Islamic Republic of
                                                            </option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Isle of Man">Isle of Man</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jersey">Jersey</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea Republic of">
                                                                Korea Republic of
                                                            </option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libyan Arab Jamahiriya">
                                                                Libyan Arab Jamahiriya
                                                            </option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macao">Macao</option>
                                                            <option value="Macedonia The Former Yugoslav Republic of">
                                                                Macedonia The Former Yugoslav Republic of
                                                            </option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Martinique">Martinique</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mayotte">Mayotte</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesi Federated States of">
                                                                Micronesia Federated States of
                                                            </option>
                                                            <option value="Moldova Republic of">
                                                                Moldova Republic of
                                                            </option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Montserrat">Montserrat</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar">Myanmar</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="Netherlands Antilles">
                                                                Netherlands Antilles
                                                            </option>
                                                            <option value="New Caledonia">New Caledonia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="Niue">Niue</option>
                                                            <option value="Norfolk Island">Norfolk Island</option>
                                                            <option value="Northern Mariana Islands">
                                                                Northern Mariana Islands
                                                            </option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Palestinian Territory Occupied">
                                                                Palestinian Territory Occupied
                                                            </option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Pitcairn">Pitcairn</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Puerto Rico">Puerto Rico</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Reunion">Reunion</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russian Federation">
                                                                Russian Federation
                                                            </option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Helena">Saint Helena</option>
                                                            <option value="Saint Kitts and Nevis">
                                                                Saint Kitts and Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Pierre and Miquelon">
                                                                Saint Pierre and Miquelon
                                                            </option>
                                                            <option value="Saint Vincent and The Grenadines">
                                                                Saint Vincent and The Grenadines
                                                            </option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">
                                                                Sao Tome and Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia</option>
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option
                                                                value="South Georgia and The South Sandwich Islands">
                                                                South Georgia and The South Sandwich Islands
                                                            </option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Svalbard and Jan Mayen">
                                                                Svalbard and Jan Mayen
                                                            </option>
                                                            <option value="Swaziland">Swaziland</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syrian Arab Republic">
                                                                Syrian Arab Republic
                                                            </option>
                                                            <option value="Taiwan, Province of China">
                                                                Taiwan, Province of China
                                                            </option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania, United Republic of">
                                                                Tanzania, United Republic of
                                                            </option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Timor-leste">Timor-leste</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tokelau">Tokelau</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">
                                                                Trinidad and Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Turks and Caicos Islands">
                                                                Turks and Caicos Islands
                                                            </option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">
                                                                United Arab Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="United States Minor Outlying Islands">
                                                                United States Minor Outlying Islands
                                                            </option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Viet Nam">Viet Nam</option>
                                                            <option value="Virgin Islands - British">
                                                                Virgin Islands - British
                                                            </option>
                                                            <option value="Virgin Islands - U.S.">
                                                                Virgin Islands - U.S.
                                                            </option>
                                                            <option value="Wallis and Futuna">
                                                                Wallis and Futuna
                                                            </option>
                                                            <option value="Western Sahara">Western Sahara</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                        @error('country_of_registration')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tax_number" class="col-form-label">Tax number/ID
                                                            /EIN</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="tax_number"
                                                            placeholder="Enter tax number">
                                                        @error('tax_number')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 mt-5 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                wire:model.blur="share_legal_doc"
                                                                onchange="updateCheckboxValue(this)" type="checkbox"
                                                                value="0" id="brandgAgree"
                                                                @if ($share_legal_doc) checked @endif>
                                                            <label class="form-check-label" for="brandgAgree">
                                                                I agree to share the required legal documents for the
                                                                Tax information when required by the Carriers.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="city" class="col-form-label">City</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="city" placeholder="Enter city">
                                                        @error('city')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="street_address" class="col-form-label">Street
                                                            Address</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="street_address"
                                                            placeholder="Enter street address">
                                                        @error('street_address')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="state" class="col-form-label">State</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="state" placeholder="Enter state">
                                                        @error('state')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="postal_code" class="col-form-label">Postal
                                                            code</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="postal_code"
                                                            placeholder="Enter postal code">
                                                        @error('postal_code')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row mt-4" style="float: right;">
                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light w-30">
                                                            {!! loadingStateWithText('saveBrandData', 'Update') !!}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="profile1" role="tabpanel" wire:ignore.self>
                                            <form wire:submit.prevent='saveCampaignData'>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="campaign_name" class="col-form-label">Campaign
                                                            name</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="campaign_name"
                                                            placeholder="Enter campaign name">
                                                        @error('campaign_name')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="campaign_type">Campaign type</label>
                                                        <select name="lang" class="form-select"
                                                            wire:model.blur='campaign_type'>
                                                            <option value="">Select</option>
                                                            <option value="Python">Python</option>
                                                            <option value="Java">Java</option>
                                                            <option value="Ruby">Ruby</option>
                                                            <option value="C/C++">C/C++</option>
                                                            <option value="C#">C#</option>
                                                            <option value="JavaScript">JavaScript</option>
                                                            <option value="PHP">PHP</option>
                                                            <option value="Swift">Swift</option>
                                                            <option value="Scala">Scala</option>
                                                            <option value="R">R</option>
                                                            <option value="Go">Go</option>
                                                            <option value="VisualBasic.NET">VisualBasic.NET</option>
                                                            <option value="Kotlin">Kotlin</option>
                                                        </select>
                                                        @error('campaign_type')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="campaign_description">Campaign description</label>
                                                        <div>
                                                            <textarea wire:model.blur="campaign_description" class="form-control" rows="3" spellcheck="false"></textarea>
                                                        </div>
                                                        @error('campaign_description')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="sample_message_one">Sample message 1</label>
                                                        <div>
                                                            <textarea wire:model.blur="sample_message_one" class="form-control" rows="3" spellcheck="false"></textarea>
                                                        </div>
                                                        @error('sample_message_one')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-2 pb-5">
                                                        <label for="sample_message_two">Sample message 2</label>
                                                        <div>
                                                            <textarea wire:model.blur="sample_message_two" class="form-control" rows="3" spellcheck="false"></textarea>
                                                        </div>
                                                        @error('sample_message_two')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <h6 style="color: #111;">Campaign and Content Attributes</h6>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberOpt"
                                                                wire:model.live="opt_in" onchange="optInValue(this)"
                                                                @if ($opt_in) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberOpt">Subscriber Opt-in</label>
                                                        </div>
                                                        @error('opt_in')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberOptOut"
                                                                wire:model.live="opt_out" onchange="optInValue(this)"
                                                                @if ($opt_out) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberOptOut">Subscriber Opt-out</label>
                                                        </div>
                                                        @error('opt_out')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberDirect"
                                                                wire:model.live="direct_lending"
                                                                onchange="optInValue(this)"
                                                                @if ($direct_lending) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberDirect">Direct Lending or Loan
                                                                Arrangement</label>
                                                        </div>
                                                        @error('direct_lending')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberEmbedded"
                                                                wire:model.live="embedded_link"
                                                                onchange="optInValue(this)"
                                                                @if ($embedded_link) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberEmbedded">Embedded Link</label>
                                                        </div>
                                                        @error('embedded_link')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberEmbeddedPhone"
                                                                wire:model.live="embedded_phone"
                                                                onchange="optInValue(this)"
                                                                @if ($embedded_phone) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberEmbeddedPhone">Embedded Phone
                                                                Number</label>
                                                        </div>
                                                        @error('embedded_phone')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberAffiliate"
                                                                wire:model.live="affiliate_marketing"
                                                                onchange="optInValue(this)"
                                                                @if ($affiliate_marketing) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberAffiliate">Affiliate Marketing</label>
                                                        </div>
                                                        @error('affiliate_marketing')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check form-switch form-switch-md mb-3"
                                                            dir="ltr">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" id="SubscriberAge"
                                                                wire:model.live="age_gated_content"
                                                                onchange="optInValue(this)"
                                                                @if ($age_gated_content) checked @endif>
                                                            <label class="form-check-label"
                                                                for="SubscriberAge">Age-gated Content</label>
                                                        </div>
                                                        @error('age_gated_content')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="additional_recipients"
                                                            class="col-form-label">Campaign
                                                            name</label>
                                                        <input class="form-control" type="text"
                                                            wire:model.blur="additional_recipients"
                                                            placeholder="Comma-seperated list of email address name @campany.com,name@personal.com">
                                                        @error('additional_recipients')
                                                            <p class="text-danger" style="font-size: 11.5px;">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mt-3 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                wire:model.blur="terms_aggre"
                                                                onchange="updateCheckboxValue(this)" type="checkbox"
                                                                value="0" id="brandgAgrees"
                                                                @if ($terms_aggre) checked @endif>
                                                            <label class="form-check-label" for="brandgAgrees">
                                                                I agree to share the required legal documents for the
                                                                Tax information when required by the Carriers.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row mt-4" style="float: right;">
                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light w-30">
                                                            {!! loadingStateWithText('saveCampaignData', 'Update') !!}
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
        </div>
    </div>
    <!-- End 10 DLC Data Modal -->

    <!-- Change Passsword Data Modal -->
    <div wire:ignore.self class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
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
                                        <h3 class="mb-3">Change Passsword</h3>
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
                                    <form wire:submit.prevent='changePassword'>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="password" class="col-form-label">Password</label>
                                                <input class="form-control" type="password"
                                                    wire:model.blur="password" placeholder="Enter password">
                                                @error('password')
                                                    <p class="text-danger" style="font-size: 11.5px;">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row mt-4" style="float: right;">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-30">
                                                    {!! loadingStateWithText('changePassword', 'Update Password') !!}
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
    <!-- End Change Passsword Data Modal -->

    <!-- Credit Update Data Modal -->
    <div wire:ignore.self class="modal fade" id="creditChangeModal" tabindex="-1" role="dialog"
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
                                        <h3 class="mb-3">Credit Update</h3>
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
                                    <form wire:submit.prevent='creditsUpdateData'>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="credits" class="col-form-label">Credits</label>
                                                <input class="form-control" type="text"
                                                    wire:model.blur="credits" placeholder="Enter credits">
                                                @error('credits')
                                                    <p class="text-danger" style="font-size: 11.5px;">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row mt-4" style="float: right;">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-30">
                                                    {!! loadingStateWithText('creditsUpdateData', 'Update Credit') !!}
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
    <!-- End Credit Update Data Modal -->

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

        window.addEventListener('showPasswordEditModal', event => {
            $('#changePasswordModal').modal('show');
        });

        window.addEventListener('showCreditsEditModal', event => {
            $('#creditChangeModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
            $('#editAPIDataModal').modal('hide');
            $('#statusModal').modal('hide');
            $('#changePasswordModal').modal('hide');
            $('#creditChangeModal').modal('hide');
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

    <script>
        function optInValue(checkbox) {
            checkbox.value = checkbox.checked ? '1' : '0';
            Livewire.emit('input', checkbox.name, checkbox.value);
        }
    </script>
@endpush
