<?php

namespace App\Http\Controllers\api;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;

class TwilioMessageController extends Controller
{
    public function handleIncomingMessage(Request $request)
    {
        // Twilio sends POST request with message details in the body
        $from = $request->input('From');
        $to = $request->input('To');
        $body = $request->input('Body');
        $messageSid = $request->input('MessageSid');

        // get Chat
        $chat = Chat::select('chats.id', 'chats.user_id as receiver', 'chats.contact_id as sender')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.from_number', $to)->where('contacts.number', $from)->first();

        if ($chat) {
            $msg = new ChatMessage();
            $msg->chat_id = $chat->id;
            $msg->direction = 'inbound';
            $msg->message = $body;
            $msg->api = 'Twilio';
            $msg->api_receive_status = 'success';
            $msg->api_receive_response = $request;
            $msg->msg_sid = $messageSid;
            $msg->save();

            $chat = Chat::find($chat->id);
            $chat->last_message = $body;
            $chat->save();
        }

        // Return a response Twilio expects
        return response('<?xml version="1.0" encoding="UTF-8"?><Response></Response>', 200)
            ->header('Content-Type', 'text/xml');
    }
}
