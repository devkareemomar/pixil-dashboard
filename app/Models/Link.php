<?php

namespace App\Models;

class Link extends BaseModel
{
    protected $fillable = ['code', 'project_id', 'url', 'platform', 'user_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getUniqueColumns()
    {
        return ['code'];
    }

    public static function generate($project, $count, $platform = null)
    {
        for ($i = 0; $i < $count; $i++) {
            Link::create([
                'code' => substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5),
                'project_id' => $project->id,
                'url' => "https://main.keyframe-eg.net/projects/" . $project->slug,
                'platform' => $platform,
            ]);
        }
    }

}
