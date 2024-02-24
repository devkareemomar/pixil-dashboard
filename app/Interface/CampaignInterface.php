<?php

namespace App\Interface;

interface CampaignInterface
{
    public function index();

    public function store($request);

    public function show($campaign_id);

    public function edit($campaign_id);

    public function update($request, $campaign_id);

    public function destroy($campaign_id);

}
