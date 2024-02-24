<?php

namespace App\Interface;

interface NewsTagInterface
{
    public function index();

    public function store($request);

    public function edit($tag_id);

    public function update($request, $tag_id);

    public function destroy($tag_id);

}
