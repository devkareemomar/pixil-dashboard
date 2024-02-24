<?php

namespace App\Services;

use App\Interface\CampaignInterface;
use App\Interface\FormBuilderInterface;
use App\Models\Campaign;
use App\Models\FormBuilder;
use Illuminate\Support\Facades\DB;


class FormBuilderServices implements FormBuilderInterface
{
    private $formBuiler;

    public function __construct(FormBuilder $formBuiler)
    {
        $this->formBuiler = $formBuiler;
    }

    public function index()
    {
        $formBuilers = $this->formBuiler->filter()->paginate();
        return $formBuilers;
    }

    public function show($form_id)
    {
        $formBuilder = $this->formBuiler->findOrFail($form_id);
        return $formBuilder;
    }

    public function edit($form_id)
    {
        $formBuilder = $this->formBuiler->findOrFail($form_id);
        return $formBuilder;
    }

    public function store($request)
    {
        $formBuilder = $this->formBuiler->create($request);
        return $formBuilder;
    }

    public function update($request, $form_id)
    {
        $formBuilder = $this->formBuiler->findOrFail($form_id);
        if ($request['form_data']=="[]"){
           $request['form_data']=$formBuilder->form_data;
        }
        $formBuilder->update($request);
        return $formBuilder;
    }

    public function destroy($form_id)
    {
        $this->formBuiler->findOrFail($form_id)->delete();
        return true;
    }

}
