<?php

namespace App\Interface;

interface LinkInterface
{
    public function index();

    public function store($request);

    public function edit($link_id);

    public function update($request, $link_id);

    public function destroy($link_id);

}
