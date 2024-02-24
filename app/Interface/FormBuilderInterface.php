<?php

namespace App\Interface;

interface FormBuilderInterface
{
    public function index();

    public function store($request);

    public function show($form_id);

    public function edit($form_id);

    public function update($request, $form_id);

    public function destroy($form_id);

}
