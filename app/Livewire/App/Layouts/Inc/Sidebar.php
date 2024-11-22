<?php

namespace App\Livewire\App\Layouts\Inc;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{
    public $notificationPaginate = 10, $filter = 'all';

    public function markAllAsRead()
    {
        DB::table('notifications')->where('user_id', user()->id)->update(['status' => 1]);
        $this->dispatch('success', ['message' => 'All notifications marked as read.']);
    }

    public function archiveAll()
    {
        DB::table('notifications')->where('user_id', user()->id)->update(['archived' => 1]);
        $this->dispatch('success', ['message' => 'All notifications archived.']);
    }
    public function unArchiveAll()
    {
        DB::table('notifications')->where('user_id', user()->id)->update(['archived' => 0]);
        $this->dispatch('success', ['message' => 'All notifications un-archived.']);
    }

    public function markAsRead($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        $this->dispatch('success', ['message' => 'Notification marked as read.']);
    }

    public function archive($id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();

        if ($notification) {
            $newStatus = $notification->archived ? 0 : 1;

            DB::table('notifications')
                ->where('id', $id)
                ->update(['archived' => $newStatus]);

            $message = $newStatus ? 'Notification archived.' : 'Notification unarchived.';
            $this->dispatch('success', ['message' => $message]);
        } else {
            $this->dispatch('error', ['message' => 'Notification not found.']);
        }
    }

    public function filterNotification($type)
    {
        $this->filter = $type;
    }

    public function render()
    {
        $notifications = DB::table('notifications')->select('*')->where('user_id', user()->id);

        if ($this->filter == 'all') {
            $notifications = $notifications->where('archived', 0);
        }
        if ($this->filter == 'unread') {
            $notifications = $notifications->where('status', 0);
        }
        if ($this->filter == 'archived') {
            $notifications = $notifications->where('archived', 1);
        }
        $notifications = $notifications->orderBy('created_at', 'DESC')->paginate($this->notificationPaginate);

        $unread_notification = DB::table('notifications')->where('user_id', user()->id)->where('status', 0)->count();

        return view('livewire.app.layouts.inc.sidebar', ['notifications' => $notifications, 'unread_notification' => $unread_notification]);
    }
}
