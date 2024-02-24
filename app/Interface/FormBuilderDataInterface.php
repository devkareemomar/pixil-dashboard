<?php

namespace App\Interface;

interface FormBuilderDataInterface
{
    public function show($form_id);

    public function update($request, $form_id);

}
