<?php

namespace App\Services;

use App\Interface\CareerInterface;
use App\Models\Career;


class CareerServices implements CareerInterface
{
    private $career;

    public function __construct(Career $career)
    {
        $this->career = $career;
    }

    public function index()
    {
        $careers = $this->career->paginate();
        return $careers;
    }

    public function show($career_id)
    {
        $career = $this->career->findOrFail($career_id);
        return $career;
    }

    public function edit($career_id)
    {
        $careers = $this->career->findOrFail($career_id);
        return $careers;
    }

    public function store($request)
    {
        $career = $this->career->create($request);
        return true;
    }

    public function update($request, $career_id)
    {
        $career = $this->career->findOrFail($career_id);
        $career->update($request);
        return true;
    }

    public function destroy($career_id)
    {
        $this->career->findOrFail($career_id)->delete();
        return true;
    }

}
