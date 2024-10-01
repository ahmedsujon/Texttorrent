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
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="import_btn">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                        <span>Download sample import file</span>
                    </button>
                    <button type="button" class="import_btn" data-bs-toggle="modal" data-bs-target="#importModal">
                        <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                        <span>Import contacts</span>
                    </button>
                </div>
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
                        <form action="" class="search_input_form">
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
                                        <a href="#" class="list_btn">
                                            <span class="list_title">{{ $bList->name }}</span>
                                            <div
                                                class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                                <div class="user_number_area d-flex align-items-center">
                                                    <img src="{{ asset('assets/app/icons/user.svg') }}"
                                                        alt="user icon" />
                                                    <span>{{ listContactsCount($bList->id) }}</span>
                                                </div>
                                                <div class="table_dropdown_area">
                                                    <div class="dropdown">
                                                        <button class="dot_icon" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
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
                                        <a href="#" class="list_btn">
                                            <span class="list_title">{{ $oList->name }}</span>
                                            <div
                                                class="list_action_area d-flex align-items-center justify-content-end flex-wrap">
                                                <div class="user_number_area d-flex align-items-center">
                                                    <img src="{{ asset('assets/app/icons/user.svg') }}"
                                                        alt="user icon" />
                                                    <span>{{ listContactsCount($oList->id) }}</span>
                                                </div>
                                                <div class="table_dropdown_area">
                                                    <div class="dropdown">
                                                        <button class="dot_icon" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
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
                            @else
                                <li class="mt-3 text-center">
                                    <small class="text-muted">No lists found.</small>
                                </li>
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
                                <button type="button" class="create_template_btn" data-bs-toggle="modal"
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
                                                <button type="button" class="dropdown-item">
                                                    <img src="{{ asset('assets/app/icons/user-block-02.svg') }}"
                                                        alt="block user icon" />
                                                    <span>Remove blacklists</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item">
                                                    <img src="{{ asset('assets/app/icons/cloud-download.svg') }}"
                                                        alt="export icon" />
                                                    <span>Export contact list</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item">
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
                        <form action="" class="search_input_form">
                            <input type="search" placeholder="Search folder" class="input_field" />
                            <button type="submit" class="search_icon">
                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                            </button>
                        </form>
                    </div>
                    <div class="details_table_header_area d-flex-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="formCheckAll" />
                            <label class="form-check-label" for="formCheckAll">
                                Select all contacts
                            </label>
                        </div>
                        <a href="#" class="import_btn">
                            <img src="{{ asset('assets/app/icons/call-disabled.svg') }}" alt="call disabled" />
                            <span>Mobile verification & DNC check </span>
                        </a>
                    </div>
                    <div class="details_list_area">
                        @if ($contacts->count() > 0)
                            @foreach ($contacts as $contact)
                                <div class="deatils_list_grid">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                    <div class="user_info_area">
                                        <img src="{{ asset('assets/app/images/inbox/user_main.png') }}"
                                            alt="user image" class="user_top_img" />
                                        <div>
                                            <h4>{{ $contact->first_name }} {{ $contact->last_name }}</h4>
                                            <div class="d-flex align-items-center flex-wrap gap-1">
                                                <h5>{{ $contact->number }}</h5>
                                                <button type="button" class="copy_icon">
                                                    <img src="{{ asset('assets/app/icons/copy-01.svg') }}"
                                                        alt="copy icon" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="list_action_details_area d-flex align-items-center justify-content-end flex-wrap g-sm">
                                        <button type="button" class="icon_btn" data-bs-toggle="modal"
                                            data-bs-target="#detailsModal">
                                            <img src="{{ asset('assets/app/icons/info-02.svg') }}"
                                                alt="message icon" />
                                        </button>
                                        <button type="button" class="icon_btn" data-bs-toggle="modal"
                                            data-bs-target="#noteModal">
                                            <img src="{{ asset('assets/app/icons/notebook.svg') }}"
                                                alt="note icon" />
                                        </button>
                                        <button type="button" class="icon_btn" data-bs-target="#folderToggleModal"
                                            data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/folder-add-02.svg') }}"
                                                alt="folder add icon" />
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
                                                            data-bs-toggle="modal" data-bs-target="#contactEditModal">
                                                            <img src="{{ asset('assets/app/icons/edit-04.svg') }}"
                                                                alt="edit icon" />
                                                            <span>Edit contact</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item">
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
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newListModal">Add new list</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <label for="">List name</label>
                                <input type="text" placeholder="Type List Name" wire:model.blur='list_name'
                                    class="input_field" />

                                @error('list_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn" wire:click.prevent='addNewList'>
                            {!! loadingStateWithText('addNewList', 'Save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit List Modal  -->
        <div wire:ignore.self class="modal fade common_modal news_list_modal" id="editListModal" tabindex="-1"
            aria-labelledby="newListModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newListModal">Edit list</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <label for="">List name</label>
                                <input type="text" placeholder="Type List Name" wire:model.blur='list_name'
                                    class="input_field" />

                                @error('list_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn" wire:click.prevent='updateList'>
                            {!! loadingStateWithText('updateList', 'Save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import Modal  -->
        <div wire:ignore.self class="modal fade common_modal contact_import_modal" id="importModal" tabindex="-1"
            aria-labelledby="importFileModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="importFileModal">
                            Import Contact by File
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="file_upload_area mb-2">
                                <div class="import_icon">
                                    <img src="{{ asset('assets/app/icons/import.svg') }}" alt="import icon" />
                                </div>
                                <h4><span>Click to upload</span> or drag and drop</h4>
                                <h5>Headers are mandatory (max. limit of contacts 10,000)</h5>
                            </div>
                            <div class="uploading_status_area mb-2">
                                <button type="button" class="close_btn">
                                    <img src="{{ asset('assets/app/icons/close.svg') }}" alt="close icon" />
                                </button>

                                <div class="file_name_grid">
                                    <img src="{{ asset('assets/app/icons/bi_filetype-csv.svg') }}" alt="mp3" />
                                    <div>
                                        <h4>Uploading...</h4>
                                        <h5>7/16 MB</h5>
                                    </div>
                                </div>
                                <div class="progress_grid">
                                    <div class="progress" role="progressbar" aria-label="Basic example"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 40%"></div>
                                    </div>
                                    <div class="number">40%</div>
                                </div>
                            </div>
                            <div class="uploading_status_area">
                                <button type="button" class="close_btn">
                                    <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
                                </button>
                                <div class="file_name_grid">
                                    <img src="{{ asset('assets/app/icons/bi_filetype-csv.svg') }}" alt="mp3" />
                                    <div>
                                        <h4>my-cv.csv</h4>
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

                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">First name column <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Select</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">First name column <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Last name column</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">Phone number column <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Select</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">Email address column<span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Last name column</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <label for="">Company column<span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Select</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                                <div class="input_row searchable_select">
                                    <label for="">Additional fields <span class="star">*</span>
                                    </label>
                                    <select name="lang" class="js-searchBox">
                                        <option value="">Last name column</option>
                                        <option value="1">Business Name</option>
                                        <option value="2">First Name</option>
                                        <option value="3">Last Name</option>
                                        <option value="4">Phone</option>
                                        <option value="5">Line Type</option>
                                        <option value="6">Carrier</option>
                                    </select>
                                    <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                        class="down_arrow" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Import list into </label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select</option>
                                    <option value="1">8/8/24</option>
                                    <option value="2">28/8/24</option>
                                    <option value="3">18/8/24</option>
                                    <option value="4">20/8/24</option>
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
                        <button type="button" class="create_event_btn">Submit</button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First name</label>
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
                                <label for="">Mobile number</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+1</span>
                                    <input id="tel-input" type="tel" class="form-control" wire:model.blur='mobile_number' placeholder="xxx-xxx-xxxx" maxlength="12"/>
                                </div>
                                @error('mobile_number')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">Company</label>
                                <input type="text" placeholder="Type Company Name" wire:model.blur='company_name'
                                    class="input_field" />
                                @error('company_name')
                                    <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn" wire:click.prevent='addNewContact'>
                            {!! loadingStateWithText('addNewContact', 'Submit') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Contact Modal  -->
        <div class="modal fade common_modal" id="contactEditModal" tabindex="-1" aria-labelledby="editContactModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editContactModal">
                            Edit contact
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First name</label>
                                    <input type="text" placeholder="Type First name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Last name</label>
                                    <input type="text" placeholder="Type Last name" class="input_field" />
                                </div>
                            </div>
                            <div class="input_row telephone_int_area">
                                <label for="">Mobile number</label>
                                <input type="tel" placeholder="" id="telephone2" />
                            </div>
                            <div class="input_row">
                                <label for="">Company</label>
                                <input type="text" placeholder="Type Company Name" class="input_field" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Submit</button>
                    </div>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="user_details_modal_area">
                            <div class="user_info_area">
                                <img src="{{ asset('assets/app/images/inbox/user_main.png') }}" alt="user image"
                                    class="user_top_img" />
                                <div>
                                    <h4>Tom Hardy</h4>
                                    <div class="d-flex align-items-center flex-wrap gap-1">
                                        <h5>+1 254-125-4446</h5>
                                        <button type="button" class="copy_icon">
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
                                        <h5>Tom Hardy</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/building-03.svg') }}"
                                            alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Company</h4>
                                        <h5>Text Torrent</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/contact.svg') }}" alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Contact list</h4>
                                        <h5>Default</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/call.svg') }}" alt="building icon" />
                                    </div>
                                    <div>
                                        <h4>Phone:</h4>
                                        <h5>(229) 555-0109</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/email.svg') }}" alt="email icon" />
                                    </div>
                                    <div>
                                        <h4>Email:</h4>
                                        <h5 class="word-break-all">example@gmail.com</h5>
                                    </div>
                                </div>
                                <div class="user_info_grid">
                                    <div class="icon">
                                        <img src="{{ asset('assets/app/icons/location.svg') }}"
                                            alt="building icon" />
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
                                        <h5>Text here</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Note Modal  -->
        <div class="modal fade common_modal" id="noteModal" tabindex="-1" aria-labelledby="newNoteModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newContactModal">Add notes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row note_input_row">
                                <label for="">Note</label>
                                <div class="note_area">
                                    <div class="note_header d-flex align-items-center flex-wrap">
                                        <button type="button" class="note_btn">
                                            <img src="{{ asset('assets/app/icons/at-sign-black.svg') }}"
                                                alt="at sign" />
                                        </button>
                                        <button type="button" class="note_btn">
                                            <img src="{{ asset('assets/app/icons/link-black.svg') }}"
                                                alt="link" />
                                        </button>
                                    </div>
                                    <textarea name="" rows="10" id="noteWriteArea" class="input_field" placeholder="Write a note..."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Folder Modal  -->
        <div class="modal fade common_modal folder_modal" id="folderToggleModal" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel">
                            Add to folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="folder_area">
                            <form action="" class="search_input_form">
                                <input type="search" placeholder="Search folder" class="input_field" />
                                <button type="submit" class="search_icon">
                                    <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                                </button>
                            </form>
                            <h4>Select folder</h4>
                            <div class="folder_list_area">
                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput1" />
                                        <label class="form-check-label" for="folderRadioInput1">
                                            Folder 1
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>
                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput2" checked />
                                        <label class="form-check-label" for="folderRadioInput2">
                                            Folder 2
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>
                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput3" />
                                        <label class="form-check-label" for="folderRadioInput3">
                                            Folder 3
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>
                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput4" checked />
                                        <label class="form-check-label" for="folderRadioInput4">
                                            Folder 4
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput5" />
                                        <label class="form-check-label" for="folderRadioInput5">
                                            Folder 5
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput6" checked />
                                        <label class="form-check-label" for="folderRadioInput6">
                                            Folder 6
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput7" />
                                        <label class="form-check-label" for="folderRadioInput7">
                                            Folder 7
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput8" checked />
                                        <label class="form-check-label" for="folderRadioInput8">
                                            Folder 8
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput9" />
                                        <label class="form-check-label" for="folderRadioInput9">
                                            Folder 9
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>

                                <div class="folder_list_item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="folderRadioInput"
                                            id="folderRadioInput10" checked />
                                        <label class="form-check-label" for="folderRadioInput10">
                                            Folder 10
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                        <button type="button" class="edit_folder_btn"
                                            data-bs-target="#folderToggleModal3" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/app/icons/edit-03.svg') }}" alt="edit icon" />
                                        </button>
                                        <button type="button" class="edit_folder_btn">
                                            <img src="{{ asset('assets/app/icons/delete-03.svg') }}"
                                                alt="delete icon" />
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                        <button type="button"
                            class="create_event_btn d-flex align-items-center justify-content-center flex-wrap gap-1">
                            <img src="{{ asset('assets/app/icons/save.svg') }}" alt="save icon" class="save_icon" />
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Folder Modal  -->
        <div class="modal fade common_modal folder_modal" id="folderToggleModal2" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel2" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel2">
                            Add to folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="folder_create_area">
                            <button type="button" class="back_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                <img src="{{ asset('assets/app/icons/back-arrow.png') }}" alt="back arrow" />
                                <span>Back</span>
                            </button>
                            <div class="input_row">
                                <label for="">Folder Name</label>
                                <div class="input_arae">
                                    <input type="text" placeholder="Enter folder name" class="input_field" />
                                    <img src="{{ asset('assets/app/icons/folder-01.png') }}" alt="folder icon"
                                        class="folder_icon" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-target="#folderToggleModal"
                            data-bs-toggle="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Folder Modal  -->
        <div class="modal fade common_modal folder_modal" id="folderToggleModal3" aria-hidden="true"
            aria-labelledby="folderToggleModalLabel3" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="folderToggleModalLabel3">
                            Edit folder
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="folder_create_area">
                            <button type="button" class="back_btn" data-bs-target="#folderToggleModal"
                                data-bs-toggle="modal">
                                <img src="{{ asset('assets/app/icons/back-arrow.png') }}" alt="back arrow" />
                                <span>Back</span>
                            </button>
                            <div class="input_row">
                                <label for="">Folder Name</label>
                                <div class="input_arae">
                                    <input type="text" placeholder="Enter folder name" class="input_field" />
                                    <img src="{{ asset('assets/app/icons/folder-01.png') }}" alt="folder icon"
                                        class="folder_icon" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-target="#folderToggleModal"
                            data-bs-toggle="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Save</button>
                    </div>
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
    </main>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.querySelector("#tel-input");

            input.addEventListener('input', (e) => {
                if (e.target.value) {
                    const x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                    e.target.value = +x[1] + (x[2] ? `-${x[2]}` : '') + (x[3] ? `-${x[3]}` : '')
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            window.addEventListener('showListEditModal', event => {
                $('#editListModal').modal('show');
            });
            window.addEventListener('closeModal', event => {
                $('#newListModal').modal('hide');
                $('#editListModal').modal('hide');
                $('#contactModal').modal('hide');
            });

            window.addEventListener('data_deleted', event => {
                $('#deleteDataModal').modal('hide');
                Swal.fire(
                    "Deleted!",
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
