<?php

use Twilio\Rest\Client;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

// twilio send sms
function sendSMSviaTwilio($receiverNumber, $fromNumber, $message, $msg_id)
{
    $getCredentials = DB::table('apis')->where('user_id', user()->id)->where('gateway', 'Twilio')->first();

    if ($getCredentials) {
        $sid = $getCredentials->account_sid;
        $token = $getCredentials->auth_token;

        try {
            $client = new Client($sid, $token);
            $output = $client->messages->create($receiverNumber, [
                'from' => $fromNumber,
                'body' => $message,
                'statusCallback' => route('twilioStatusCallback')
            ]);

            $msgSt = ChatMessage::find($msg_id);
            $msgSt->api = 'Twilio';
            $msgSt->api_send_response = $output;
            $msgSt->msg_sid = $output->sid;
            $msgSt->save();
        } catch (Exception $e) {
            $msgSt = ChatMessage::find($msg_id);
            $msgSt->api_send_status = 'Failed';
            $msgSt->api_send_response = $e->getMessage();
            $msgSt->save();
        }
    } else {
        return [
            'result' => false,
            'message' => 'Twilio API credentials not found for this user.',
        ];
    }
}

function twilioMsgStatus($messageSid)
{
    $getCredentials = DB::table('apis')->where('user_id', user()->id)->where('gateway', 'Twilio')->first();

    if ($getCredentials) {
        $sid = $getCredentials->account_sid;
        $token = $getCredentials->auth_token;

        try {
            $client = new Client($sid, $token);
            $message = $client->messages($messageSid)->fetch();

            return [
                'result' => true,
                'status' => $message->status,
                'from' => $message->from,
                'to' => $message->to,
                'body' => $message->body,
                'full_response' => $message,
                'dateSent' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
            ];
        } catch (Exception $e) {
            return [
                'result' => false,
                'message' => 'Failed to get message status. Please try again later.',
                'error' => $e->getMessage(),
            ];
        }
    } else {
        return [
            'result' => false,
            'message' => 'Twilio API credentials not found for this user.',
        ];
    }
}

function setWebhook($phoneNumber)
{
    $twilioCredentials = DB::table('apis')
        ->where('user_id', auth()->id())
        ->where('gateway', 'Twilio')
        ->first();

    if ($twilioCredentials) {

        $sid = $twilioCredentials->account_sid;
        $token = $twilioCredentials->auth_token;

        $client = new Client($sid, $token);
        $client->incomingPhoneNumbers
            ->read(['phoneNumber' => $phoneNumber])[0]
            ->update([
                "smsUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
                "voiceUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
            ]);
    }
}
