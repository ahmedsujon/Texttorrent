@section('page_title') TextTorrent | Manage Contacts @endsection
<div>
    <main class="main_content_wrapper">
        <!-- Manage Contact Section  -->
        <section class="manage_contact_wrapper">
            <div class="contact_header_area d-flex-between">
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <h2 class="inbox_template_title">Manage Contacts</h2>
                </div>
                @if (isUserPermitted('import-contacts'))
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <a href="{{ asset('files/Sample Contact File.csv') }}" download type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                        <span>Download sample import file</span>
                    </a>
                    <button type="button" class="import_btn" data-bs-toggle="modal" data-bs-target="#importModal">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                        <span>Import contacts</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="contact_grid">
                <div class="contact_list_wrapper" id="contactListArea">
                    <div class="list_header_area">
                        <div class="d-flex-between">
                            <h4>Contact Lists</h4>
                            <div class="d-flex align-items-center justify-content-end flex-wrap g-xs">
                                <button type="button" class="create_template_btn" data-bs-toggle="modal"
                                    data-bs-target="#newListModal">
                                    <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus icon" />
                                    <span>Add list</span>
                                </button>
                            </div>
                        </div>
                        <form onsubmit="event.preventDefault()" class="search_input_form">
                            <input type="search" placeholder="Search..." wire:model.live='list_search_term'
                                class="input_field" />
                            <button type="submit" class="search_icon">
                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                            </button>
                        </form>
                    </div>
                    <div class="list_area">
                        <ul>
                            <li>
                                <h4>Bookmark</h4>
                            </li>
                            @if ($bookmarked_lists->count() > 0)
                            @foreach ($bookmarked_lists as $bList)
                            <li>
                                <a href="#" wire:click.prevent='selectList({{ $bList->id }})'
                                    class="list_btn {{ $sort_list_id == $bList->id ? 'active_list_btn' : '' }}">
                                    <span class="list_title">{{ $bList->name }}</span>
                                    <div
                                        class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                        <div class="user_number_area d-flex align-items-center">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                            <span>{{ listContactsCount($bList->id) }}</span>
                                        </div>
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button class="dot_icon" type="button"
                                                    onclick="event.stopPropagation();" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                        alt="dot icon" />
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <h5>Select</h5>
                                                    </li>

                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='addRemoveBookmark({{ $bList->id }})'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/bookmark-minus-02.svg') }}"
                                                                alt="bookmark icon" />
                                                            <span>Remove from bookmark</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='editList({{ $bList->id }})'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/edit-04.svg') }}"
                                                                alt="edit icon" />
                                                            <span>Edit list</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='deleteConfirmation({{ $bList->id }}, "list")'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                                alt="copy icon" />
                                                            <span>Delete list</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @else
                            <li class="mt-3 text-center">
                                <small class="text-muted">No bookmarked lists found.</small>
                            </li>
                            @endif
                            <li>
                                <h4 class="mt-4">Other</h4>
                            </li>
                            @if ($other_lists->count() > 0)
                            @foreach ($other_lists as $oList)
                            <li>
                                <a href="#" wire:click.prevent='selectList({{ $oList->id }})'
                                    class="list_btn {{ $sort_list_id == $oList->id ? 'active_list_btn' : '' }}">
                                    <span class="list_title">{{ $oList->name }}</span>
                                    <div
                                        class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                        <div class="user_number_area d-flex align-items-center">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                            <span>{{ listContactsCount($oList->id) }}</span>
                                        </div>
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button class="dot_icon" type="button"
                                                    onclick="event.stopPropagation();" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                        alt="dot icon" />
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <h5>Select</h5>
                                                    </li>

                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='addRemoveBookmark({{ $oList->id }})'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/bookmark-minus-02.svg') }}"
                                                                alt="bookmark icon" />
                                                            <span>Add to Bookmark</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='editList({{ $oList->id }})'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/edit-04.svg') }}"
                                                                alt="edit icon" />
                                                            <span>Edit list</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            wire:click.prevent='deleteConfirmation({{ $oList->id }}, "list")'
                                                            class="dropdown-item">
                                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                                alt="copy icon" />
                                                            <span>Delete list</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach

                            <li>
                                <a href="#" wire:click.prevent='selectList("unlisted")'
                                    class="list_btn {{ $sort_list_id == "unlisted" ? 'active_list_btn' : '' }}">
                                    <span class="list_title">Unlisted</span>
                                    <div
                                        class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                        <div class="user_number_area d-flex align-items-center">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                            <span>{{ listContactsCount("unlisted") }}</span>
                                        </div>
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button class="dot_icon" type="button" onclick="event.stopPropagation();">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="#" wire:click.prevent='selectList("blacklisted")'
                                    class="list_btn {{ $sort_list_id == "blacklisted" ? 'active_list_btn' : '' }}">
                                    <span class="list_title">Blacklisted</span>
                                    <div
                                        class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                        <div class="user_number_area d-flex align-items-center">
                                            <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                            <span>{{ listContactsCount("blacklisted") }}</span>
                                        </div>
                                        <div class="table_dropdown_area">
                                            <div class="dropdown">
                                                <button class="dot_icon" type="button" onclick="event.stopPropagation();">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            {{-- @else
                            <li class="mt-3 text-center">
                                <small class="text-muted">No lists found.</small>
                            </li> --}}
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="contact_list_deatils_area">
                    <div class="details_header_form_area">
                        <div class="details_header_area d-flex-between">
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <button type="button" class="bar_btn" id="openContactListBtn">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                                <h4>Contact Lists</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-end flex-wrap g-xs">
                                <button type="button" class="create_template_btn" wire:click.prevent='resetEditModal' data-bs-toggle="modal"
                                    data-bs-target="#contactModal">
                                    <img src="{{ asset('assets/app/icons/plus-sign-white.svg') }}" alt="plus icon" />
                                    <span>Add contact</span>
                                </button>

                                <div class="table_dropdown_area">
                                    <div class="dropdown">
                                        <button class="icon_btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                alt="dot icon" />
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <h5>Select</h5>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    wire:click.prevent='removeBlacklistConfirmation'>
                                                    <img src="{{ asset('assets/app/icons/user-block-02.svg') }}"
                                                        alt="block user icon" />
                                                    <span>Remove blacklists</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    wire:click.prevent='exportContacts'>
                                                    <img src="{{ asset('assets/app/icons/cloud-download.svg') }}"
                                                        alt="export icon" />
                                                    <span>Export contact list</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    wire:click.prevent='deleteConfirmation("", "bulk_delete_contact")'>
                                                    <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                        alt="copy icon" />
                                                    <span>Delete all contacts</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form onsubmit="event.preventDefault()" class="search_input_form">
                            <input type="search" placeholder="Search contacts" wire:model.live='contacts_search_term'
                                class="input_field" />
                            <button type="button" class="search_icon">
                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                            </button>
                        </form>
                    </div>
                    <div class="details_table_header_area d-flex-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" wire:change='selectAll'
                                id="formCheckAll" wire:model.live="check_all" />
                            <label class="form-check-label" for="formCheckAll">
                                Select all contacts
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span wire:loading
                                    wire:target='editContact,deleteConfirmation,editList,addRemoveBookmark,list_search_term,contacts_search_term,selectList,deleteAllContacts,exportContacts,removeBlacklist'><i
                                        class="fa fa-spinner fa-spin"></i> Processing...</span>
                            </div>
                        </div>
                        @if (isUserPermitted('number-validator'))
                        <a href="#" class="import_btn">
                            <img src="{{ asset('assets/app/icons/call-disabled.svg') }}" alt="call disabled" />
                            <span>Mobile verification & DNC check </span>
                        </a>
                        @endif
                    </div>
                    <div class="details_list_area">
                        @if ($contacts->count() > 0)
                        @foreach ($contacts as $contact)
                        <div class="deatils_list_grid">
                            <div class="form-check">
                                <input class="form-check-input contact-checkbox" type="checkbox"
                                    name="contact_checkbox[]" wire:model.live='contact_checkbox'
                                    value="{{ $contact->id }}" />
                            </div>
                            <div class="user_info_area">
                                <div class="user_top_img chat-avatar">
                                    {{ Str::limit($contact->first_name, 1, '') }}{{ Str::limit($contact->last_name, 1,
                                    '') }}
                                </div>
                                <div>
                                    <h4>{{ $contact->first_name }} {{ $contact->last_name }}</h4>
                                    <div class="d-flex align-items-center flex-wrap gap-1">
                                        <h5 id="contact_number_{{ $contact->id }}">{{ $contact->number }}
                                        </h5>
                                        <button type="button" class="copy_icon"
                                            onclick="copyToClipboard({{ $contact->id }})">
                                            <img src="{{ asset('assets/app/icons/copy-01.svg') }}" alt="copy icon" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="list_action_details_area d-flex align-items-center justify-content-end flex-wrap g-sm">
                                <button type="button" class="icon_btn"
                                    wire:click.prevent='showDetails({{ $contact->id }})' wire:loading.attr='disabled'>
                                    {!! loadingStateWithoutText(
                                    'showDetails(' . $contact->id . ')',
                                    '<img src="' . asset('assets/app/icons/info-02.svg') . '" alt="message icon" />',
                                    ) !!}
                                </button>
                                <button type="button" class="icon_btn"
                                    wire:click.prevent='addNoteModal({{ $contact->id }})' wire:loading.attr='disabled'>
                                    {!! loadingStateWithoutText(
                                    'addNoteModal(' . $contact->id . ')',
                                    '<img src="' . asset('assets/app/icons/notebook.svg') . '" alt="note icon" />',
                                    ) !!}
                                </button>
                                <button type="button" class="icon_btn"
                                    wire:click.prevent='addFolderModal({{ $contact->id }})'
                                    wire:loading.attr='disabled'>
                                    {!! loadingStateWithoutText(
                                    'addFolderModal(' . $contact->id . ')',
                                    '<img src="' .
                                                    asset('assets/app/icons/folder-add-02.svg') .
                                                    '" alt="folder icon" />',
                                    ) !!}
                                </button>
                                <div class="table_dropdown_area">
                                    <div class="dropdown">
                                        <button class="icon_btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" wire:loading.attr='disabled'>

                                            <img src="{{ asset('assets/app/icons/dot-horizontal.svg') }}"
                                                alt="dot icon" />
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <h5>Select</h5>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item"
                                                    wire:click.prevent='editContact({{ $contact->id }})'>
                                                    <img src="{{ asset('assets/app/icons/edit-04.svg') }}"
                                                        alt="edit icon" />
                                                    <span>Edit contact</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    wire:click.prevent='deleteConfirmation({{ $contact->id }}, "contact")'
                                                    class="dropdown-item">
                                                    <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                        alt="copy icon" />
                                                    <span>Delete contact</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- New List Modal  -->
        <div wire:ignore.self class="modal fade common_modal news_list_modal" id="newListModal" tabindex="-1"
            aria-labelledby="newListModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <form wire:submit.prevent='addNewList' class="event_form_area">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="newListModal">Add new list</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input_row">
                                <label for="">List name</label>
                                <input type="text" placeholder="Type List Name" wire:model.blur='list_name'
                                    class="input_field" />

                                @error('list_name')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('addNewList', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit List Modal  -->
        <div wire:ignore.self class="modal fade common_modal news_list_modal" id="editListModal" tabindex="-1"
            aria-labelledby="newListModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <form wire:submit.prevent='updateList' class="event_form_area">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="newListModal">Edit list</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="input_row">
                                <label for="">List name</label>
                                <input type="text" placeholder="Type List Name" wire:model.blur='list_name'
                                    class="input_field" />

                                @error('list_name')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="create_event_btn">
                                {!! loadingStateWithText('updateList', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Import Modal  -->
        <div wire:ignore.self class="modal fade common_modal contact_import_modal" id="importModal" tabindex="-1"
            aria-labelledby="importFileModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="importFileModal">
                            Import Contact by File
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="" class="event_form_area">
                            <label for="contactUploadImage" class="d-flex file_upload_area w-100" id="fileUploadLabel">
                                <div class="import_icon">
                                    <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                                </div>
                                <h4 id="dropText"><span>Click to upload</span> or drag and drop</h4>
                                <h5>Headers are mandatory (max. limit of contacts 10,000)</h5>
                            </label>

                            <!-- File Input -->
                            <input type="file" id="contactUploadImage" accept=".csv,.xlsx" wire:model="file"
                                class="position-absolute opacity-0 visually-hidden" />

                            <!-- Error Message -->
                            @error('file')
                            <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror

                            <div wire:loading wire:target='file' wire:key='file' style="font-size: 15px;">
                                <i class="fa fa-spinner fa-spin"></i> Uploading...
                            </div>

                            @if ($file)
                            <div class="uploading_status_area mb-5">
                                <button type="button" class="close_btn" wire:click.prevent='resetUpload'>
                                    <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                </button>
                                <div class="file_name_grid">
                                    <img src="{{ asset('assets/app/icons/bi_filetype-csv.svg') }}" alt="csv" />
                                    <div>
                                        <h4>{{ $file->getClientOriginalName() }}</h4>
                                        <div class="complete_status">
                                            <div class="circle">
                                                <img src="{{ asset('assets/app/icons/tick-circle.svg') }}"
                                                    alt="track icon" />
                                            </div>
                                            <h5>Completed</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="two_grid mt-3">
                                <div class="input_row searchable_select">
                                    <label for="">First Name Column <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='first_name_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==0 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">Last Name Column
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='last_name_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==1 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">Email Address Column
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='email_address_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==2 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">Company Column <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='company_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==3 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Phone Number Column <span class="star">*</span>
                                </label>
                                <select name="lang" class="form-control" wire:model.blur='phone_number_column'>
                                    <option value="">Select Column</option>
                                    @foreach ($columns as $key => $column)
                                    <option value="{{ $column }}" {{ $key==4 ? 'selected' : '' }}>
                                        {{ $column }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>

                            <div class="row">
                                <div class="input_row searchable_select col-md-4">
                                    <label for="">Additional Data 1 Column
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='additional_1_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==5 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select col-md-4">
                                    <label for="">Additional Data 2 Column
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='additional_2_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==6 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select col-md-4">
                                    <label for="">Additional Data 3 Column
                                    </label>
                                    <select name="lang" class="form-control" wire:model.blur='additional_3_column'>
                                        <option value="">Select Column</option>
                                        @foreach ($columns as $key => $column)
                                        <option value="{{ $column }}" {{ $key==7 ? 'selected' : '' }}>
                                            {{ $column }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>

                            <div class="input_row searchable_select">
                                <label for="">Import List Into </label>
                                <select name="lang" class="form-control js-searchBox-file-select">
                                    <option value="">Select</option>
                                    @foreach ($allLists as $lItem)
                                    <option value="{{ $lItem->id }}">{{ $lItem->name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn" wire:click.prevent='importConfirmation'>
                            {!! loadingStateWithText('importConfirmation', 'Submit') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="importConfirmationModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <form wire:submit.prevent='import' >
                            <div class="content_area text-center">
                                <h5 class="mb-3">Confirm Opt-In Consent</h5>

                                <div class="text-start">
                                    <p class="text-muted mb-3">
                                        Please confirm that all the contacts you are importing have agreed to receive SMS messages
                                        from you. Ensuring your recipients have opted in helps maintain compliance and ensures a
                                        positive experience for everyone.
                                        By checking this box, you confirm that all imported contacts have provided their consent to
                                        receive messages.
                                    </p>
                                </div>

                                <input type="checkbox" id="confirm_chk" required> <label for="confirm_chk"> I confirm that all contacts have opted in.</label>
                                <div class="text-center mt-4">
                                    <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                        data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" wire:loading.attr='disabled'
                                        class="delete_yes_btn">
                                        {!! loadingStateWithText('import', 'Import Data') !!}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Contact Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="contactModal" tabindex="-1"
            aria-labelledby="newContactModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newContactModal">Add Contact</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='addNewContact' class="event_form_area">
                        <div class="modal-body">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First name *</label>
                                    <input type="text" placeholder="Type First name" wire:model.blur='first_name'
                                        class="input_field" />
                                    @error('first_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Last name</label>
                                    <input type="text" placeholder="Type Last name" wire:model.blur='last_name'
                                        class="input_field" />
                                    @error('last_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Mobile number *</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+1</span>
                                    <input id="tel-input" type="tel" class="form-control"
                                        wire:model.blur='mobile_number' placeholder="xxxxxxxxxx" maxlength="10" />
                                </div>
                                @error('mobile_number')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type email" wire:model.blur='email'
                                        class="input_field" />
                                    @error('email')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Company *</label>
                                    <input type="text" placeholder="Type Company Name" wire:model.blur='company_name'
                                        class="input_field" />
                                    @error('company_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('addNewContact', 'Submit') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Contact Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="contactEditModal" tabindex="-1"
            aria-labelledby="editContactModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editContactModal">
                            Edit contact
                        </h1>
                        <button type="button" class="btn-close" wire:click.prevent='resetEditModal' data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='updateContact' class="event_form_area">
                        <div class="modal-body">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First name *</label>
                                    <input type="text" placeholder="Type First name" wire:model.blur='first_name'
                                        class="input_field" />
                                    @error('first_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Last name</label>
                                    <input type="text" placeholder="Type Last name" wire:model.blur='last_name'
                                        class="input_field" />
                                    @error('last_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">Mobile number *</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+1</span>
                                    <input id="tel-input-edit" type="tel" class="form-control"
                                        wire:model.blur='mobile_number' placeholder="xxxxxxxxxx" maxlength="10" />
                                </div>
                                @error('mobile_number')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Type email" wire:model.blur='email'
                                        class="input_field" />
                                    @error('email')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Company *</label>
                                    <input type="text" placeholder="Type Company Name" wire:model.blur='company_name'
                                        class="input_field" />
                                    @error('company_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" wire:click.prevent='resetEditModal' data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('updateContact', 'Submit') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Details Modal  -->
        <div class="modal fade common_modal user_details_modal" id="detailsModal" tabindex="-1"
            aria-labelledby="detailsUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailsUserModal">Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($numberDetails)
                        <div class="user_details_modal_area">
                            <div class="user_info_area">
                                <div class="user_top_img chat-avatar">
                                    {{ Str::limit($numberDetails->first_name, 1, '') }}{{ Str::limit($numberDetails->last_name, 1,
                                    '') }}
                                </div>
                                <div>
                                    <h4>{{ $numberDetails->first_name ? $numberDetails->first_name : '---' }}
                                        {{ $numberDetails->last_name ? $numberDetails->last_name : '' }}</h4>
                                    <div class="d-flex align-items-center flex-wrap gap-1">

                                        <h5 id="contact_number_details_{{ $numberDetails->id }}">
                                            {{ $numberDetails->number ? $numberDetails->number : '---' }}</h5>
                                        <button type="button" class="copy_icon"
                                            onclick="copyToClipboardDetails({{ $numberDetails->id }})">
                                            <img src="{{ asset('assets/app/icons/copy-01.svg') }}" alt="copy icon" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="user_info_contact_area">
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                    </div>
                                    <div>
                                        <h4>Name</h4>
                                        <h5>{{ $numberDetails->first_name ? $numberDetails->first_name : '---' }}
                                            {{ $numberDetails->last_name ? $numberDetails->last_name : '' }}</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/building-03.svg') }}"
                                            alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Company</h4>
                                        <h5>{{ $numberDetails->company ? $numberDetails->company : '---' }}</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/contact.svg') }}" alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Contact list</h4>
                                        <h5>{{ $numberDetails->list_id &&
                                            isset(getListByID($numberDetails->list_id)->name)
                                            ? getListByID($numberDetails->list_id)->name
                                            : '---' }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/call.svg') }}" alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Phone:</h4>
                                        <h5>{{ $numberDetails->number ? $numberDetails->number : '---' }}</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/email.svg') }}" alt="email icon" />
                                    </div>
                                    <div>
                                        <h4>Email:</h4>
                                        <h5 class="word-break-all">
                                            {{ $numberDetails->email ? $numberDetails->email : '---' }}</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/location.svg') }}" alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Country</h4>
                                        <h5>USA</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/note-02.svg') }}" alt="note icon" />
                                    </div>
                                    <div>
                                        <h4>Notes</h4>
                                        @if ($numberDetails->notes)
                                        @foreach ($numberDetails->notes as $note)
                                        <p>{{ $note->note }}</p> <br>
                                        @endforeach
                                        @else
                                        <p>---</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row mt-5 mb-5">
                            <div class="col-md-12 text-center">
                                <small class="text-muted">No data found!</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- New Note Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="noteModal" tabindex="-1"
            aria-labelledby="newNoteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newContactModal">Add notes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='addNote' class="event_form_area">
                        <div class="modal-body">
                            <div class="input_row note_input_row">
                                <label for="">Note</label>
                                <div class="note_area">
                                    <div class="note_header d-flex align-items-center flex-wrap">
                                        <button type="button" class="note_btn">
                                            <img src="{{ asset('assets/app/icons/at-sign-black.svg') }}"
                                                alt="at sign" />
                                        </button>
                                        <button type="button" class="note_btn">
                                            <img src="{{ asset('assets/app/icons/link-black.svg') }}" alt="link" />
                                        </button>
                                    </div>
                                    <textarea name="" rows="10" id="noteWriteArea" wire:model.blur='note'
                                        class="input_field" placeholder="Write a note..."></textarea>
                                    @error('note')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('addNote', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel">
                            Add to folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="folder_area">
                            <form onsubmit="event.preventDefault()" class="search_input_form">
                                <input type="search" placeholder="Search folder" wire:model.live='folder_search_term'
                                    class="input_field" />
                                <button type="submit" class="search_icon">
                                    <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                                </button>
                            </form>
                            <h4>Select folder</h4>
                            <div class="folder_list_area">
                                @if ($folders->count() > 0)
                                @foreach ($folders as $folder)
                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" wire:model.live='folder_id'
                                            value="{{ $folder->id }}" name="folderRadioInput" id="folderRadio{{ $folder->id }}" />
                                        <label class="form-check-label" for="folderRadio{{ $folder->id }}">
                                            {{ $folder->name }}
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            wire:click.prevent='editFolder({{ $folder->id }})'>
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button"
                                            wire:click.prevent='deleteConfirmation({{ $folder->id }}, "folder")'
                                            class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                @endif
                            </div>
                            @error('folder_id')
                            <p class="text-danger mt-3" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="button" class="folder_create_btn" data-bs-target="#folderToggleModal2"
                            data-bs-toggle="modal">
                            <img src="{{ asset('assets/app/icons/folder-add.svg') }}" alt="folder  add" />
                            <span>Create new folder</span>
                        </button>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='addToFolder'
                            class="create_event_btn d-flex align-items-center justify-content-center flex-wrap gap-1">
                            {!! loadingStateWithoutText(
                            'addToFolder',
                            '<img src="' .
                                    asset('assets/app/icons/save.svg') .
                                    '" alt="save icon" class="save_icon" />',
                            ) !!} Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal2" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel2">
                            Add to folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='createFolder' class="folder_create_area">
                        <div class="modal-body">
                            <button type="button" class="back_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                <img src="{{ asset('assets/app/icons/back-arrow.png') }}" alt="back arrow" />
                                <span>Back</span>
                            </button>
                            <div class="input_row">
                                <label for="">Folder Name</label>
                                <div class="input_arae">
                                    <input type="text" placeholder="Enter folder name" wire:model.blur='folder_name'
                                        class="input_field" />
                                    <img src="{{ asset('assets/app/icons/folder-01.png') }}" alt="folder icon"
                                        class="folder_icon" />
                                </div>
                                @error('folder_name')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">{!! loadingStateWithText('createFolder',
                                'Save') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal3" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel3" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel3">
                            Edit folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='updateFolder' class="folder_create_area">
                        <div class="modal-body">
                            <button type="button" class="back_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                <img src="{{ asset('assets/app/icons/back-arrow.png') }}" alt="back arrow" />
                                <span>Back</span>
                            </button>
                            <div class="input_row">
                                <label for="">Folder Name</label>
                                <div class="input_arae">
                                    <input type="text" placeholder="Enter folder name" wire:model.blur='folder_name'
                                        class="input_field" />
                                    <img src="{{ asset('assets/app/icons/folder-01.png') }}" alt="folder icon"
                                        class="folder_icon" />
                                </div>
                                @error('folder_name')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">{!! loadingStateWithText('updateFolder',
                                'Save') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overlay" id="contactListOverlay"></div>

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
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='deleteData' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('deleteData', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blacklist data  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="blacklistDataModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Are you sure?</h2>
                            <h4>Would you like remove this contacts from blacklist?</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='removeBlacklist' wire:loading.attr='disabled'
                                    class="delete_yes_btn">
                                    {!! loadingStateWithText('removeBlacklist', 'Yes') !!}
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
<!-- Include Alpine.js for reactive progress bar handling -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('mousedown', function(e) {
            if (this.checked) {
                this.wasChecked = true;
            } else {
                this.wasChecked = false;
            }
        });

        radio.addEventListener('click', function(e) {
            if (this.wasChecked) {
                this.checked = false;
                this.wasChecked = false;

                @this.set('folder_id', null);
            } else {
                this.checked = true;
            }
        });
    });
</script>
<script>
    function copyToClipboard(contact_id) {
            const text = document.getElementById('contact_number_' + contact_id).innerText;
            navigator.clipboard.writeText(text).then(function() {
                successMsg('Number copied successfully');
            }, function(err) {
                console.log(err);
            });
        }

        function copyToClipboardDetails(contact_id) {
            const text = document.getElementById('contact_number_details_' + contact_id).innerText;
            navigator.clipboard.writeText(text).then(function() {
                successMsg('Number copied successfully');
            }, function(err) {
                console.log(err);
            });
        }
</script>
<script>
    // document.addEventListener("DOMContentLoaded", () => {
        //     const input = document.querySelector("#tel-input");
        //     input.addEventListener('input', (e) => {
        //         if (e.target.value) {
        //             const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        //             e.target.value = +x[1] + (x[2] ? `-${x[2]}` : '') + (x[3] ? `-${x[3]}` : '')
        //         }
        //     });

        //     const edit_input = document.querySelector("#tel-input-edit");
        //     edit_input.addEventListener('input', (e) => {
        //         if (e.target.value) {
        //             const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        //             e.target.value = +x[1] + (x[2] ? `-${x[2]}` : '') + (x[3] ? `-${x[3]}` : '')
        //         }
        //     });
        // });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('contactUploadImage');
            const label = document.getElementById('fileUploadLabel');
            const uploadText = document.getElementById('dropText');

            // Highlight label when dragging over it
            label.addEventListener('dragover', function(e) {
                e.preventDefault();
                label.classList.add('border-success');
                uploadText.textContent = 'Drop your file here';
            });

            label.addEventListener('dragleave', function(e) {
                e.preventDefault();
                label.classList.remove('border-success');
                $('#dropText').html('<span>Click to upload</span> or drag and drop');
            });

            label.addEventListener('drop', function(e) {
                e.preventDefault();
                label.classList.remove('border-success');

                // Assign the dropped file to the file input
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;

                    // Trigger the change event so Livewire can detect the file
                    var event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });
        });
</script>


<script>
    $(document).ready(function() {
            // document.getElementById('formCheckAll').addEventListener('click', function() {
            //     const isChecked = this.checked;
            //     const checkboxes = document.querySelectorAll('.contact-checkbox');
            //     checkboxes.forEach(function(checkbox) {
            //         checkbox.checked = isChecked;
            //     });
            // });

            $('.js-searchBox-file-select').on('change', function() {
                var data = $(this).val();
                console.log(data);

                @this.set('import_list_id', data);
            });

            window.addEventListener('setSelectedList', event => {
                $('.js-searchBox-file-select').val(event.detail);
            });

            window.addEventListener('showListEditModal', event => {
                $('#editListModal').modal('show');
            });

            window.addEventListener('showImportConfirmation', event => {
                $('#importModal').modal('hide');
                $('#importConfirmationModal').modal('show');
            });

            window.addEventListener('showContactEditModal', event => {
                $('#contactEditModal').modal('show');
            });

            window.addEventListener('showDetailsModal', event => {
                $('#detailsModal').modal('show');
            });

            window.addEventListener('showNoteAddModal', event => {
                $('#noteModal').modal('show');
            });

            window.addEventListener('noteAdded', event => {
                $('#noteModal').modal('hide');
            });

            window.addEventListener('showFolderModal', event => {
                $('#folderToggleModal').modal('show');
            });

            window.addEventListener('showFolderEditModal', event => {
                $('#folderToggleModal').modal('hide');
                setTimeout(() => {
                    $('#folderToggleModal3').modal('show');
                }, 100);
            });

            window.addEventListener('folderAdded', event => {
                $('#folderToggleModal2').modal('hide');
                setTimeout(() => {
                    $('#folderToggleModal').modal('show');
                }, 100);
            });

            window.addEventListener('folderUpdated', event => {
                $('#folderToggleModal3').modal('hide');
                setTimeout(() => {
                    $('#folderToggleModal').modal('show');
                }, 100);
            });

            window.addEventListener('closeModal', event => {
                $('#newListModal').modal('hide');
                $('#editListModal').modal('hide');
                $('#contactModal').modal('hide');
                $('#contactEditModal').modal('hide');
                $('#folderToggleModal').modal('hide');
                $('#importModal').modal('hide');
                $('#importConfirmationModal').modal('hide');
            });

            window.addEventListener('data_deleted', event => {
                $('#deleteDataModal').modal('hide');
                Swal.fire(
                    "Deleted!",
                    "" + event.detail[0].message + "",
                    "success"
                );
            });

            window.addEventListener('showBlacklistRemoveConfirmation', event => {
                $('#blacklistDataModal').modal('show');
            });

            window.addEventListener('removed_blacklist', event => {
                $('#blacklistDataModal').modal('hide');
                Swal.fire(
                    "Removed!",
                    "" + event.detail[0].message + "",
                    "success"
                );
            });
        });

        $(document).ready(function() {
            //Contact list Functionality
            $("#openContactListBtn").click(function(e) {
                e.preventDefault();
                $("#contactListArea").toggleClass("contact_list_active");
                $("#contactListOverlay").fadeIn();
            });
            $("#contactListOverlay").click(function(e) {
                e.preventDefault();
                $("#contactListArea").toggleClass("contact_list_active");
                $("#contactListOverlay").fadeOut();
            });

            //Emoji Picker
            $("#noteWriteArea").emojioneArea({
                pickerPosition: "bottom",
                filtersPosition: "bottom",
                buttonTitle: "",
            });
        });
</script>
@endpush
