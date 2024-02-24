<?php

namespace App\Services;

use App\Interface\HelpTypeInterface;
use App\Models\HelpType;


class HelpTypeServices implements HelpTypeInterface
{
    private $help;

    public function __construct(HelpType $help)
    {
        $this->help = $help;
    }

    public function index()
    {
        $helps = $this->help->paginate();
        return $helps;
    }


    public function edit($help_id)
    {
        $helps = $this->help->findOrFail($help_id);
        return $helps;
    }

    public function store($request)
    {
        $this->help->create($request);
        return true;
    }

    public function update($request, $help_id)
    {
        if (!isset($request['is_active']))
        {
            $request['is_active']=0;
        }
        $help = $this->help->findOrFail($help_id);
        $help->update($request);
        return true;
    }

    public function destroy($help_id)
    {
        $this->help->findOrFail($help_id)->delete();
        return true;
    }

}
