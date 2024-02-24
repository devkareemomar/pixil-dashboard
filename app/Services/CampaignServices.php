<?php

namespace App\Services;

use App\Interface\CampaignInterface;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;


class CampaignServices implements CampaignInterface
{
    private $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function index()
    {
        $campaigns = $this->campaign->paginate();
        return $campaigns;
    }

    public function show($campaign_id)
    {
        $campaign = $this->campaign->findOrFail($campaign_id);
        return $campaign;
    }

    public function edit($campaign_id)
    {
        $campaigns = $this->campaign->findOrFail($campaign_id);
        return $campaigns;
    }

    public function store($request)
    {
        $campaign = $this->campaign->create($request);
        foreach ($request['projects'] as $project) {
            DB::table('campaign_projects')->insert(['project_id' => $project, 'campaign_id' => $campaign->id]);
        }
        return $campaign;
    }

    public function update($request, $campaign_id)
    {
        if (!isset($request['is_active'])) {
            $request['is_active'] = 0;
        }
        if (!isset($request['is_home_slider'])) {
            $request['is_home_slider'] = 0;
        }
        $campaign = $this->campaign->findOrFail($campaign_id);

        $campaign->update($request);
        DB::table('campaign_projects')->where('campaign_id', $campaign_id)->delete();
        foreach ($request['projects'] as $project) {
            DB::table('campaign_projects')->insert(['project_id' => $project, 'campaign_id' => $campaign->id]);
        }
        return $campaign;
    }

    public function destroy($campaign_id)
    {
        $this->campaign->findOrFail($campaign_id)->delete();
        return true;
    }

}
