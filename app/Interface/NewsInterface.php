<?php

namespace App\Interface;

interface NewsInterface
{
    public function index();

    public function store($request);

    public function show($news_id);

    public function edit($news_id);

    public function update($request, $news_id);

    public function destroy($news_id);

}
