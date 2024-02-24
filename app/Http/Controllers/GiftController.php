<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\GiftTemplateRequest;
use App\Models\Gift;
use App\Models\GiftTemplate;
use App\Models\Project;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::filter()->paginate();
        $projects = Project::all();
        return view('gifts.index', compact('gifts','projects'));
    }


    public function  gift_templates(){
        $templates = GiftTemplate::paginate();
        return view('gifts.templates.index', compact('templates'));
    }


    public function  create_gift_templates(){

        return view('gifts.templates.create');
    }


    public function  store_gift_templates(GiftTemplateRequest $request){
        $data = [];
        if ($request->hasFile('watermark_image')) {
            $data['watermark_image'] = $request->file('watermark_image')->store('templates', 'public');
        }
        if ($request->hasFile('original_image')) {
            $data['original_image'] = $request->file('original_image')->store('templates', 'public');
        }
        GiftTemplate::create($data);

        return redirect()->route('gifts.templates.index')->with('success',  __('Template created successfully.'));
    }

    public function  edit_gift_templates($id){
        $template  =  GiftTemplate::findOrFail($id);

        return view('gifts.templates.edit', compact('template'));

    }

    public function  update_gift_templates(GiftTemplateRequest $request ,$id){
        $data = [];
        if ($request->hasFile('watermark_image')) {
            $data['watermark_image'] = $request->file('watermark_image')->store('templates', 'public');
        }
        if ($request->hasFile('original_image')) {
            $data['original_image'] = $request->file('original_image')->store('templates', 'public');
        }

        GiftTemplate::find($id)->update($data);
        return redirect()->route('gifts.templates.index')->with('success',  __('Template created successfully.'));
    }


    public function destroy_gift_templates($id)
    {
        GiftTemplate::find($id)->delete();
        return redirect()->route('gifts.templates.index')->with('success',  __('Template deleted successfully.'));
    }


    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(GiftTemplate::class, $selectedRows);

        return back()->with('success', __('Template deleted successfully.'));

    }
}
