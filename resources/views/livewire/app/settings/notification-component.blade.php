<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- Sub Account Section  -->
        <section class="sub_account_wrapper account_border">
            <div class="account_title_area account_title_grid">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/notification.svg') }}" alt="notification icon"
                        class="user_icon" />
                    <h2>Trigger Notification</h2>
                </div>
                <div class="account_right_area d-flex align-items-center justify-content-end flex-wrap">
                    <form action="" class="search_input_form search_input_form_sm">
                        <input type="search" placeholder="Search" class="input_field" />
                        <button type="submit" class="search_icon">
                            <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                        </button>
                    </form>

                    <button type="button" class="create_template_btn sub_account_btn" data-bs-toggle="modal"
                        data-bs-target="#triggerNotificationModal">
                        <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus icon" />
                        <span>Add Trigger</span>
                    </button>
                </div>
            </div>
            <div class="inbox_template_table_area">
                <div class="table-responsive no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'keyword',
                                    'thDisplayName' => 'Keyword',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'type',
                                    'thDisplayName' => 'Type',
                                ])
                                @include('livewire.app.datatable.app-datatable-th-sorting', [
                                    'id' => 'created_at',
                                    'thDisplayName' => 'Created',
                                ])
                                <th scope="col">
                                    <div class="column_area">
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($trigger_notifications->count() > 0)
                                @foreach ($trigger_notifications as $notifications)
                                    <tr>
                                        <td>
                                            <div class="customer_area d-flex">
                                                <h4 class="customer_name">{{ $notifications->keyword }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <h4 class="group_name">{{ $notifications->type }}</h4>
                                        </td>
                                        <td>
                                            <h4 class="group_name">
                                                {{ $notifications->created_at->format('F j, g:i A') }}</h4>
                                        </td>
                                        <td>
                                            <div class="table_dropdown_area d-flex align-items-center flex-wrap gap-1">
                                                <button type="button" class="table_edit_btn"
                                                    wire:click.prevent='editData({{ $notifications->id }})'
                                                    wire:loading.attr='disabled'>
                                                    <img src="{{ asset('assets/app/icons/edit-03.svg') }}"
                                                        alt="edit icon" />
                                                    <span>Edit</span>
                                                </button>

                                                <button type="button" class="table_delete_btn"
                                                    wire:click.prevent='deleteConfirmation({{ $notifications->id }})'
                                                    wire:loading.attr='disabled'>
                                                    <img src="{{ asset('assets/app/icons/delete-04.svg') }}"
                                                        alt="delete icon" />
                                                </button>
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
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                {{ $trigger_notifications->links('livewire.app-pagination') }}
            </div>
        </section>

        <!-- New Notification Trigger Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="triggerNotificationModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">Add Trigger</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="warning_area" wire:ignore>
                            <p>
                                <span>IMPORTANT:</span>  Enter your mobile number with country
                                code (US Example: 12025248725)
                            </p>
                            <div class="warning_btn_area d-flex align-items-center flex-wrap">
                                <button type="button" class="ok_btn">
                                    <span>Ok got it!</span>
                                </button>
                                <button type="button" class="learn_more_btn">
                                    Learn more
                                </button>
                            </div>
                        </div>
                        <form wire:submit.prevent='storeData' class="event_form_area mt-24">
                            <div class="input_row">
                                <label for="keyword">Keyword</label>
                                <input type="text" wire:model.blur='keyword' placeholder="Type Keyword"
                                    class="input_field" />
                                @error('keyword')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div wire:ignore>
                                    <label for="type">Type</label>
                                    <select name="lang" class="js-searchBox searchBox_type">
                                        <option value="">Select</option>
                                        <option value="Email">Email</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Webhook">Webhook</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('type')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="email">Email</label>
                                <input type="email" wire:model.blur='email' placeholder="Type Email"
                                    class="input_field" />
                                @error('email')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="phone">Phone</label>
                                <input type="number" wire:model.blur='phone' placeholder="Type Phone"
                                    class="input_field" />
                                @error('phone')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="webhook_url">Webhook URL</label>
                                <input type="url" wire:model.blur='webhook_url' placeholder="Webhook URL"
                                    class="input_field" />
                                @error('webhook_url')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div wire:ignore>
                                    <label for="webhook_format">Webhook Format</label>
                                    <select name="lang" class="js-searchBox webhook_format">
                                        <option value="">Select</option>
                                        <option value="Json">Json</option>
                                        <option value="Urlencoded">Urlencoded</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('webhook_format')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='auto_responder'
                                            type="checkbox" value="" id="fromPhone" />
                                        <label class="form-check-label mb-0" for="fromPhone">
                                            Send Auto Responder?
                                        </label>
                                        @error('auto_responder')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="auto_responder_message">Auto Responder Message</label>
                                <textarea wire:model.blur='auto_responder_message' name="" id="" rows="4"
                                    placeholder="Type between 0-160 characters." class="input_field"></textarea>
                                <h5>0/ 160 Characters</h5>
                                @error('auto_responder_message')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" wire:click.prevent='storeData' class="create_event_btn">
                            {!! loadingStateWithText('storeData', 'Save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Notification Trigger Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="editNotificationModal" tabindex="-1"
            aria-labelledby="editEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editEventModal">Edit Trigger</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="warning_area">
                            <p>
                                <span>IMPORTANT:</span>  Enter your mobile number with country
                                code (US Example: 12025248725)
                            </p>
                            <div class="warning_btn_area d-flex align-items-center flex-wrap">
                                <button type="button" class="ok_btn">
                                    <span>Ok got it!</span>
                                </button>
                                <button type="button" class="learn_more_btn">
                                    Learn more
                                </button>
                            </div>
                        </div>
                        <form wire:submit.prevent='updateData' class="event_form_area mt-24">
                            <div class="input_row">
                                <label for="keyword">Keyword</label>
                                <input type="text" wire:model.blur='keyword' placeholder="Type Keyword"
                                    class="input_field" />
                                @error('keyword')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div wire:ignore>
                                    <label for="type">Type</label>
                                    <select name="lang" wire:model.live='type'
                                        class="js-searchBox edit_searchBox_type">
                                        <option value="">Select</option>
                                        <option value="Email">Email</option>
                                        <option value="Phone">Phone</option>
                                        <option value="Webhook">Webhook</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('type')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="email">Email</label>
                                <input type="email" wire:model.blur='email' placeholder="Type Email"
                                    class="input_field" />
                                @error('email')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="phone">Phone</label>
                                <input type="number" wire:model.blur='phone' placeholder="Type Phone"
                                    class="input_field" />
                                @error('phone')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="webhook_url">Webhook URL</label>
                                <input type="url" wire:model.blur='webhook_url' placeholder="Webhook URL"
                                    class="input_field" />
                                @error('webhook_url')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row searchable_select">
                                <div wire:ignore>
                                    <label for="webhook_format">Webhook Format</label>
                                    <select name="lang" wire:model.live='webhook_format'
                                        class="js-searchBox edit_webhook_format">
                                        <option value="">Select</option>
                                        <option value="Json">Json</option>
                                        <option value="Urlencoded">Urlencoded</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                @error('webhook_format')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0 pt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fromPhone1" value="1" @if($auto_responder == 1) checked @endif>
                                        <label class="form-check-label mb-0" for="fromPhone1">
                                            Send Auto Responder?
                                        </label>
                                        @error('auto_responder')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="input_row">
                                <label for="auto_responder_message">Auto Responder Message</label>
                                <textarea wire:model.blur='auto_responder_message' name="" id="" rows="4"
                                    placeholder="Type between 0-160 characters." class="input_field"></textarea>
                                <h5>0/ 160 Characters</h5>
                                @error('auto_responder_message')
                                    <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" wire:click.prevent='resetForm' class="cancel_btn"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" wire:click.prevent='updateData' class="create_event_btn">
                            {!! loadingStateWithText('updateData', 'Update') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="deleteDataModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to permanently delete this event?</h2>
                            <h4>Once deleted, this event will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn" wire:click.prevent='resetForm'>
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='deleteData' wire:loading.attr='disabled' class="delete_yes_btn">
                                    {!! loadingStateWithText('deleteData', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
    <script>
        $(".searchBox_type").on('change', function() {
            @this.set('type', $(this).val());
        });
        $(".webhook_format").on('change', function() {
            @this.set('webhook_format', $(this).val());
        });
    </script>

    <script>
        $(".edit_searchBox_type").on('change', function() {
            @this.set('type', $(this).val());
        });
        $(".edit_webhook_format").on('change', function() {
            @this.set('webhook_format', $(this).val());
        });

        $('#fromPhone1').change(function() {
            if ($(this).is(':checked')) {
                @this.set('auto_responder', 1);
            } else {
                @this.set('auto_responder', 0);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.sortingValue').on('change', function() {
                @this.set('sortingValue', this.value);
            });
        });
    </script>

    <script>
        window.addEventListener('showEditModal', event => {
            $('#editNotificationModal').modal('show');
            setTimeout(() => {
                $('.modal-body').click();
            }, 100);
        });
        window.addEventListener('closeModal', event => {
            $('#triggerNotificationModal').modal('hide');
            $('#editNotificationModal').modal('hide');
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
