<?php

namespace App\Services;

use App\Interface\ProjectStatusInterface;
use App\Models\ProjectStatus;


class ProjectStatusServices implements ProjectStatusInterface
{
    private $status;

    public function __construct(ProjectStatus $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        $statuses = $this->status->paginate();
        return $statuses;
    }


    public function edit($status_id)
    {
        $status = $this->status->findOrFail($status_id);
        return $status;
    }

    public function store($request)
    {
        $this->status->create($request);
        return true;
    }

    public function update($request, $status_id)
    {
        if (!isset($request['is_active']))
        {
            $request['is_active']=0;
        }
        if (!isset($request['is_completed']))
        {
            $request['is_completed']=0;
        }
        if (!isset($request['is_new']))
        {
            $request['is_new']=0;
        }
        $status = $this->status->findOrFail($status_id);
        $status->update($request);
        return true;
    }

    public function destroy($status_id)
    {
        $this->status->findOrFail($status_id)->delete();
        return true;
    }

}
