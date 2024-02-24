<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Interface\FormBuilderDataInterface;
use App\Models\FormBuilderData;
use Illuminate\Http\Request;

class FormBuilderDataController extends Controller
{

    private $formBuilderData;

    public function __construct(FormBuilderDataInterface $formBuilderData)
    {
        $this->formBuilderData = $formBuilderData;

        $this->middleware('permission:form builder data-read|form builder-create|form builder-update|form builder-delete', ['only' => ['index']]);
        $this->middleware('permission:form builder data-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:form builder data-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:form builder data-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results =FormBuilderData::filter()->paginate();
        return view('status.index',compact('results'));
    }

    public function show($form_id)
    {
        $result = $this->formBuilderData->show($form_id);
        return view('formData.show', compact('result'));
    }

    public function update(Request $request, $form_id)
    {
        $request_data = $request->all();
        $this->formBuilderData->update($request_data, $form_id);
        return back()->with('success', __('Status Updated Successfully'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(FormBuilderData::class, $selectedRows);
        return back()->with('success', __('Status Deleted Successfully.'));

    }

}
