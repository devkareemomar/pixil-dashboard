<?php

namespace App\Interface;

interface CareerInterface
{
    public function index();

    public function store($request);

    public function show($career_id);

    public function edit($career_id);

    public function update($request, $career_id);

    public function destroy($career_id);

}
