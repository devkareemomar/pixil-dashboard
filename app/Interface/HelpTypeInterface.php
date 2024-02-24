<?php

namespace App\Interface;

interface HelpTypeInterface
{
    public function index();

    public function store($request);

    public function edit($help_id);

    public function update($request, $help_id);

    public function destroy($help_id);

}
