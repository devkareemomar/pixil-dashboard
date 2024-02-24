<?php

namespace App\Interface;

interface ProjectStatusInterface
{
    public function index();

    public function store($request);

    public function edit($status_id);

    public function update($request, $status_id);

    public function destroy($status_id);

}
