<div>
    <style>
        /* clears the ‘X’ from Internet Explorer */
        input[type=search]::-ms-clear {
            display: none;
            width: 0;
            height: 0;
        }

        input[type=search]::-ms-reveal {
            display: none;
            width: 0;
            height: 0;
        }

        /* clears the ‘X’ from Chrome */
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
    </style>
    <main class="main_content_wrapper inbox_fixed_height">
        <!-- Inbox Section  -->
        <section class="inbox_wrapper content_no_space content_md_no_space">
            <div class="inbox_grid">
                <div class="mobile_chat_header">
                    <div class="d-flex-between">
                        <div class="d-flex align-items-center flex-wrap gap-1">
                            <button type="button" class="sidebar_open_btn" id="sidebarShowBtn2">
                                <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                            </button>
                            <h3>Chats</h3>
                        </div>

                        <button type="button" class="chat_list_btn" id="openChatBtn">
                            <img src="{{ asset('assets/app/icons/grip-vertical-solid.svg') }}" alt="grip icon"
                                style="max-width: 14px" />
                        </button>
                    </div>
                </div>
                <div class="friends_chat_wrapper" id="friendChatArea">
                    <div class="friends_chat_list_area">
                        <div class="list_header_area">
                            <div class="friend_list_header_grid">
                                <div class="d-flex align-items-center gap-1">
                                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}"
                                            alt="double arrow" />
                                    </button>
                                    <h3>Chats</h3>
                                </div>
                                <form onsubmit="event.preventDefault()" class="chat_search_form"
                                    id="chartSearchFormArea" wire:ignore>
                                    <input type="search" placeholder="Search chats" id="searchChat"
                                        class="input_field" />
                                    <button type="button" class="search_btn" id="chatSearchBtn">
                                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                                    </button>
                                </form>
                            </div>
                            <div class="chat_fitler_grid">
                                <div class="folder_filter_area">
                                    <button type="button" class="all_chat_btn" id="folderFilterBtn" wire:ignore>
                                        <img class="folder_icon" src="{{ asset('assets/app/icons/folder-01.svg') }}"
                                            alt="folder icon" />
                                        <span>All chat</span>
                                        <img class="down_icon" src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                            alt="down arrow" />
                                    </button>
                                    <div class="folder_dropdown_area" wire:ignore.self id="folderDropdownArea">
                                        <form onsubmit="event.preventDefault()"
                                            class="search_input_form search_input_form_sm">
                                            <input type="search" placeholder="Search folder"
                                                wire:model.live='folder_search_term' class="input_field" />
                                            <button type="submit" class="search_icon">
                                                <img src="{{ asset('assets/app/icons/search-gray.svg') }}"
                                                    alt="search icon" />
                                            </button>
                                        </form>
                                        <h4>Select folder</h4>
                                        <ul class="folder_list folderMenuList">
                                            @foreach ($folders as $folder)
                                                <li>
                                                    <button type="button"
                                                        class="{{ $sort_folder_id == $folder->id ? 'active_dropdown' : '' }}"
                                                        wire:click.prevent='selectFolder({{ $folder->id }})'>
                                                        <img class="folder_icon"
                                                            src="{{ asset('assets/app/icons/folder-01.svg') }}"
                                                            alt="folder icon" />
                                                        <span>{{ $folder->name }}</span>
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="all_folder folderMenuList">
                                            <button type="button"
                                                class="{{ $sort_folder_id == 'all' ? 'active_dropdown' : '' }}"
                                                wire:click.prevent='selectFolder("all")'>
                                                <img class="folder_icon"
                                                    src="{{ asset('assets/app/icons/folder-01.svg') }}"
                                                    alt="folder icon" />
                                                <span>All chat</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat_time_area" wire:ignore>
                                    <select class="niceSelect" id="filter_time">
                                        <option value="all" selected>All Chats</option>
                                        <option value="last_week">Last 7Days</option>
                                        <option value="last_month">Last Month</option>
                                        <option value="last_year">Last 12 Month</option>
                                    </select>
                                </div>
                                <button type="button" class="unread_btn"
                                    style="{{ $unread_filter ? 'background: #F5F6F8;' : '' }}"
                                    wire:click.prevent='showUnread'>
                                    Unread
                                </button>
                            </div>
                        </div>
                        <div class="friend_list_area">
                            <div wire:loading wire:target='showUnread,filter_time,selectFolder,searchTerm,selectChat'
                                style="position: absolute; left: 35%; top: -15px; background: #F5F6F8; border-radius: 5px; padding: 1px 10px;">
                                <span class="spinner-border spinner-border-sm align-middle" role="status"
                                    aria-hidden="true"></span> <small>Processing...</small>
                            </div>
                            <ul>
                                @if ($chats->count() > 0)
                                    @foreach ($chats as $chat)
                                        <li>
                                            <button type="button" wire:click.prevent='selectChat({{ $chat->id }})'
                                                class="list_item {{ $selected_chat_id == $chat->id ? 'active_chat' : '' }}">
                                                <div class="user_image chat-avatar">{{ $chat->avatar_ltr }}</div>
                                                <div class="short_message_are">
                                                    <h6>{{ $chat->first_name }} {{ $chat->last_name }}</h6>
                                                    <p style="font-size: 11.5px;">{{ $chat->number }}</p>
                                                    <p style="{{ $chat->unread ? 'font-weight: 700;' : '' }}">
                                                        {{ $chat->last_message }}
                                                    </p>
                                                </div>
                                                <div class="time_area">
                                                    <h5>{{ Carbon\Carbon::parse($chat->updated_at)->format('H:i A') }}
                                                    </h5>
                                                    @if ($chat->unread)
                                                        <span class="badge bg-danger rounded-circle"
                                                            style="font-size: 10px !important;">{{ $chat->unread_count }}</span>
                                                    @endif
                                                    {{-- <span class="text-danger" style="font-size: 35px;">•</span> --}}
                                                    {{-- <div class="d-flex justify-content-end">
                                                        <div class="number">1</div>
                                                    </div> --}}
                                                </div>
                                            </button>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-center p-5"><small>No chats found!</small></li>
                                @endif
                            </ul>
                            <button type="button" class="new_msg_btn" data-bs-toggle="modal"
                                data-bs-target="#newChartModal">
                                <img src="{{ asset('assets/app/icons/plus_white.svg') }}" alt="plus icon" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="message_area">
                    @if ($selected_chat)
                        <div class="user_header_area" id="userHeaderArea">
                            <div class="user_info_area">
                                <div class="user_top_img chat-avatar" style="height: 50px; width: 50px;">
                                    {{ $selected_chat->avatar_ltr }}</div>
                                <div style="padding-left: 10px; ">
                                    <h4>{{ $selected_chat->first_name }} {{ $selected_chat->last_name }}</h4>
                                    <div class="d-flex align-items-center flex-wrap gap-1">
                                        <h6 id="usersNumber">{{ $selected_chat->number }}</h6>
                                        <button type="button" class="copy_icon" id="copyNumber">
                                            <img src="{{ asset('assets/app/icons/copy-01.svg') }}" alt="copy icon" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="header_action_area d-flex align-items-center justify-content-end flex-wrap">
                                <button type="button" wire:click.prevent='addFolderModal({{ $selected_chat_id }})'>
                                    {!! loadingStateWithoutText(
                                        'addFolderModal(' . $selected_chat_id . ')',
                                        '<img src="' . asset('assets/app/icons/folder-add.svg') . '" alt="folder add icon" />',
                                    ) !!}
                                </button>
                                <button type="button"
                                    wire:click.prevent='deleteConfirmation({{ $selected_chat_id }}, "chat")'>
                                    {!! loadingStateWithoutText(
                                        'deleteConfirmation(' . $selected_chat_id . ", 'chat')",
                                        '<img src="' . asset('assets/app/icons/delete-01.svg') . '" alt="folder add icon" />',
                                    ) !!}
                                </button>
                                <button type="button" class="info_btn" id="contactInfoOpenBtn">
                                    <img src="{{ asset('assets/app/icons/info-circle.svg') }}" alt="info icon" />
                                </button>
                            </div>
                        </div>

                        <div class="message_write_area">
                            <div class="message_chat_area" id="messageArea">
                                @if ($messages->count() > 0)
                                    @foreach ($messages as $msg)
                                        @if ($msg->direction == 'outbound')
                                            <div class="sender_msg">
                                                <div class="text_area">
                                                    <p class="msg">
                                                        {!! $msg->message !!}
                                                    </p>
                                                    <img src="{{ asset('assets/app/icons/sender_shape.svg') }}"
                                                        alt="sender shape" class="msg_shape" />
                                                    <h6 class="time">
                                                        @if ($msg->api_send_status == 'failed')
                                                            <small class="text-danger"
                                                                style="font-size: 11px;">Message sending failed</small>
                                                        @else
                                                            {{ Carbon\Carbon::parse($msg->updated_at)->format('H:i A') }}
                                                        @endif

                                                        <a href=""
                                                            wire:click.prevent='getMsgStatus("{{ $msg->msg_sid }}")'>{!! loadingStateWithText('getMsgStatus', 'GetStatus') !!}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        @else
                                            <div class="receive_msg">
                                                <div class="recevier_user chat-avatar"
                                                    style="height: 50px; width: 50px;">
                                                    {{ $selected_chat->avatar_ltr }}</div>
                                                <div class="text_area">
                                                    <p class="msg">
                                                        {!! $msg->message !!}
                                                    </p>
                                                    <img src="{{ asset('assets/app/icons/receive_shape.svg') }}"
                                                        alt="receive shape" class="msg_shape" />
                                                    <h6 class="time">
                                                        {{ Carbon\Carbon::parse($msg->updated_at)->format('H:i A') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="w-100 mt-5 text-center">
                                        <p class="">No messages found!</p>
                                    </div>
                                @endif
                            </div>
                            <div class="message_write_input_area position-relative" id="messageInputArea">
                                <form class="chat_box_area" id="sendMessageForm" enctype="multipart/form-data"
                                    wire:ignore>
                                    <div class="chat_box_header_area d-flex align-items-center flex-wrap gap-2">
                                        <label for="fileUpload" class="link_btn">
                                            <img src="{{ asset('assets/app/icons/link-02.svg') }}" alt="link icon" />
                                        </label>

                                        <!-- Emoji Button Trigger -->
                                        <button type="button" class="emoji_btn" id="emoji_btn">
                                            <img src="{{ asset('assets/app/icons/relieved-01.svg') }}"
                                                alt="emoji icon" />
                                        </button>

                                        <button type="button" class="template_btn" data-bs-toggle="modal"
                                            data-bs-target="#smsTemplateModal">
                                            <img src="{{ asset('assets/app/icons/dashboard-square-add.svg') }}"
                                                alt="dashboard icon" />
                                            <span>SMS template</span>
                                        </button>

                                        <button type="button" class="calender_btn" data-bs-toggle="modal"
                                            data-bs-target="#eventModal">
                                            <img src="{{ asset('assets/app/icons/event_add.svg') }}"
                                                alt="dashboard icon" />
                                            <span>Add event to calendar</span>
                                        </button>
                                    </div>

                                    <!-- Emoji Picker Container -->
                                    <div id="emoji-picker-container"
                                        style="display: none; position: absolute; bottom: 3rem; left: 0; z-index: 1000;">
                                    </div>

                                    <div class="msg_input_area">
                                        <textarea name="message" placeholder="Write here..." class="msg_input" id="messageWriteArea"></textarea>
                                    </div>
                                    <button type="submit" class="send_btn" wire:loading.attr='disabled'>
                                        {!! loadingStateWithoutText(
                                            'sendMessage',
                                            '<img src="' . asset('assets/app/icons/send-white.svg') . '" alt="send icon" />',
                                        ) !!}
                                    </button>
                                </form>
                                <input type="file" class="opacity-0 visually-hidden position-absolute zn-1"
                                    id="fileUpload" />
                            </div>
                        </div>
                    @endif
                </div>
                <div class="contact_info_warapper" id="contactInfoArea">
                    <input type="hidden" value="{{ $selected_chat_id }}" id="selected_chat_id">

                    @if ($selected_chat)
                        <div class="contact_info_area">
                            <div class="contact_header_area d-flex align-items-center flex-wrap gap-1">
                                <h3>Contact Info</h3>
                            </div>
                            <div class="user_name_area d-flex flex-column align-items-center">
                                <div
                                    class="user_right_img chat-avatar d-flex justify-content-center align-items-center">
                                    {{ $selected_chat->avatar_ltr }}
                                </div>
                                <h4 class="mt-3">{{ $selected_chat->first_name }} {{ $selected_chat->last_name }}
                                </h4>
                                <div
                                    class="user_action_btn_list d-flex align-items-center justify-content-center flex-wrap">
                                    <button type="button"
                                        wire:click.prevent='blacklistConfirmation({{ $selected_chat->id }})'
                                        class="btn">
                                        {!! loadingStateWithoutText(
                                            'blacklistConfirmation(' . $selected_chat->id . ')',
                                            '<img src="' . asset('assets/app/icons/user-block-02.svg') . '" alt="" />',
                                        ) !!}
                                    </button>
                                </div>
                            </div>
                            <div class="about_number_area">
                                <div class="about_area">
                                    <div class="d-flex-between">
                                        <h3>About</h3>
                                        <button type="button" class="edit_btn"
                                            wire:click.prevent='editInfo({{ $selected_chat_id }})'>
                                            <img src="{{ asset('assets/app/icons/edit-02.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                    </div>
                                    <div class="user_info_contact_area">
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/user.svg') }}"
                                                    alt="user icon" />
                                            </div>
                                            <div>
                                                <h4>Name</h4>
                                                <h5>{{ $selected_chat->first_name }} {{ $selected_chat->last_name }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/building-03.svg') }}"
                                                    alt="building icon" />
                                            </div>
                                            <div>
                                                <h4>Company</h4>
                                                <h5>{{ $selected_chat->company }}</h5>
                                            </div>
                                        </div>
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/contact.svg') }}"
                                                    alt="building icon" />
                                            </div>
                                            <div>
                                                <h4>Contact list</h4>
                                                <h5>{{ $selected_chat->list_id && isset(getListByID($selected_chat->list_id)->name) ? getListByID($selected_chat->list_id)->name : '---' }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/call.svg') }}"
                                                    alt="building icon" />
                                            </div>
                                            <div>
                                                <h4>Phone:</h4>
                                                <h5>{{ $selected_chat->number }}</h5>
                                            </div>
                                        </div>
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/email.svg') }}"
                                                    alt="building icon" />
                                            </div>
                                            <div>
                                                <h4>Email:</h4>
                                                <h5 class="word-break-all">{{ $selected_chat->email ?? '---' }}</h5>
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
                                    </div>

                                    <div class="note_area position-relative">
                                        <h3>Notes</h3>
                                        <div class="note_list_area">
                                            @foreach ($selected_chat->notes as $chNote)
                                                {{-- <div class="note_user_grid">
                                                    <img src="{{ asset('assets/app/images/inbox/chat_user3.png') }}"
                                                        alt="user image" class="user_image" />
                                                    <div class="name_times_area d-flex align-items-center flex-wrap">
                                                        <h4>Jenny Wilson</h4>
                                                        <h5>Today, 9:34 am</h5>
                                                    </div>
                                                </div> --}}
                                                <p class="mb-0 pb-0">
                                                    {{ $chNote->note }}
                                                </p>
                                                <div class="note_action_btn mt-0">
                                                    <button type="button"
                                                        wire:click.prevent='deleteNote({{ $chNote->id }})'>
                                                        <img src="{{ asset('assets/app/icons/check.png') }}"
                                                            alt="check icon" />
                                                    </button>
                                                    {{-- <button type="button">
                                                        <img src="{{ asset('assets/app/icons/20-emoji-smile.svg') }}"
                                                            alt="emoji  icon" />
                                                    </button> --}}
                                                </div>
                                            @endforeach
                                        </div>
                                        <form wire:submit.prevent='addNote' class="note_form">
                                            <textarea name="" wire:model.blur='note' id="noteWriteArea" class="form-control note_input"
                                                placeholder="Write a note..."></textarea>
                                            @error('note')
                                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                                            @enderror
                                            <div class="note_action_grid">
                                                <div class="note_action_area d-flex align-items-center flex-wrap">
                                                    <button type="button">
                                                        <img src="{{ asset('assets/app/icons/at-sign.svg') }}"
                                                            alt="at sign" />
                                                    </button>
                                                    {{-- <label for="noteFileUpload" class="file_upload">
                                                        <img src="{{ asset('assets/app/icons/link-02.svg') }}"
                                                            alt="link icon" />
                                                    </label> --}}

                                                    <button type="button"></button>
                                                </div>
                                                <button type="submit" class="note_submit_btn">
                                                    <img src="{{ asset('assets/app/icons/note_top_arrow.svg') }}"
                                                        alt="note arrow icon" />
                                                </button>
                                            </div>
                                        </form>
                                        <input type="file" class="opacity-0 visually-hidden position-absolute zn-1"
                                            id="noteFileUpload" />
                                    </div>
                                </div>
                                <div class="user_number_area">
                                    <h4>From</h4>
                                    <a href="tel:{{ $selected_chat->from_number ?? '' }}" class="number_grid">
                                        <img src="{{ asset('assets/app/icons/call-outgoing-01.svg') }}"
                                            alt="call icon" />
                                        <span>{{ $selected_chat->from_number ?? '---' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal" aria-hidden="true"
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
                            <form onsubmit="event.preventDefault()" class="search_input_form">
                                <input type="search" placeholder="Search folder"
                                    wire:model.live='folder_search_term' class="input_field" />
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
                                                <input class="form-check-input" type="radio"
                                                    wire:model.live='folder_id' value="{{ $folder->id }}"
                                                    name="folderRadioInput"
                                                    id="folderRadioInput{{ $folder->id }}" />
                                                <label class="form-check-label"
                                                    for="folderRadioInput{{ $folder->id }}">
                                                    {{ $folder->name }}
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                                                <button type="button" class="edit_folder_btn"
                                                    wire:click.prevent='editFolder({{ $folder->id }})'>
                                                    <img src="{{ asset('assets/app/icons/edit-03.svg') }}"
                                                        alt="edit icon" />
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
                                '<img src="' . asset('assets/app/icons/save.svg') . '" alt="save icon" class="save_icon" />',
                            ) !!} Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal2" aria-hidden="true"
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
                                    <input type="text" placeholder="Enter folder name"
                                        wire:model.blur='folder_name' class="input_field" />
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
                            <button type="submit" class="create_event_btn">{!! loadingStateWithText('createFolder', 'Save') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Folder Modal  -->
        <div wire:ignore.self class="modal fade common_modal folder_modal" id="folderToggleModal3" aria-hidden="true"
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
                                    <input type="text" placeholder="Enter folder name"
                                        wire:model.blur='folder_name' class="input_field" />
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
                            <button type="submit" class="create_event_btn">{!! loadingStateWithText('updateFolder', 'Save') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sms Template Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="smsTemplateModal" tabindex="-1"
            aria-labelledby="templateModal" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="templateModal">
                            Select template
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Template</label>
                                <select name="lang" class="js-searchBox" id="templateSelect">
                                    <option value="">Choose Template</option>
                                    @foreach ($templates as $content)
                                        <option value="{{ $content->preview_message }}"
                                            data-id="{{ $content->id }}">{{ $content->template_name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('selected_template_id')
                                <p class="text-danger" style="font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                            <div class="input_row">
                                <label for="">Preview</label>
                                <textarea id="templatePreview" placeholder="Template Preview" class="input_field textarea_field" rows="5"
                                    readonly></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="create_event_btn" wire:click.prevent='useTemplate'>
                            {!! loadingStateWithText('useTemplate', 'Use Template') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Event Modal  -->
        <div class="modal fade common_modal" wire:ignore.self id="eventModal" tabindex="-1"
            aria-labelledby="newEventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Create New Event
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='addEvent' class="event_form_area">
                        <div class="modal-body">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" wire:model.blur='name' placeholder="Type Name"
                                    class="input_field" />
                                @error('name')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" wire:model.blur='subject' placeholder="Type Subject"
                                    class="input_field" />
                                @error('subject')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" wire:model.blur='date' placeholder="Type Name"
                                        class="input_field" />
                                    @error('date')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" wire:model.blur='time' placeholder="Type Subject"
                                        class="input_field" />
                                    @error('time')
                                        <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row searchable_select mb-1" wire:ignore>
                                <label for="">Sender</label>
                                <select name="lang" wire:model.blur='sender_number'
                                    class="js-searchBox sender_number">
                                    <option value="">Choose Sender</option>
                                    @foreach ($active_numbers as $active_number)
                                        <option value="{{ $active_number->number }}">{{ $active_number->number }}
                                        </option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('sender_number')
                                <p class="text-danger mt-0" style="font-size: 13px;">{{ $message }}</p>
                            @enderror
                            <div class="input_row searchable_select mt-2">
                                <label for="">Alert Before</label>
                                <select name="lang" wire:model.blur='alert_before' class="form-control">
                                    <option value="0">Select Minutes</option>
                                    <option value="10">10 Minutes</option>
                                    <option value="20">20 Minutes</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="40">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                                @error('alert_before')
                                    <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="partipants_area">
                                <div class="d-flex-between">
                                    <h3>Participants</h3>
                                    {{-- <button type="button" class="border_btn" id="addNew">
                                        Add New
                                    </button> --}}
                                </div>
                            </div>
                            <div class="participants_user_area" id="participantsArea">
                                <div class="two_grid">
                                    <div class="input_row searchable_select" wire:ignore>
                                        <label for="">Phone Number</label>
                                        <select name="lang" wire:model.blur='participant_number'
                                            class="js-searchBox participant_number">
                                            <option value="">Choose Number</option>
                                            @foreach ($participant_numbers as $participant_number)
                                                <option value="{{ $participant_number->number }}">
                                                    {{ $participant_number->number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                        @error('participant_number')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" wire:model.blur='participant_email'
                                            placeholder="Type Participant Email" class="input_field" />
                                        @error('participant_email')
                                            <p class="text-danger mb-0" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer event_modal_footer">
                            <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('addEvent', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- New Chat Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="newChartModal" tabindex="-1"
            aria-labelledby="chatModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="chatModal">Start new chat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Sender</label>
                                <select name="lang" class="js-searchBox new_chat_select_sender">
                                    <option value="">Choose Sender</option>
                                    @foreach ($active_numbers as $nItem)
                                        <option value="{{ $nItem->number }}">{{ $nItem->number }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('sender_id')
                                <p class="text-danger" style="font-size: 12.5px; margin-top: -15px;">{{ $message }}
                                </p>
                            @enderror

                            {{-- <div class="input_row searchable_select" wire:ignore>
                                <label for="">Receiver</label>
                                <select name="lang" class="js-searchBox new_chat_select_receiver">
                                    <option value="">Select Receiver</option>
                                    @foreach ($receiver_numbers as $receiverNumber)
                                        <option value="{{ $receiverNumber->id }}">{{ $receiverNumber->number }}
                                        </option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div> --}}

                            <div class="input_row">
                                <label for="">Receiver</label>
                                <div wire:ignore.self class="searchable_input_area position-relative" id="searchableList">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+1</span>
                                        <input type="tel" class="form-control" wire:model.live='receiver_number' id="searchInput" placeholder="xxxxxxxxxx" autocomplete="off" maxlength="10" />
                                    </div>
                                    <div class="suggestion_list_area">
                                        <ul class="list" id="suggestionListArea" wire:ignore.self>
                                            @if ($receiver_numbers->count() > 0)
                                                @foreach ($receiver_numbers as $receiverNumber)
                                                    <li>
                                                        <button type="button" wire:click.prevent="receiverSelect('{{ $receiverNumber->number }}')">{{ $receiverNumber->number }}</button>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="text-center">
                                                    <small class="text-muted">No data available!</small>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            @error('receiver_id')
                                <p class="text-danger" style="font-size: 12.5px; margin-top: -15px;">{{ $message }}
                                </p>
                            @enderror

                            <div class="input_row searchable_select" wire:ignore>
                                <label for="">Template</label>
                                <select name="lang" class="js-searchBox new_chat_select_template"
                                    id="new_chat_select_template">
                                    <option value="">Choose Template</option>
                                    @foreach ($templates as $content)
                                        <option value="{{ $content->preview_message }}"
                                            data-id="{{ $content->id }}">{{ $content->template_name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            @error('selected_template_id_new_chat')
                                <p class="text-danger" style="font-size: 12.5px; margin-top: -15px;">{{ $message }}
                                </p>
                            @enderror
                            <div class="input_row">
                                <label for="">Message <span wire:loading wire:target='useTemplateNewChat'
                                        class="spinner-border spinner-border-xs align-middle" role="status"
                                        aria-hidden="true"></span></label>
                                <textarea name="" id="" rows="5" class="input_field textarea_field new_chat_text_area"
                                    id="new_chat_text_area" placeholder="Write here..."></textarea>
                            </div>
                            @error('selected_template_preview_new_chat')
                                <p class="text-danger" style="font-size: 12.5px; margin-top: -15px;">{{ $message }}
                                </p>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" wire:click.prevent='startNewChat' wire:loading.attr='disabled'
                            class="create_event_btn">
                            {!! loadingStateWithText('startNewChat', 'Start Chat') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Chat Modal  -->
        <div wire:ignore.self class="modal fade common_modal" id="editInfoModal" tabindex="-1"
            aria-labelledby="chatModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="chatModal">Start new chat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent='updateInformation' class="event_form_area">
                        <div class="modal-body">
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">First name</label>
                                    <input type="text" placeholder="Type First name" wire:model.blur='first_name'
                                        required class="input_field" />
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
                                    <input id="tel-input" type="tel" class="form-control"
                                        wire:model.blur='mobile_number' placeholder="xxx-xxx-xxxx" maxlength="12"
                                        required />
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
                                    <label for="">Company</label>
                                    <input type="text" placeholder="Type Company Name"
                                        wire:model.blur='company_name' class="input_field" required />
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
                                {!! loadingStateWithText('updateInformation', 'Submit') !!}
                            </button>
                        </div>
                    </form>
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
                            <h2>Would you like to permanently delete this?</h2>
                            <h4>Once deleted, this will no longer be accessible</h4>
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

        <!-- Blacklist  Modal  -->
        <div wire:ignore.self class="modal fade delete_modal" id="blacklistModal" tabindex="-1"
            aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Are you sure?</h2>
                            <h4>Would you like to blacklist this contact?</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="button" wire:click.prevent='blacklistContact'
                                    wire:loading.attr='disabled' class="delete_yes_btn">
                                    {!! loadingStateWithText('blacklistContact', 'Yes') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" id="contactInfoOverlay"></div>
        <div class="overlay" id="chatListOverlay"></div>
    </main>

</div>

@push('scripts')
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

    <script>
        const searchInput = document.getElementById("searchInput");
        const searchableList = document.getElementById("searchableList");
        const suggestionList = document.querySelectorAll(
            "#suggestionListArea button"
        );

        // Add  class on input focus
        searchInput.addEventListener("focus", () => {
            searchableList.classList.add("active");
        });

        // Remove class on clicking outside
        document.addEventListener("click", (event) => {
            if (!searchableList.contains(event.target)) {
                searchableList.classList.remove("active");
            }
        });

        // Remove class on clicking list
        suggestionList?.forEach((item) => {
            item.addEventListener("click", () => {
                searchableList.classList.remove("active");
            });
        });

        $(document).on('keyup', '#searchInput', function() {
            var val = $('#searchInput').val();
            if (val.length == 10) {
                searchableList.classList.remove("active");
            } else {
                searchableList.classList.add("active");
            }
        });
    </script>

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
        document.addEventListener("DOMContentLoaded", function() {
            const emojiButton = document.querySelector("#emoji_btn");
            const emojiContainer = document.querySelector(
                "#emoji-picker-container"
            );
            const messageArea = document.querySelector("#messageWriteArea");
            const chatForm = document.getElementById("chatForm");

            import(
                "https://unpkg.com/@joeattardi/emoji-button@4.6.0/dist/index.js"
            ).then(({
                EmojiButton
            }) => {
                const picker = new EmojiButton({
                    showPreview: true,
                    position: "bottom-start", // Position below the button
                    emojiVersion: "11.0",
                    emojiSize: "1.5em",
                    emojisPerRow: 9,
                    rows: 7,
                    zIndex: 1000,
                    autoHide: false,
                });

                // Toggle the picker display
                emojiButton.addEventListener("click", () => {
                    picker.togglePicker(emojiButton);
                });

                // Insert emoji at the current cursor position
                picker.on("emoji", (selection) => {
                    const emoji = selection.emoji;
                    const start = messageArea.selectionStart;
                    const end = messageArea.selectionEnd;

                    // Insert emoji at the cursor position
                    messageArea.value =
                        messageArea.value.substring(0, start) +
                        emoji +
                        messageArea.value.substring(end);

                    // Move cursor to the position after the inserted emoji
                    messageArea.selectionStart = messageArea.selectionEnd =
                        start + emoji.length;

                    // Focus back to the textarea for further typing
                    messageArea.focus();
                });

                // Show and hide picker within the specified container
                picker.on("show", () => {
                    emojiContainer.appendChild(picker.picker);
                    emojiContainer.style.display = "block";
                });

                picker.on("hide", () => {
                    emojiContainer.style.display = "none";
                });
            });

            // Prevent Enter from submitting if Shift is pressed
            messageArea.addEventListener("keydown", (event) => {
                if (event.key === "Enter") {
                    if (event.shiftKey) {
                        // Create a new line in the textarea
                        event.preventDefault();
                        const {
                            selectionStart,
                            selectionEnd,
                            value
                        } = messageArea;
                        // Insert a newline character at the cursor position
                        messageArea.value =
                            value.substring(0, selectionStart) +
                            "\n" +
                            value.substring(selectionEnd);
                        // Move the cursor to the new line
                        messageArea.selectionStart = messageArea.selectionEnd =
                            selectionStart + 1;
                    } else {
                        // Submit the form on Enter
                        event.preventDefault();
                        // Trigger form submission
                        var message = $(".msg_input").val();
                        if (message != '') {
                            @this.sendMessage(message);

                            $(".msg_input").val('');
                        }
                    }
                }
            });

            // Form submission handler
            chatForm.addEventListener("submit", (event) => {
                event.preventDefault();
                const message = messageArea.value.trim();
                if (message) {
                    console.log("Message sent:", message);
                    messageArea.value = "";
                }
            });
        });
    </script>

    <script>
        window.addEventListener('showBlackListConfirmation', event => {
            $('#blacklistModal').modal('show');
        });
        window.addEventListener('blackListedSuccess', event => {
            $('#blacklistModal').modal('hide');
            Swal.fire(
                "Success!",
                "Contact successfully blacklisted",
                "success"
            );
        });

        window.addEventListener('showInfoUpdateModal', event => {
            $('#editInfoModal').modal('show');
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
            $('#folderToggleModal').modal('hide');
            $('#editInfoModal').modal('hide');
            $('#eventModal').modal('hide');
            $('#newChartModal').modal('hide');
        });

        window.addEventListener('newChatMessage', event => {
            $('#messageWriteArea').val(event.detail[0].message);
        });

        window.addEventListener('data_deleted', event => {
            $('#deleteDataModal').modal('hide');
            Swal.fire(
                "Deleted!",
                "" + event.detail[0].message + "",
                "success"
            );
        });

        $(document).ready(function() {
            $(".sender_number").on('change', function() {
                @this.set('sender_number', $(this).val());
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function scrollToBottom() {
                const messageArea = document.getElementById('messageArea');
                messageArea.scrollTo({
                    top: messageArea.scrollHeight,
                    behavior: 'smooth'
                });
            }
            scrollToBottom();
            window.addEventListener('scrollToBottom', event => {
                setTimeout(() => {
                    scrollToBottom();
                }, 5);
            });

            function getCurrentTime() {
                const now = new Date();
                let hours = now.getHours();
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';

                hours = hours % 12;
                hours = hours ? hours : 12; // If the hour is 0, set it to 12 (midnight or noon)
                const formattedHours = hours.toString().padStart(2, '0'); // Pad hours with 0 if needed
                return `${formattedHours}:${minutes} ${ampm}`;
            }

            $('#sendMessageForm').on('submit', function(e) {
                e.preventDefault();

                var message = $(".msg_input").val();
                if (message != '') {
                    @this.sendMessage(message);

                    $(".msg_input").val('');
                }
            });

            $('#templateSelect').on('change', function(e) {
                e.preventDefault();

                const selectedOption = templateSelect.options[templateSelect.selectedIndex];
                const selectedId = selectedOption.getAttribute('data-id');
                const selectedPreviewMessage = selectedOption.value;

                $('#templatePreview').val(selectedPreviewMessage);
                @this.set('selected_template_preview', selectedPreviewMessage);
                @this.set('selected_template_id', selectedId);

            });
            document.addEventListener('updateTextarea', function(output) {
                document.getElementById('messageWriteArea').value = output.detail;
                $('#smsTemplateModal').modal('hide');
                $('#templatePreview').val('');
                $('#templateSelect').val('');

                setTimeout(() => {
                    $('#messageWriteArea').focus();
                }, 350);
            });

            $('#filter_time').on('change', function() {
                var data = $(this).val();
                @this.set('filter_time', data);
            });

            $('#searchChat').on('keyup', function() {
                var data = $(this).val();
                @this.set('searchTerm', data);
            });

            // $('.new_chat_select_receiver').on('change', function(e) {
            //     e.preventDefault();
            //     var value = $(this).val();
            //     @this.set('receiver_id', value);
            // });

            $('.receiverSelect').on('click', function(e) {
                var value = $(this).data('number');
                @this.receiverSelect(value);
            });

            $('.new_chat_select_sender').on('change', function(e) {
                e.preventDefault();
                var value = $(this).val();
                @this.set('sender_id', value);
            });

            $('#new_chat_select_template').on('change', function(e) {
                e.preventDefault();

                const selectedOptionNewChat = new_chat_select_template.options[new_chat_select_template
                    .selectedIndex];
                const selectedIdNC = selectedOptionNewChat.getAttribute('data-id');
                const selectedPreviewMessageNC = selectedOptionNewChat.value;

                @this.set('selected_template_preview_new_chat', selectedPreviewMessageNC);
                @this.set('selected_template_id_new_chat', selectedIdNC);

                @this.useTemplateNewChat();
            });

            document.addEventListener('updateTextareaNewChat', function(output) {
                $('.new_chat_text_area').val(output.detail);
            });

            //Chat list Functionality
            $("#openChatBtn").click(function(e) {
                e.preventDefault();
                $("#friendChatArea").toggleClass("chat_list_active");
                $("#chatListOverlay").fadeIn();
            });
            $("#chatListOverlay").click(function(e) {
                e.preventDefault();
                $("#friendChatArea").toggleClass("chat_list_active");
                $("#chatListOverlay").fadeOut();
            });

            //Contact Information Functionality
            $("#contactInfoOpenBtn").click(function(e) {
                e.preventDefault();
                $("#contactInfoArea").toggleClass("contact_active");
                $("#contactInfoOverlay").fadeIn();
            });
            $("#contactInfoOverlay").click(function(e) {
                e.preventDefault();
                $("#contactInfoArea").toggleClass("contact_active");
                $("#contactInfoOverlay").fadeOut();
            });

            // Toggle the dropdown area on button click
            $("#folderFilterBtn").on("click", function() {
                $("#folderDropdownArea").fadeToggle();
                $(this).toggleClass("folder_dropdown_active");
            });

            // Handle folder selection and update button text
            $(".folderMenuList button").on("click", function() {
                // Remove 'active_dropdown' class from all buttons
                $(".folderMenuList button").removeClass("active_dropdown");
                $("#folderFilterBtn").removeClass("folder_dropdown_active");

                // Add 'active_dropdown' class to the clicked button
                $(this).addClass("active_dropdown");

                // Get the selected folder text
                var selectedText = $(this).find("span").text();

                // Update the button text
                $("#folderFilterBtn span").text(selectedText);

                // Hide the dropdown area
                $("#folderDropdownArea").fadeOut();
            });

            // Close the dropdown when clicking outside of it
            $(document).on("click", function(e) {
                if (
                    !$(e.target).closest("#folderDropdownArea, #folderFilterBtn").length
                ) {
                    $("#folderDropdownArea").fadeOut();
                    $("#folderFilterBtn").removeClass("folder_dropdown_active");
                }
            });

            //Toggle Chat Search Functionality
            $("#chatSearchBtn").click(function(e) {
                e.preventDefault();
                $("#chartSearchFormArea").toggleClass("search_active");
            });

            //Copy Number
            $("#copyNumber").click(function() {
                var textToCopy = $("#usersNumber").text();
                var tempTextarea = $("<textarea>");
                $("body").append(tempTextarea);
                tempTextarea.val(textToCopy).select();
                document.execCommand("copy");
                tempTextarea.remove();
                successMsg('Number copied successfully');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize socket.io connection if it hasn't been initialized
            if (!window.socket) {
                window.socket = io('{{ env('SOCKET_SERVER') }}'); // Change to your server URL

                // Remove any previous listener to avoid duplication
                window.socket.off('receive_message');

                window.socket.on('receive_message', function(data) {
                    var chat_id = $('#selected_chat_id').val();

                    if (data.content.user_id == {{ user()->id }} && data.content.chat_id == chat_id &&
                        data.content.type == 'chat') {
                        @this.selectChat(chat_id);
                    } else if (data.content.user_id == {{ user()->id }} && data.content.type ==
                        'chat') {
                        @this.reFreshOnMessageReceived();
                    }

                });
            }
        });
    </script>
@endpush
