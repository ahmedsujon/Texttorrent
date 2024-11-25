<?php

namespace App\Http\Controllers\api;

use App\Models\Chat;
use App\Models\User;
use App\Models\Activity;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\BulkMessageItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;

class TwilioMessageController extends Controller
{
    public function handleIncomingMessage(Request $request)
    {
        // Twilio sends POST request with message details in the body
        $from = $request->input('From');
        $to = $request->input('To');
        $body = $request->input('Body');
        $messageSid = $request->input('MessageSid');
        $numMedia = $request->input('NumMedia');
        // Determine if the message is SMS or MMS
        if ($numMedia > 0) {
            // It's an MMS
            $messageType = 'mms';
        } else {
            // It's an SMS
            $messageType = 'sms';
        }

        // get Chat
        $chat = Chat::select('chats.id', 'chats.user_id as receiver', 'chats.contact_id as sender')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.from_number', $to)->where('contacts.number', $from)->first();
        $claim = BulkMessageItem::where('send_from', $to)->where('send_to', $from)->first();

        $chat_user_id = '';
        if ($chat) {
            $chat_user_id = $chat->receiver;
        } else if ($claim) {
            $chat_user_id = $claim->send_by;
        }

        if ($chat_user_id) {
            $chatUser = DB::table('users')->select('id', 'credits', 'type', 'parent_id')->where('id', $chat_user_id)->first();
            $credit_needed = userMsgCreditCalculation($chatUser->id, $messageType, 'incoming');
            if ($chatUser->type == 'sub') {
                $au_user = DB::table('users')->select('id', 'credits')->where('id', $chatUser->parent_id)->first();
                $credit_has = $au_user->credits;
                $user_id = $au_user->id;
            } else {
                $credit_has = $chatUser->credits;
                $user_id = $chatUser->id;
            }

            if (getUserActiveSubscription($user_id)['status'] == 'Active' && $credit_has >= $credit_needed) {
                $credit_status = 1;
            } else {
                $credit_status = 0;
            }

            if ($claim) {
                $claim->received_message = $body;
                $claim->received_message_sid = $messageSid;
                $claim->credit_clear = $credit_status;
                $claim->save();

                // notifications
                $activity = new Notification();
                $activity->user_id = $claim->send_by;
                $activity->claim_id = $claim->id;
                $activity->content = 'New sms received from ' . $from;
                $activity->save();

                if (env('SOCKET_STATUS') == 'on' && $credit_status == 1) {
                    $content = [
                        "type" => 'claim',
                        "claim_id" => $claim->id,
                        "user_id" => $claim->send_by,
                    ];

                    $socket_server = env('SOCKET_SERVER');
                    $response = Http::post('' . $socket_server . '/send_message', [
                        'content' => $content,
                    ]);
                }
            } else if ($chat) {
                $msg = new ChatMessage();
                $msg->chat_id = $chat->id;
                $msg->direction = 'inbound';
                $msg->message = $body;
                $msg->api = 'Twilio';
                $msg->api_receive_status = 'success';
                $msg->api_receive_response = $request;
                $msg->msg_sid = $messageSid;
                $msg->credit_clear = $credit_status;
                $msg->save();

                $nChat = Chat::find($chat->id);
                $nChat->last_message = $body;
                $nChat->updated_at = now();
                $nChat->save();

                // notifications
                $activity = new Notification();
                $activity->user_id = $nChat->user_id;
                $activity->chat_id = $nChat->id;
                $activity->content = 'New sms received from ' . $from;
                $activity->save();

                if (env('SOCKET_STATUS') == 'on' && $credit_status == 1) {
                    $content = [
                        "type" => 'chat',
                        "chat_id" => $nChat->id,
                        "user_id" => $nChat->user_id,
                    ];

                    $socket_server = env('SOCKET_SERVER');
                    $response = Http::post('' . $socket_server . '/send_message', [
                        'content' => $content,
                    ]);
                }
            }

            if ($credit_status == 1) {
                // credit deduction
                $user = User::find($user_id);
                $user->credits -= $credit_needed;
                $user->save();

                // log
                creditLogIncoming($user_id, 'Incoming message', $credit_needed);
            }
        }

        // Return a response Twilio expects
        return response('<?xml version="1.0" encoding="UTF-8"?><Response></Response>', 200)
            ->header('Content-Type', 'text/xml');
    }
}
