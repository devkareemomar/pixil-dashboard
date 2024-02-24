<?php

namespace App\Interface;

interface ContactInterface
{
    public function index();

    public function destroy($contact_id);

}
