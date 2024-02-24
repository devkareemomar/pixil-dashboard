<?php

namespace App\Services;

use App\Interface\LinkInterface;
use App\Models\Link;


class LinkServices implements LinkInterface
{
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function index()
    {
        $links = $this->link->paginate();
        return $links;
    }


    public function edit($link_id)
    {
        $link = $this->link->findOrFail($link_id);
        return $link;
    }

    public function store($request)
    {
        $this->link->create($request);
        return true;
    }

    public function update($request, $link_id)
    {
        if (isset($request['is_project'])) {
            $request['url']=null;
        }else{
            $request['project_id']=null;
        }
        $link = $this->link->findOrFail($link_id);
        $link->update($request);
        return true;
    }

    public function destroy($link_id)
    {
        $this->link->findOrFail($link_id)->delete();
        return true;
    }

}
