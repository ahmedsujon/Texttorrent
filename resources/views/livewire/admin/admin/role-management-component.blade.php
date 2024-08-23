@section('page_title')
    Products
@endsection
<div>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Roles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white" style="border-bottom: 1px solid #e2e2e7;">
                            <h4 class="card-title" style="float: left;">All Roles</h4>
                            <button class="btn btn-sm btn-dark waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#addDataModal" style="float: right;"><i class="bx bx-plus"></i> Add New Role</button>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                    <label class="font-weight-normal" style="">Show</label>
                                    <select name="sortuserresults" class="sinput" id=""
                                        wire:model="sortingValue" wire:change='resetPage'>
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
                                    <input type="search" class="sinput" placeholder="Search..." wire:model.live="searchTerm"
                                        wire:keyup='resetPage' />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" style="width: 70%;">Role</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($roles->count() > 0)
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td class="align-middle">{{ $role->role }}</td>
                                                    <td class="align-middle text-center">
                                                        @if ($role->id == 1)
                                                            <button class="btn btn-sm btn-soft-primary waves-effect waves-light action-btn" disabled>
                                                                <i class="mdi mdi-square-edit-outline font-size-13 align-middle"></i>
                                                            </button>

                                                            <button class="btn btn-sm btn-soft-danger waves-effect waves-light action-btn" disabled>
                                                                <i class="bx bx-trash font-size-13 align-middle"></i>
                                                            </button>
                                                        @else
                                                            <button
                                                                class="btn btn-sm btn-soft-primary waves-effect waves-light action-btn edit_btn"
                                                                wire:click.prevent='editData({{ $role->id }})'
                                                                wire:loading.attr='disabled'>
                                                                <i
                                                                    class="mdi mdi-square-edit-outline font-size-13 align-middle"></i>
                                                            </button>

                                                            <button
                                                                class="btn btn-sm btn-soft-danger waves-effect waves-light action-btn delete_btn"
                                                                wire:click.prevent='deleteConfirmation({{ $role->id }})'
                                                                wire:loading.attr='disabled'>
                                                                <i class="bx bx-trash font-size-13 align-middle"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center pt-5 pb-5">No data found!</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            {{ $roles->links('livewire.admin-pagination') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Data Modal -->
            <div wire:ignore.self class="modal fade" id="addDataModal" tabindex="-1" role="dialog"
                data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: white;">
                            <h5 class="modal-title m-0" id="mySmallModalLabel">Add Role Permissions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close" wire:click.prevent='close'></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <form wire:submit.prevent='storeData'>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="name" class="col-form-label">Role Name</label>
                                                <input class="form-control" id="name" type="text" wire:model.blur="name"
                                                    placeholder="Enter role name" autocomplete="off">
                                                @error('name')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="row mt-2">
                                                <label for="">Permissions</label>
                                            </div>

                                            <div class="col-md-12 mb-2" style="user-select: none;">
                                                @foreach ($permissions as $permission)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            {{ $permission['base'] }}
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach ($permission['perms'] as $perm)
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox" class="form-check-input" wire:model.live='role_perms' value="{{ $perm->id }}">
                                                                                {{ $perm->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12 text-center mb-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-50">
                                                    {!! loadingStateWithText('storeData', 'Add Role') !!}
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

            <!-- Edit Data Modal -->
            <div wire:ignore.self class="modal fade" id="editDataModal" tabindex="-1" role="dialog"
                data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: white;">
                            <h5 class="modal-title m-0" id="mySmallModalLabel">Edit Role Permissions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close" wire:click.prevent='close'></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <form wire:submit.prevent='updateData'>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="name" class="col-form-label">Role Name</label>
                                                <input class="form-control" id="name" type="text" wire:model.blur="name"
                                                    placeholder="Enter role name" autocomplete="off">
                                                @error('name')
                                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="row mt-2">
                                                <label for="">Permissions</label>
                                            </div>

                                            <div class="col-md-12 mb-2" style="user-select: none;">
                                                @foreach ($permissions as $permission)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            {{ $permission['base'] }}
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach ($permission['perms'] as $perm)
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox" class="form-check-input" wire:model.live='role_perms' value="{{ $perm->id }}">
                                                                                {{ $perm->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12 text-center mb-3 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-50">
                                                    {!! loadingStateWithText('updateData', 'Update Role') !!}
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

        </div>
    </div>

</div>
@push('scripts')
    <script>
        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
        });

        window.addEventListener('showEditModal', event => {
            $('#editDataModal').modal('show');
        });

        window.addEventListener('data_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The role has been deleted.",
                "success"
            );
        });
    </script>
@endpush
