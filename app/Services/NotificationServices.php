<?php

namespace App\Services;

use App\Interface\NotificationInterface;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;


class NotificationServices implements NotificationInterface
{
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }


    public function index()
    {
        $notifications = $this->notification->paginate();
        return $notifications;
    }

    public function update($notification_id)
    {
        $notification = $this->notification->where('id', $notification_id)->first();
        $notification->update(['is_read' => 1]);
        return true;
    }

    public function updateAll()
    {
        $this->notification->where('is_read', 0)->update(['is_read' => 1]);
        return true;
    }

    public function destroyAll()
    {
        DB::table('notifications')->delete();
        return true;
    }

    public function destroy($notification_id)
    {
        $this->notification->findOrFail($notification_id)->delete();
        return true;
    }


}
