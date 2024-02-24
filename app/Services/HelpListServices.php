<?php

namespace App\Services;

use App\Interface\HelpListInterface;
use App\Models\HelpList;


class HelpListServices implements HelpListInterface
{
    private $help;

    public function __construct(HelpList $help)
    {
        $this->help = $help;
    }

    public function index()
    {
        $helps = $this->help->paginate();
        return $helps;
    }

    public function show($help_id)
    {
        $help = $this->help->findOrFail($help_id);
        return $help;
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
