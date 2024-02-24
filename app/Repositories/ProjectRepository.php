<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Project;

class ProjectRepository
{
    protected $relations = [];

    public function all()
    {
        return Project::all();
    }

    public function paginate($perPage = null)
    {
        return Project::with(['categories', 'subCategory', 'creator', 'status', 'category'])->paginate($perPage);
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update($id, array $data)
    {
        $project = $this->find($id);
        if ($data['is_stock'] == 1) {
            if ($project->is_stock == 1) {
                $project->total_earned = $project->total_earned - $project->stock;
            }
            $data['total_earned'] = $project->total_earned + $data['stock'];
        } else {
            if ($project->is_stock == 1) {
                $project->total_earned = $project->total_earned - $project->stock;
            }
            $data['stock'] = 0;
            $data['total_earned'] = $project->total_earned;
        }
        if ($data['video'] != null) {
            if (str_contains($data['video'], 'youtube.com/watch')) {
                $data['video'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $data['video']);
            }
            if (str_contains($data['video'], '//vimeo.com')) {
                $data['video'] = preg_replace('/vimeo.com/i', 'player.vimeo.com/video', $data['video']);
            }
        }
        $data['show_donor_phone']== 1 ?: $data['donor_phone_required']=0;
        $data['show_donor_name']== 1 ?: $data['donor_name_required']=0;
        $data['show_donation_comment']== 1 ?: $data['donation_comment']=null;

        $project->update(
            collect($data)->except($this->relations)->toArray()
        );
        return $project;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
