<?php

use App\Models\Admin;
use App\Models\ContactList;
use App\Models\CreditLog;
use App\Models\InboxTemplate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

function admin()
{
    return Auth::guard('admin')->user();
}

function getAdminByID($id)
{
    return Admin::find($id);
}

function user()
{
    return Auth::guard('web')->user();
}

function getUserByID($id)
{
    return User::find($id);
}

function getContactListByID($id)
{
    return ContactList::find($id);
}

function getSMSTempByID($id)
{
    return InboxTemplate::find($id);
}

//Admin Panel Helper Functions
function getRoleName($role_id)
{
    $role = DB::table('roles')->select('role')->where('id', $role_id)->first();
    return $role ? $role->role : '---';
}

//admin Permissions
function adminPermissions()
{
    $permission_ids = DB::table('role_permissions')->where('role_id', admin()->role_id)->pluck('permission_id')->toArray();

    return DB::table('permissions')->whereIn('id', $permission_ids)->pluck('permission')->toArray();
}

function is_permitted($permission)
{
    $permission = DB::table('permissions')->where('permission', $permission)->first();
    $user_permissions = DB::table('role_permissions')->where('role_id', admin()->role_id)->pluck('permission_id')->toArray();
    if (in_array($permission->id, $user_permissions)) {
        return true;
    } else {
        return false;
    }
}

function disabledOn($key)
{
    return "wire:target='" . $key . "' wire:key='" . $key . "' wire:loading.attr='disabled'";
}

function kilobytes($value)
{
    $kilobyte = round(doubleval($value / 1024), 1);
    return $kilobyte;
}
function uploadFile($type, $ratio, $directory, $uploaded_by, $file)
{
    if ($type == 'image') {
        $image = Image::make($file)->resize($ratio, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 75);

        $file_directory = 'uploads/' . $directory;

        $fileName = uniqid() . Carbon::now()->timestamp . '.webp';
        Storage::disk('public_path')->put($file_directory . $fileName, $image->getEncoded());

        return $file_directory . $fileName;
    } else {
        return 'unsupported';
    }
}

function deleteFile($file)
{
    if ($file && Storage::disk('public_path')->exists($file)) {
        Storage::disk('public_path')->delete($file);
    }
}

function listContactsCount($list_id)
{
    if ($list_id == 'unlisted') {
        $count = DB::table('contacts')->where('list_id', NULL)->where('user_id', user()->id)->count();
    } else {
        $count = DB::table('contacts')->where('list_id', $list_id)->where('user_id', user()->id)->count();
    }

    return $count;
}

function getListByID($list_id)
{
    $list = DB::table('contact_lists')->where('id', $list_id)->first();
    return $list;
}

function getActiveSubscription()
{
    if (Auth::user()) {
        $subscription = DB::table('subscriptions')->select('package_type as type', 'package_name as name', 'end_date')->where('user_id', user()->id)->where('payment_status', 'paid')->orderBy('id', 'DESC')->first();

        $status = '';
        if ($subscription && $subscription->end_date && $subscription->end_date > now()) {
            $status = 'Active';
        } else {
            $status = 'Expired';
        }

        $details = [
            'type' => $subscription->type ?? '',
            'name' => $subscription->name ?? '',
            'status' => $status,
        ];
    } else {
        $details = [
            'type' => '',
            'name' => '',
            'status' => '',
        ];
    }

    return $details;

}

function msgCreditCalculation($msg_type = 'sms', $dir = 'outgoing')
{
    $deducted_credits = 0;

    if (getActiveSubscription()['status'] == 'Active') {
        if(getActiveSubscription()['type'] == 'own-gateway'){
            if ($dir == 'outgoing') {
                if ($msg_type =='sms') {
                    $deducted_credits = 1;
                } else if($msg_type =='mms') {
                    $deducted_credits = 2;
                }
            } else if ($dir == 'incoming') {
                if ($msg_type =='sms') {
                    $deducted_credits = 1;
                } else if($msg_type =='mms') {
                    $deducted_credits = 2;
                }
            }

        } else if (getActiveSubscription()['type'] == 'text-torrent') {
            if ($dir == 'outgoing') {
                if ($msg_type =='sms') {
                    $deducted_credits = 7;
                } else if($msg_type =='mms') {
                    $deducted_credits = 9;
                }
            } else if ($dir == 'incoming') {
                if ($msg_type =='sms') {
                    $deducted_credits = 4;
                } else if($msg_type =='mms') {
                    $deducted_credits = 5;
                }
            }
        }
    }

    return $deducted_credits;
}

// function deductSMSCredit($msg_type = 'sms', $dir = 'outgoing')
// {
//     if (getActiveSubscription()['status'] == 'Active') {
//         $credit = DB::table('users')->where('id', user()->id)->first()->credits;

//         if(getActiveSubscription()['type'] == 'own-gateway'){
//             if ($dir == 'outgoing') {
//                 if ($msg_type =='sms') {
//                     $deducted_credits = $credit - 1;
//                 } else if($msg_type =='mms') {
//                     $deducted_credits = $credit - 2;
//                 }
//             } else if ($dir == 'incoming') {
//                 if ($msg_type =='sms') {
//                     $deducted_credits = $credit - 1;
//                 } else if($msg_type =='mms') {
//                     $deducted_credits = $credit - 2;
//                 }
//             }

//         } else if (getActiveSubscription()['type'] == 'text-torrent') {
//             if ($dir == 'outgoing') {
//                 if ($msg_type =='sms') {
//                     $deducted_credits = $credit - 7;
//                 } else if($msg_type =='mms') {
//                     $deducted_credits = $credit - 9;
//                 }
//             } else if ($dir == 'incoming') {
//                 if ($msg_type =='sms') {
//                     $deducted_credits = $credit - 4;
//                 } else if($msg_type =='mms') {
//                     $deducted_credits = $credit - 5;
//                 }
//             }
//         }

//         DB::table('users')->where('id', user()->id)->update(['credits' => $deducted_credits]);
//     }
// }

function getContactNumberName($id)
{
    return DB::table('contacts')->select('first_name', 'last_name', 'number')->find($id);
}

//user Permissions
function userPermissions()
{
    $permissions = DB::table('users')->where('id', user()->id)->first()->permissions;
    return $permissions != NULL ? json_decode($permissions) : [];
}

function isUserPermitted($permission)
{
    $permission = DB::table('user_permissions')->where('permission', $permission)->first();
    if (in_array($permission->id, userPermissions())) {
        return true;
    } else {
        return false;
    }
}

function creditLog($details, $credit_amount)
{
    $credit = new CreditLog();
    $credit->user_id = user()->id;
    $credit->parent_user = user()->type == 'sub' ? user()->parent_id : NULL;
    $credit->details = $details;
    $credit->credit = $credit_amount;
    $credit->save();
}

function loadingStateSm($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> loading</div>
        <div wire:loading.remove wire:target="' . $key . '" wire:key="' . $key . '">' . $title . '</div>
    ';

    return $loadingSpinner;
}

function loadingStateXs($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-xs align-middle" role="status" aria-hidden="true"></span></div>
        <div wire:loading.remove>' . $title . '</div>
    ';
    return $loadingSpinner;
}

function loadingStateStatus($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '" class="app-spinner"><span class="spinner-border spinner-border-xs" role="status" aria-hidden="true"></span></div> ' . $title . '
    ';
    return $loadingSpinner;
}

function loadingStateWithText($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm align-middle" role="status" aria-hidden="true"></span> </div> ' . $title . '
    ';

    return $loadingSpinner;
}

function loadingStateWithTextXs($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-xs align-middle" role="status" aria-hidden="true"></span> </div> ' . $title . '
    ';

    return $loadingSpinner;
}

function loadingStateWithoutText($key, $title)
{
    $loadingSpinner = '
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-sm align-middle" role="status" aria-hidden="true"></span> </div> <span wire:loading.remove wire:target="' . $key . '" wire:key="' . $key . '">' . $title . '</span>
    ';

    return $loadingSpinner;
}

function showErrorMessage($message, $file, $line)
{
    if (env('APP_DEBUG') == 'true') {
        $error_array = [
            'Message' => $message,
            'File' => $file,
            'Line No' => $line,
        ];
        return dd($error_array);
    }
}
