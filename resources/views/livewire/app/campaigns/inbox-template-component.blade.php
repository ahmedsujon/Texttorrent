<div>
    <main class="main_content_wrapper">
        <!-- Inbox Template Section  -->
        <section class="inbox_template_wrapper">
            <div class="template_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Inbox Template</h2>
                </div>
                <button type="button" class="create_template_btn" data-bs-toggle="modal"
                    data-bs-target="#createTemplateModal">
                    <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus white" />
                    <span>Create template</span>
                </button>
            </div>
            <div class="template_filter_area d-flex-between">
                <form action="" class="search_input_form">
                    <input type="search" placeholder="Search folder" class="input_field" wire:model.blur="searchTerm"
                        wire:keyup='resetPage' />
                    <button type="button" class="search_icon">
                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                    </button>
                </form>
                <div class="filter_btn_area d-flex align-items-center justify-content-end flex-wrap g-xs">
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="column insert" />
                        <span>Export</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'template_name',
                                    'thDisplayName' => 'Name',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'preview_message',
                                    'thDisplayName' => 'Message',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'created_at',
                                    'thDisplayName' => 'Created',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'status',
                                    'thDisplayName' => 'Status',
                                ])
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($templates->count() > 0)
                                @php
                                    $sl =
                                        $templates->perPage() * $templates->currentPage() - ($templates->perPage() - 1);
                                @endphp
                                @foreach ($templates as $template)
                                    <tr>
                                        <td>
                                            <div class="checkbox_name_cell_area">
                                                <div class="form-check table_checkbox_area">
                                                    <input class="form-check-input" type="checkbox" value="" />
                                                </div>
                                                <p>{{ $template->template_name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{ $template->preview_message }}</p>
                                        </td>
                                        <td>
                                            <p>{{ \Carbon\Carbon::parse($template->created_at)->format('F j, g:i A') }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($template->status == 1)
                                                <div class="d-flex">
                                                    <div class="status">Active</div>
                                                </div>
                                            @else
                                                <div class="d-flex">
                                                    <div class="status inactive">Inactive</div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                                <button type="button" class="table_edit_btn"
                                                    wire:click.prevent='editData({{ $template->id }})'
                                                    wire:loading.attr='disabled'>
                                                    <img src="{{ asset('assets/app/icons/edit-03.svg') }}"
                                                        alt="edit icon" />
                                                    <span>Edit</span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="table_dot_btn dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                            alt="dot icon" />
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <h4>Select</h4>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item">
                                                                <img src="{{ asset('assets/app/icons/copy-02.svg') }}"
                                                                    alt="copy icon" />
                                                                <span>Copy template</span>
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item">
                                                                <img src="{{ asset('assets/app/icons/delete-01.svg') }}"
                                                                    alt="delete icon" />
                                                                <span>Delete template</span>
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
                                    <td colspan="5" class="text-center pt-5 pb-5">No data available!</td>
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
                {{ $templates->links('livewire.app-pagination') }}
            </div>
        </section>

        <!-- New Template Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="createTemplateModal" tabindex="-1"
            aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModal">
                            Create SMS template
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent='storeData' class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="template_name">Template name</label>
                                    <input type="text" wire:model.blur='template_name' placeholder="Name"
                                        class="input_field" />
                                    @error('template_name')
                                        <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row" id="statusRow">
                                    <div wire:ignore>
                                        <label for="status">Status</label>
                                        <select class="niceSelect w-100 statusSelect">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Preview</label>
                                <div class="textarea_header_top" wire:ignore>
                                    <div class="textarea_header">
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="merge_btn dropdown-toggle hide_dropdown_arrow"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span>Import merge field</span>
                                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                                        alt="down arrow" />
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[phone_number]">
                                                            <span>Phone Number</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[email_address]">
                                                            <span>Email Address</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[first_name]">
                                                            <span>First Name</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[last_name]">
                                                            <span>Last Name</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[company]">
                                                            <span>Company</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea name="" id="template_preview" rows="6" class="input_field textarea_field"
                                        placeholder="Write a template..." value=""></textarea>
                                </div>
                                @error('preview_message')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="modal-footer event_modal_footer">
                                <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="create_event_btn">
                                    {!! loadingStateWithText('storeData', 'Save') !!}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Template Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="editTemplateModal" tabindex="-1"
            aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModal">Edit SMS template</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent='updateData' class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="template_name">Template name</label>
                                    <input type="text" wire:model.blur='template_name' placeholder="Name"
                                        class="input_field" />
                                    @error('template_name')
                                        <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row" id="statusRow">
                                    <label for="status">Status</label>
                                    <select class="niceSelect niceSelect_status_area" wire:model.blur='status'
                                        id="statusSelect">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Preview</label>
                                <div class="textarea_header_top" wire:ignore>
                                    <div class="textarea_header">
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="merge_btn dropdown-toggle hide_dropdown_arrow"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span>Import merge field</span>
                                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                                        alt="down arrow" />
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[phone_number]">
                                                            <span>Phone Number</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[email_address]">
                                                            <span>Email Address</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[first_name]">
                                                            <span>First Name</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[last_name]">
                                                            <span>Last Name</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                            data-variable="[company]">
                                                            <span>Company</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea name="" id="template_preview" rows="6" class="input_field textarea_field"
                                        placeholder="Write a template..." value=""></textarea>
                                </div>
                                @error('preview_message')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn"
                            data-bs-dismiss="modal">Cancel</button>
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
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });

            $('#template_preview').on('change', function() {
                var template = $(this).val();

                @this.set('preview_message', template);
            });

            $('.statusSelect').on('change', function() {
                var status = $(this).val();
                @this.set('status', status);
            });
        });
    </script>

    <script>
        // Get all buttons with the class 'dropdown-item'
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        // Add a click event listener to each button
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                // Get the data-variable attribute value (e.g., [phone_number])
                let variable = this.getAttribute('data-variable');

                // Append the selected variable to the textarea
                let textarea = document.getElementById('template_preview');
                textarea.value += variable + " ";

                @this.set('preview_message', textarea.value);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            //Text Editor for new
            var MergeButton = function(context) {
                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<span>Import merge field</span> <img src="{{ asset('assets/app/icons/arrow-down.png') }}" alt="down arrow">',
                    className: "merge_btn",
                    click: function() {
                        $("#editorDropdownArea").fadeToggle();
                    },
                });

                return button.render(); // return button as jquery object
            };

            $("#summernote").summernote({
                placeholder: "Write a template...",
                height: 170,
                toolbar: [
                    ["style", ["bold", "italic", "underline"]],
                    ["mybutton", ["hello"]],
                ],
                buttons: {
                    hello: MergeButton,
                },
            });

            //Hide Dropdown on click the mehu
            $("#editorDropdownArea .dropdown-item").click(function(e) {
                e.preventDefault();
                $("#editorDropdownArea").fadeOut();
            });

            //Text Editor for edit
            var MergeEditButton = function(context) {
                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<span>Import merge field</span> <img src="{{ asset('assets/app/icons/arrow-down.png') }}" alt="down arrow">',
                    className: "merge_btn",
                    click: function() {
                        $("#editorEditDropdownArea").fadeToggle();
                    },
                });

                return button.render(); // return button as jquery object
            };

            $("#editTempalte").summernote({
                placeholder: "Write a template...",
                height: 170,
                toolbar: [
                    ["style", ["bold", "italic", "underline"]],
                    ["mybutton", ["hello"]],
                ],
                buttons: {
                    hello: MergeEditButton,
                },
            });

            //Hide Dropdown on click the mehu
            $("#editorEditDropdownArea .dropdown-item").click(function(e) {
                e.preventDefault();
                $("#editorEditDropdownArea").fadeOut();
            });
        });
        window.addEventListener('showEditModal', event => {
            $('#editTemplateModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#createTemplateModal').modal('hide');
            $('#editTemplateModal').modal('hide');
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
