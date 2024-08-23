<?php

use App\Models\Admin;
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

        return $file_directory.$fileName;
    } else {
        return 'unsupported';
    }
}

function deleteFile($file)
{
    if (Storage::disk('public_path')->exists($file)) {
        Storage::disk('public_path')->delete($file);
    }
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
        <div wire:loading wire:target="' . $key . '" wire:key="' . $key . '"><span class="spinner-border spinner-border-xs" role="status" aria-hidden="true"></span></div> ' . $title . '
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
