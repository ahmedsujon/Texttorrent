<div>
    <main class="main_content_wrapper">
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
                                <form action="" class="chat_search_form" id="chartSearchFormArea">
                                    <input type="search" placeholder="Search Friends" class="input_field" />
                                    <button type="button" class="search_btn" id="chatSearchBtn">
                                        <img src="{{ asset('assets/app/icons/search-gray.svg') }}" alt="search icon" />
                                    </button>
                                </form>
                            </div>
                            <div class="chat_fitler_grid">
                                <div class="folder_filter_area">
                                    <button type="button" class="all_chat_btn" id="folderFilterBtn">
                                        <img class="folder_icon" src="{{ asset('assets/app/icons/folder-01.svg') }}"
                                            alt="folder icon" />
                                        <span>All chat</span>
                                        <img class="down_icon" src="{{ asset('assets/app/icons/arrow-down.svg') }}"
                                            alt="down arrow" />
                                    </button>
                                    <div class="folder_dropdown_area" wire:ignore.self id="folderDropdownArea">
                                        <form action="" class="search_input_form search_input_form_sm">
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
                                                    <button type="button" class="{{ $sort_folder_id == $folder->id ? 'active_dropdown' : '' }}"
                                                        wire:click.prevent='selectFolder({{ $folder->id }})'>
                                                        <img class="folder_icon" src="{{ asset('assets/app/icons/folder-01.svg') }}" alt="folder icon" />
                                                        <span>{{ $folder->name }}</span>
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="all_folder folderMenuList">
                                            <button type="button" class="{{ $sort_folder_id == 'all' ? 'active_dropdown' : '' }}"
                                                wire:click.prevent='selectFolder("all")'>
                                                <img class="folder_icon"
                                                    src="{{ asset('assets/app/icons/folder-01.svg') }}"
                                                    alt="folder icon" />
                                                <span>All chat</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat_time_area">
                                    <select class="niceSelect">
                                        <option data-display="Last 7days">Last 7days</option>
                                        <option value="1">Last month</option>
                                        <option value="2">Last 12 month</option>
                                        <option value="4">All chat</option>
                                    </select>
                                </div>
                                <button type="button" class="unread_btn">Unread</button>
                            </div>
                        </div>
                        <div class="friend_list_area">
                            <ul>
                                @if ($chats->count() > 0)
                                    @foreach ($chats as $chat)
                                        <li>
                                            <button type="button" wire:click.prevent='selectChat({{ $chat->id }})' class="list_item {{ $selected_chat_id == $chat->id ? 'active_chat' : '' }}">
                                                <div class="user_image chat-avatar">{{ $chat->avatar_ltr }}</div>
                                                <div class="short_message_are">
                                                    <h4>{{ $chat->number }}</h4>
                                                    <p>
                                                        {{ $chat->last_message }}
                                                    </p>
                                                </div>
                                                <div class="time_area">
                                                    <h5>{{ Carbon\Carbon::parse($chat->created_at)->format('H:i A') }}
                                                    </h5>
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
                            <div class="user_top_img chat-avatar" style="height: 50px; width: 50px;">{{ $selected_chat->avatar_ltr }}</div>
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
                            <button type="button" data-bs-target="#folderToggleModal" data-bs-toggle="modal">
                                <img src="{{ asset('assets/app/icons/folder-add.svg') }}" alt="folder add icon" />
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <img src="{{ asset('assets/app/icons/delete-01.svg') }}" alt="delete icon" />
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
                                    @if ($msg->sender == user()->id)
                                    <div class="sender_msg">
                                        <div class="text_area">
                                            <p class="msg">
                                                Hey Sheikh, <br />
                                                Thanks for your words. I really appriciate that. Just let
                                                me know if there any things you need from me.
                                            </p>
                                            <img src="{{ asset('assets/app/icons/sender_shape.svg') }}"
                                                alt="sender
                                            shape" class="msg_shape" />
                                            <h6 class="time">12:20 AM</h6>
                                        </div>
                                    </div>
                                    @else
                                    <div class="receive_msg">
                                        <img src="{{ asset('assets/app/images/inbox/user_main.png') }}" alt="user image"
                                            class="recevier_user" />
                                        <div class="text_area">
                                            <p class="msg">
                                                Hi Royal! <br />
                                                I like to buy your products. I just love what your
                                                providing. Also I’ll send you few examples.
                                            </p>
                                            <img src="{{ asset('assets/app/icons/receive_shape.svg') }}"
                                                alt="receive
                                                shape" class="msg_shape" />
                                            <h6 class="time">12:20 AM</h6>
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
                            <form class="chat_box_area">
                                <div class="chat_box_header_area d-flex align-items-center flex-wrap gap-2">
                                    <label for="fileUpload" class="link_btn">
                                        <img src="{{ asset('assets/app/icons/link-02.svg') }}" alt="link icon" />
                                    </label>

                                    <button type="button" class="emoji_btn">
                                        <!-- <img
                                            src="assets/icons/relieved-01.svg"
                                            alt="emoji icon"
                                        /> -->
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
                                <div class="msg_input_area">
                                    <textarea name="" placeholder="Write here..." class="msg_input" id="messageWriteArea"></textarea>
                                </div>
                                <button type="submit" class="send_btn">
                                    <img src="{{ asset('assets/app/icons/send-white.svg') }}" alt="send icon" />
                                </button>
                            </form>
                            <input type="file" class="opacity-0 visually-hidden position-absolute zn-1"
                                id="fileUpload" />
                        </div>
                    </div>
                    @endif
                </div>
                <div class="contact_info_warapper" id="contactInfoArea">
                    @if ($selected_chat)
                        <div class="contact_info_area">
                            <div class="contact_header_area d-flex align-items-center flex-wrap gap-1">
                                <h3>Contact Info</h3>
                            </div>
                            <div class="user_name_area d-flex flex-column align-items-center">
                                <div class="user_right_img chat-avatar d-flex justify-content-center align-items-center">
                                    {{ $selected_chat->avatar_ltr }}
                                </div>
                                <h4 class="mt-3">{{ $selected_chat->first_name }} {{ $selected_chat->last_name }}</h4>
                                <div class="user_action_btn_list d-flex align-items-center justify-content-center flex-wrap">
                                    <button type="button" class="btn">
                                        <img src="{{ asset('assets/app/icons/user-block-02.svg') }}" alt="user block" />
                                    </button>
                                </div>
                            </div>
                            <div class="about_number_area">
                                <div class="about_area">
                                    <div class="d-flex-between">
                                        <h3>About</h3>
                                        <button type="button" class="edit_btn" data-bs-toggle="modal"
                                            data-bs-target="#updateModal">
                                            <img src="{{ asset('assets/app/icons/edit-02.svg') }}" alt="edit icon" />
                                            <span>Edit</span>
                                        </button>
                                    </div>
                                    <div class="user_info_contact_area">
                                        <div class="user_info_grid">
                                            <div class="icon">
                                                <img src="{{ asset('assets/app/icons/user.svg') }}" alt="user icon" />
                                            </div>
                                            <div>
                                                <h4>Name</h4>
                                                <h5>{{ $selected_chat->first_name }} {{ $selected_chat->last_name }}</h5>
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
                                                <h5>{{ $selected_chat->list_id && isset(getListByID($selected_chat->list_id)->name) ? getListByID($selected_chat->list_id)->name : '---' }}</h5>
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
                                            <div class="note_user_grid">
                                                <img src="{{ asset('assets/app/images/inbox/chat_user3.png') }}"
                                                    alt="user image" class="user_image" />
                                                <div class="name_times_area d-flex align-items-center flex-wrap">
                                                    <h4>Jenny Wilson</h4>
                                                    <h5>Today, 9:34 am</h5>
                                                </div>
                                            </div>
                                            <p>
                                                Brandon has already made the arrangement to set up the
                                                solar project. Can you reach out?
                                            </p>
                                            <div class="note_action_btn">
                                                <button type="button">
                                                    <img src="{{ asset('assets/app/icons/check.png') }}"
                                                        alt="check icon" />
                                                </button>
                                                <button type="button">
                                                    <img src="{{ asset('assets/app/icons/20-emoji-smile.svg') }}"
                                                        alt="emoji  icon" />
                                                </button>
                                            </div>
                                        </div>
                                        <form action="" class="note_form">
                                            <textarea name="" id="noteWriteArea" class="note_input" placeholder="Write a note..."></textarea>
                                            <div class="note_action_grid">
                                                <div class="note_action_area d-flex align-items-center flex-wrap">
                                                    <button type="button">
                                                        <img src="{{ asset('assets/app/icons/at-sign.svg') }}"
                                                            alt="at sign" />
                                                    </button>
                                                    <label for="noteFileUpload" class="file_upload">
                                                        <img src="{{ asset('assets/app/icons/link-02.svg') }}"
                                                            alt="link icon" />
                                                    </label>

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
                                    <a href="tel:+(229)555-0109" class="number_grid">
                                        <img src="{{ asset('assets/app/icons/call-outgoing-01.svg') }}"
                                            alt="call icon" />
                                        <span>(229) 555-0109</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

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
                                <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
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
                                <img src="{{ asset('assets/app/icons/back-arrow-black.svg') }}" alt="back arrow" />
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

        <!-- Sms Template Modal  -->
        <div class="modal fade common_modal" id="smsTemplateModal" tabindex="-1" aria-labelledby="templateModal"
            aria-hidden="true">
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
                            <div class="input_row searchable_select">
                                <label for="">Template</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Template</option>
                                    <option value="1">Python</option>
                                    <option value="2">Java</option>
                                    <option value="3">Ruby</option>
                                    <option value="4">C/C++</option>
                                    <option value="5">C#</option>
                                    <option value="6">JavaScript</option>
                                    <option value="7">PHP</option>
                                    <option value="8">Swift</option>
                                    <option value="9">Scala</option>
                                    <option value="10">R</option>
                                    <option value="11">Go</option>
                                    <option value="12">VisualBasic.NET</option>
                                    <option value="13">Kotlin</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <label for="">Preview</label>
                                <textarea name="" id="" placeholder="Template Preview" class="input_field textarea_field"
                                    rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Event Modal  -->
        <div class="modal fade common_modal" id="eventModal" tabindex="-1" aria-labelledby="newEventModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newEventModal">
                            Create New Event
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <label for="">Event Name</label>
                                <input type="text" placeholder="Type Name" class="input_field" />
                            </div>
                            <div class="input_row">
                                <label for="">Subject</label>
                                <input type="text" placeholder="Type Subject" class="input_field" />
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Date</label>
                                    <input type="date" placeholder="Type Name" class="input_field" />
                                </div>
                                <div class="input_row">
                                    <label for="">Time</label>
                                    <input type="time" placeholder="Type Subject" class="input_field" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Sender</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Sender</option>
                                    <option value="1">Python</option>
                                    <option value="2">Java</option>
                                    <option value="3">Ruby</option>
                                    <option value="4">C/C++</option>
                                    <option value="5">C#</option>
                                    <option value="6">JavaScript</option>
                                    <option value="7">PHP</option>
                                    <option value="8">Swift</option>
                                    <option value="9">Scala</option>
                                    <option value="10">R</option>
                                    <option value="11">Go</option>
                                    <option value="12">VisualBasic.NET</option>
                                    <option value="13">Kotlin</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">From Email</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Email</option>
                                    <option value="1">example@gmail.com</option>
                                    <option value="2">example1@gmail.com</option>
                                    <option value="3">example2@gmail.com</option>
                                    <option value="4">example3@gmail.com</option>
                                    <option value="5">example4@gmail.com</option>
                                    <option value="6">example5@gmail.com</option>
                                    <option value="7">example6@gmail.com</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="checkbox_area d-flex align-items-center flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fromPhone" />
                                    <label class="form-check-label mb-0" for="fromPhone">
                                        From Phone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fromEmail" />
                                    <label class="form-check-label mb-0" for="fromEmail">
                                        From Email
                                    </label>
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Alert Before</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Select Minutes</option>
                                    <option value="1">10 Minutes</option>
                                    <option value="2">20 Minutes</option>
                                    <option value="3">30 Minutes</option>
                                    <option value="4">40 Minutes</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="partipants_area">
                                <div class="d-flex-between">
                                    <h3>Participants</h3>
                                    <button type="button" class="border_btn" id="addNew">
                                        Add New
                                    </button>
                                </div>
                            </div>
                            <div class="participants_user_area" id="participantsArea">
                                <div class="two_grid">
                                    <div class="input_row searchable_select">
                                        <label for="">Phone Number</label>
                                        <select name="lang" class="js-searchBox">
                                            <option value="">Select Phone Number</option>
                                            <option value="1">0170000001</option>
                                            <option value="2">0170000002</option>
                                            <option value="3">0170000003</option>
                                            <option value="4">0170000004</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    <div class="input_row">
                                        <label for="">Participant Email</label>
                                        <input type="email" placeholder="Type Participant Email"
                                            class="input_field" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">
                            Create Event
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Chat Modal  -->
        <div class="modal fade common_modal" id="newChartModal" tabindex="-1" aria-labelledby="chatModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="chatModal">Start new chat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row searchable_select">
                                <label for="">Sender</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Sender</option>
                                    <option value="1">+1(332)262-786</option>
                                    <option value="2">+1 (332) 262-780</option>
                                    <option value="3">+1 (332) 262-784</option>
                                    <option value="4">+1 (332) 262-788</option>
                                    <option value="5">+1 (332) 262-783</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <!-- <div class="input_row telephone_int_area">
                    <label for="">Receiver</label>
                    <input type="tel" placeholder="" id="telephone" />
                  </div> -->
                            <div class="input_row">
                                <label for="">Receiver</label>
                                <input type=" number" placeholder="Type receiver number" class="input_field" />
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Template</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Template</option>
                                    <option value="1">Template 1</option>
                                    <option value="2">Template 2</option>
                                    <option value="3">Template 3</option>
                                    <option value="4">Template 4</option>
                                    <option value="5">Template 5</option>
                                </select>
                                <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                    class="down_arrow" />
                            </div>
                            <div class="input_row">
                                <label for="">Message</label>
                                <textarea name="" id="" rows="5" class="input_field textarea_field"
                                    placeholder="Write here..."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer event_modal_footer">
                        <button type="button" class="cancel_btn" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="create_event_btn">Start chat</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete  Modal  -->
        <div class="modal fade delete_modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="content_area">
                            <h2>Would you like to permanently delete this event?</h2>
                            <h4>Once deleted, this event will no longer be accessible</h4>
                            <div class="delete_action_area d-flex align-items-center flex-wrap">
                                <button type="button" class="delete_cancel_btn" id="deleteModalCloseBtn">
                                    Cancel
                                </button>
                                <button type="button" class="delete_yes_btn">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal  -->
        <!-- New Event Modal  -->
        <div class="modal fade common_modal" id="updateModal" tabindex="-1" aria-labelledby="updateInfoModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateInfoModal">
                            Update Information
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="event_form_area">
                            <div class="input_row">
                                <label for="">Name</label>
                                <input type="text" placeholder="Type Name" value="Tom Hardy"
                                    class="input_field" />
                            </div>

                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Company </label>
                                    <input type="text" placeholder="Type Subject" class="input_field"
                                        value="Text Torrent" />
                                </div>
                                <div class="input_row">
                                    <label for="">Contact</label>
                                    <input type="text" placeholder="Type Subject" class="input_field"
                                        value="(229) 555-0109" />
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="">Email </label>
                                    <input type="email" placeholder="Type Email" class="input_field"
                                        value="example@gmail.com" />
                                </div>
                                <div class="input_row">
                                    <label for="">Phone</label>
                                    <input type="text" placeholder="Type Phone Number" class="input_field"
                                        value="(229) 555-0109" />
                                </div>
                            </div>
                            <div class="input_row searchable_select">
                                <label for="">Country</label>
                                <select name="lang" class="js-searchBox">
                                    <option value="">Choose Sender</option>
                                    <option value="1">Python</option>
                                    <option selected value="2">Java</option>
                                    <option value="3">Ruby</option>
                                    <option value="4">C/C++</option>
                                    <option value="5">C#</option>
                                    <option value="6">JavaScript</option>
                                    <option value="7">PHP</option>
                                    <option value="8">Swift</option>
                                    <option value="9">Scala</option>
                                    <option value="10">R</option>
                                    <option value="11">Go</option>
                                    <option value="12">VisualBasic.NET</option>
                                    <option value="13">Kotlin</option>
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
                        <button type="button" class="create_event_btn">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" id="contactInfoOverlay"></div>
        <div class="overlay" id="chatListOverlay"></div>
    </main>
</div>

@push('scripts')
    <script>
        window.addEventListener('reload_scripts', event => {
            setTimeout(() => {
                function adjustMessageHeight() {
                    var windowHeight = $(window).height();
                    var headerHeight = $("#userHeaderArea").outerHeight();
                    var inputHeight = $("#messageInputArea").outerHeight();
                    var messagesHeight = windowHeight - headerHeight - inputHeight;
                    $("#messageArea").css(
                        "height",
                        window?.innerWidth < 768 ?
                        messagesHeight - 140 :
                        messagesHeight - 80 + "px"
                    );
                }

                // Initial adjustment
                adjustMessageHeight();

                // Adjust on window resize
                $(window).resize(function() {
                    adjustMessageHeight();
                });
            }, 1);
        });

        $(document).ready(function() {
            //Message Height
            function adjustMessageHeight() {
                var windowHeight = $(window).height();
                var headerHeight = $("#userHeaderArea").outerHeight();
                var inputHeight = $("#messageInputArea").outerHeight();
                var messagesHeight = windowHeight - headerHeight - inputHeight;
                $("#messageArea").css(
                    "height",
                    window?.innerWidth < 768 ?
                    messagesHeight - 140 :
                    messagesHeight - 80 + "px"
                );
            }

            // Initial adjustment
            adjustMessageHeight();

            // Adjust on window resize
            $(window).resize(function() {
                adjustMessageHeight();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
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
            });

            //Emoji Picker
            $("#messageWriteArea").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
                buttonTitle: "",
                events: {
                    ready: function(editor, button) {
                        // Customize the button icon
                        $(button).html(
                            '<img src="{{ asset('assets/app/icons/relieved-02.svg') }}" alt="Emoji Picker Icon">'
                        );
                    },
                },
            });
            $("#noteWriteArea").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
                buttonTitle: "",
            });
        });
    </script>
@endpush
