<?php

namespace App\Interface;

interface UserSettingInterface
{
    public function index();

    public function update($request);

    public function changePassword_update($request);


}
