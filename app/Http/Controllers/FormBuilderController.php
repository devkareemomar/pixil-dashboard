<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\FormBuilderRequest;
use App\Interface\FormBuilderInterface;
use App\Models\FormBuilder;
use App\Models\FormLanguage;
use App\Models\Language;
use Illuminate\Http\Request;

class FormBuilderController extends Controller
{
    private $formBuilder;

    public function __construct(FormBuilderInterface $formBuilder)
    {
        $this->formBuilder = $formBuilder;

        $this->middleware('permission:form builder-read|form builder-create|form builder-update|form builder-delete', ['only' => ['index']]);
        $this->middleware('permission:form builder-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:form builder-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:form builder-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = $this->formBuilder->index();
        return view('forms.index', compact('results'));
    }

    public function create()
    {
        $languages = Language::all();
        return view('forms.create', compact('languages'));
    }

    public function show($form_id)
    {
        $result = $this->formBuilder->show($form_id);
        return view('forms.show', compact('result'));
    }

    public function store(FormBuilderRequest $request)
    {
        $request_data = $request->validated();
        $data = $request['data'];
        $default_language = Language::where('is_default', 1)->first();
        $formBuilder = $this->formBuilder->store([
            // 'status_name' => $data[$default_language->id]['status_name'],
            ...$request_data
        ]);
        // $this->addTranslation($data, $formBuilder);
        return response()->json(__('Status Added Successfully'));
    }

    public function edit($form_id)
    {
        $result = $this->formBuilder->edit($form_id);
        $languages = Language::all();

        return view('forms.edit', compact('result', 'languages'));
    }

    public function update(FormBuilderRequest $request, $form_id)
    {
        $request_data = $request->validated();

        $data = $request['data'];
        $default_language = Language::where('is_default', 1)->first();
        $formBuilder = $this->formBuilder->update([
            // 'status_name' => $data[$default_language->id]['status_name'],
            ...$request_data
        ], $form_id);
        // $this->addTranslation($data, $formBuilder);

        return response()->json(__('Status Updated Successfully'));
    }

    public function addTranslation($data, $model)
    {
        $model->formLanguage()->delete();
        foreach ($data as $key => $form) {
            FormLanguage::create([
                'language_id' => $key,
                'form_builder_id' => $model->id,
                'status_name' => $form['status_name'],
            ]);
        }
    }

    public function destroy($form_id)
    {
        $this->formBuilder->destroy($form_id);
        return back()->with('success', __('Status Deleted Successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(FormBuilder::class, $selectedRows);
        return back()->with('success', __('Status Deleted Successfully.'));

    }

}
