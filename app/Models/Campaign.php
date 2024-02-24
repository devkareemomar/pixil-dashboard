<?php

namespace App\Models;

class Campaign extends BaseModel
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'slogan',
        'start_date',
        'end_date',
        'is_active',
        'is_home_slider'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'campaign_projects');
    }

    public function languageCampaigns()
    {
        return $this->hasMany(LanguageCampaign::class);
    }

    public function donations()
    {
        return $this->belongsTo(Donation::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function projectOrders()
    {
        return $this->hasManyThrough(OrderProject::class, Project::class);
    }

    public function getUniqueColumns()
    {
        return ['title'];
    }
}
