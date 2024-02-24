<?php

namespace App\Services;

use App\Interface\FormBuilderDataInterface;
use App\Models\FormBuilderData;


class FormBuilderDataServices implements FormBuilderDataInterface
{
    private $formBuilerData;

    public function __construct(FormBuilderData $formBuilerData)
    {
        $this->formBuilerData = $formBuilerData;
    }

    public function show($form_id)
    {
        $formBuilerData = $this->formBuilerData->findOrFail($form_id);
        return $formBuilerData;
    }

    public function update($request, $form_id)
    {
        $formBuilerData = $this->formBuilerData->findOrFail($form_id);
        $formBuilerData->update($request);
        return $formBuilerData;
    }

}
