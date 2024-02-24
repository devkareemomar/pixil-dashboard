<?php

namespace App\Interface;

interface HelpListInterface
{
    public function index();

    public function store($request);

    public function show($help_id);

    public function edit($help_id);

    public function update($request, $help_id);

    public function destroy($help_id);

}
