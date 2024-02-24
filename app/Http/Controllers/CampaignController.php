<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CampaignRequest;
use App\Interface\CampaignInterface;
use App\Models\Campaign;
use App\Models\Language;
use App\Models\LanguageCampaign;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class CampaignController extends Controller
{

    private $campaign;

    public function __construct(CampaignInterface $campaign)
    {
        $this->campaign = $campaign;

        $this->middleware('permission:campaign-read|campaign-create|campaign-update|campaign-delete', ['only' => ['index']]);
        $this->middleware('permission:campaign-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:campaign-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:campaign-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = Campaign::filter()->paginate();
        return view('campaigns.index', compact('results'));
    }

    public function create()
    {
        return view('campaigns.create');

    }

    public function show($campaign_id)
    {
        $result = $this->campaign->show($campaign_id);
        return view('campaigns.show', compact('result'));
    }

    public function store(CampaignRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $campaigns = $request['campaigns'];
        $default_language = Language::where('is_default', 1)->first();

        $campaign = $this->campaign->store([
            'title' => $campaigns[$default_language->id]['title'],
            'description' => $campaigns[$default_language->id]['description'],
            'slogan' => $campaigns[$default_language->id]['slogan'],
            ...$data
        ]);
        $this->addTranslation($campaigns, $campaign);

        return redirect()->route('campaigns.index')->with('success', __('Campaign created successfully.'));
    }

    public function edit($campaign_id)
    {
        $result = $this->campaign->edit($campaign_id);
        return view('campaigns.edit', compact('result'));
    }

    public function update(CampaignRequest $request, $campaign_id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $campaigns = $request['campaigns'];
        $default_language = Language::where('is_default', 1)->first();

        $campaign = $this->campaign->update([
            'title' => $campaigns[$default_language->id]['title'],
            'description' => $campaigns[$default_language->id]['description'],
            'slogan' => $campaigns[$default_language->id]['slogan'],
            ...$data
        ], $campaign_id);

        $this->addTranslation($campaigns, $campaign);

        return redirect()->route('campaigns.index')->with('success', __('Campaign updated successfully.'));
    }

    public function destroy($campaign_id)
    {
        $this->campaign->destroy($campaign_id);
        return back()->with('success', __('Campaign deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Campaign::class, $selectedRows);
        return back()->with('success', __('Campaign deleted successfully.'));

    }

    public function export()
    {
        $array = [
            '#',
            __('Title'),
            __('Description'),
            __('Slogan'),
            __('Start Date'),
            __('End Date')
        ];
        $data = Campaign::select($array)->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'Campaigns.csv');
    }

    public function addTranslation($campaigns, $model)
    {
        $model->languageCampaigns()->delete();
        foreach ($campaigns as $key => $campaign) {
            LanguageCampaign::create([
                'language_id' => $key,
                'campaign_id' => $model->id,
                'title' => $campaign['title'],
                'description' => $campaign['description'],
                'slogan' => $campaign['slogan']
            ]);
        }
    }
}
