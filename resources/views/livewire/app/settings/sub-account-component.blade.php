<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/sub-account.svg') }}" alt="sub account icon" class="user_icon" />
                    <h2>Sub Accounts</h2>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" wire:model.live='searchTerm' placeholder="Search" class="input_field" />
                        <button type="button" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>

                    <button type="button" class="create_template_btn sub_account_btn" data-bs-toggle="modal" data-bs-target="#newSubAccountModal">
                        <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus icon" />
                        <span>Add Sub Account</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @include(
                                    'livewire.app.datatable.app-datatable-th-sorting',
                                    [
                                        'id' => 'username',
                                        'thDisplayName' => 'Username',
                                    ]
                                )
                                @include(
                                    'livewire.app.datatable.app-datatable-th-sorting',
                                    [
                                        'id' => 'first_name',
                                        'thDisplayName' => 'First Name',
                                    ]
                                )
                                @include(
                                    'livewire.app.datatable.app-datatable-th-sorting',
                                    [
                                        'id' => 'last_name',
                                        'thDisplayName' => 'Last Name',
                                    ]
                                )
                                @include(
                                    'livewire.app.datatable.app-datatable-th-sorting',
                                    [
                                        'id' => 'email',
                                        'thDisplayName' => 'Email',
                                    ]
                                )
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subAccounts->count() > 0)
                                @foreach ($subAccounts as $sAccount)
                                <tr>
                                    <td>
                                        <div class="user_grid">
                                            <div class="img"><span>{{ Str::limit($sAccount->first_name,1,'') }}</span></div>
                                            <h4>{{ $sAccount->username }}</h4>
                                        </div>
                                    </td>
                                    <td>
                                        <h4 class="group_name">{{ $sAccount->first_name }}</h4>
                                    </td>
                                    <td>
                                        <h4 class="group_name">{{ $sAccount->last_name }}</h4>
                                    </td>
                                    <td>
                                        <h5 class="send_time">{{ $sAccount->email }}</h5>
                                    </td>
                                    <td>
                                        <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                            <button type="button" class="table_edit_btn" wire:click.prevent='editData({{ $sAccount->id }})'>
                                                <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                                <span>Edit</span>
                                            </button>
                                            <div class="dropdown">
                                                <button class="table_dot_btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}" alt="dot icon" />
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><h4>Select</h4></li>
                                                    <li>
                                                        <button type="button" class="dropdown-item d-block">
                                                            <span>Active User</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item d-block">
                                                            <span>Inactive User</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}" alt="delete icon" />
                                                            <span>Delete User</span>
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
                                    <td colspan="5" class="pt-5 text-center"><small>No data found!</small></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination_area">
                <div class="d-flex" wire:ignore>
                    <select class="niceSelect sortingValue">
                        <option value="10">10 Accounts</option>
                        <option value="30">30 Accounts</option>
                        <option value="50">50 Accounts</option>
                        <option value="100">100 Accounts</option>
                    </select>
                </div>
                {{ $subAccounts->links('livewire.app-pagination') }}
            </div>
        </section>

        <!-- New Sub Account Modal  -->
        <div wire:ignore.self class="modal fade common_modal sub_account_modal" id="newSubAccountModal" tabindex="-1" aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">Create Sub Account</h1>
                        <button type="button" wire:click.prevent='resetForm' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="event_form_area">
                            <div class="input_row">
                                <h3>Account Info</h3>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">User Name</label>
                                    <input type="text" placeholder="Type User Name" wire:model.blur='username' class="input_field" autocomplete="off" />
                                    @error('username')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type User Name" wire:model.blur='email' class="input_field" autocomplete="off" />
                                    @error('email')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="Type First Name" wire:model.blur='first_name' class="input_field" />
                                    @error('first_name')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Last Name</label>
                                    <input type="text" placeholder="Type Last Name" wire:model.blur='last_name' class="input_field" />
                                    @error('last_name')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Type Password" wire:model.blur='password' class="input_field password_input_filed" id="password_input1" />
                                    <div class="eye_icon_area" id="password_eye_icon_area1">
                                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose1">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Type Confirm Password" wire:model.blur='confirm_password' class="input_field password_input_filed" id="password_input2" />
                                    <div class="eye_icon_area" id="password_eye_icon_area2">
                                        <button type="button" class="eye_open_btn" id="eyeOpen2">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose2">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('confirm_password')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="permission_area">
                                <h3>Permissions</h3>
                                <div class="permission_grid">
                                    <div>
                                        @foreach ($lPermissions as $lPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $lPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $lPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>


                                    <div>
                                        @foreach ($mPermissions as $mPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $mPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $mPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div>
                                        @foreach ($rPermissions as $rPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $rPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $rPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" wire:click.prevent='storeData' class="create_event_btn">
                            {!! loadingStateWithText('storeData', 'Save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Sub Account Modal  -->
        <div wire:ignore.self class="modal fade common_modal sub_account_modal" id="editSubAccountModal" tabindex="-1" aria-labelledby="editEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventModal">Edit Sub Account</h1>
                        <button type="button" wire:click.prevent='resetForm' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="event_form_area">
                            <div class="input_row">
                                <h3>Account Info</h3>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">User Name</label>
                                    <input type="text" placeholder="Type User Name" wire:model.blur='username' class="input_field" autocomplete="off" />
                                    @error('username')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type User Name" wire:model.blur='email' class="input_field" autocomplete="off" />
                                    @error('email')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First Name</label>
                                    <input type="text" placeholder="Type First Name" wire:model.blur='first_name' class="input_field" />
                                    @error('first_name')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Last Name</label>
                                    <input type="text" placeholder="Type Last Name" wire:model.blur='last_name' class="input_field" />
                                    @error('last_name')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Type Password" wire:model.blur='password' class="input_field password_input_filed" id="password_input1" />
                                    <div class="eye_icon_area" id="password_eye_icon_area1">
                                        <button type="button" class="eye_open_btn" id="eyeOpen1">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose1">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Type Confirm Password" wire:model.blur='confirm_password' class="input_field password_input_filed" id="password_input2" />
                                    <div class="eye_icon_area" id="password_eye_icon_area2">
                                        <button type="button" class="eye_open_btn" id="eyeOpen2">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button type="button" class="eye_close_btn" id="eyeClose2">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('confirm_password')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="permission_area">
                                <h3>Permissions</h3>
                                <div class="permission_grid">
                                    <div>
                                        @foreach ($lPermissions as $lPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $lPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $lPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>


                                    <div>
                                        @foreach ($mPermissions as $mPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $mPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $mPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div>
                                        @foreach ($rPermissions as $rPerm)
                                            <div class="custom_switch_area">
                                                <label class="switch">
                                                    <input type="checkbox" wire:model.live='permissions' value="{{ $rPerm->id }}" />
                                                    <span class="slider round"></span>
                                                </label>
                                                <h3 class="switch_title">{{ $rPerm->name }}</h3>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" wire:click.prevent='updateData' class="create_event_btn">
                            {!! loadingStateWithText('updateData', 'Save') !!}
                        </button>
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
        });
    </script>
    <script>
        window.addEventListener('showEditModal', event => {
            $('#editSubAccountModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#newSubAccountModal').modal('hide');
            $('#editSubAccountModal').modal('hide');
        });

        window.addEventListener('admin_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "The sub-user has been deleted.",
                "success"
            );
        });
    </script>
@endpush
