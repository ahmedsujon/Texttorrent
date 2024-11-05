<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TwilioController extends Controller
{
    public function twilioStatusCallback(Request $request)
    {
        // Twilio sends status updates in the request payload
        $messageSid = $request->input('MessageSid');
        $messageStatus = $request->input('MessageStatus');

        // Update message status in `chat_messages` table
        $msg = ChatMessage::where('msg_sid', $messageSid)->first();
        if ($msg) {
            $msg->api_send_status = $messageStatus;
            $msg->save();
        }
    }
}
