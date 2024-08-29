<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $unreadCount;

    public function mount()
    {
        $this->loadNotifications();
        $this->unreadCount = $this->getUnreadCount();
    }

    public function loadNotifications()
    {
        $userId = session()->get('auth_userid');
        $this->notifications = Notification::where('UserId', $userId)->get();
    }

    public function getUnreadCount()
    {
        $userId = session()->get('auth_userid');
        return Notification::where('UserId', $userId)
            ->where('isRead', false)
            ->count();
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['isRead' => 1]);

        $this->unreadCount--;
        $this->loadNotifications();
    }

    public function viewNotification($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['isRead' => 1]);

        $this->unreadCount--;
        return redirect()->to('/transactions/application/view/' . $notification->Reference);
    }

    public function render()
    {
        return view('livewire.notifications', [
            'notifications' => $this->notifications,
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
