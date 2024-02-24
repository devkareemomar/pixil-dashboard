<?php

namespace App\Http\Controllers;

use App\Interface\NotificationInterface;


class NotificationController extends Controller
{

    private $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;

        $this->middleware('permission:notification-read|notification-create|notification-update|notification-delete', ['only' => ['index']]);
        $this->middleware('permission:notification-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notification-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notification-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = $this->notification->index();
        return view('notifications.index', compact('results'));
    }

    public function update($notification_id)
    {
        $this->notification->update($notification_id);
        return back()->with('success',  __('Notification updated successfully.'));
    }

    public function updateAll()
    {
        $this->notification->updateAll();
        return back()->with('success',  __('Notification updated successfully.'));
    }

    public function destroyAll()
    {
        $this->notification->destroyAll();
        return back()->with('success',  __('Notification deleted successfully.'));
    }

    public function destroy($notification_id)
    {
        $this->notification->destroy($notification_id);
        return back()->with('success',  __('Notification deleted successfully.'));
    }
}
