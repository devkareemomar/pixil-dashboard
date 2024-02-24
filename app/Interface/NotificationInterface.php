<?php

namespace App\Interface;

interface NotificationInterface
{
    public function index();

    public function update($notification_id);

    public function updateAll();

    public function destroyAll();

    public function destroy($notification_id);

}
