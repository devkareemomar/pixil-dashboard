<?php

namespace App\Http\Controllers;

use App\Models\FormBuilder;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\News;
use App\Models\Page;
use App\Models\Project;
use App\Models\SitePage;

class MenuController extends Controller
{
    public function index()
    {
        $menu = new Menu();
        $menuitems = new MenuItem();
        $menulist = $menu->select(['id', 'name'])->get();
        $menulist = $menulist->pluck('name', 'id')->prepend('Select menu_id', 0)->all();
        $languages = Language::all();
        $pages = SitePage::all();
        $projects = Project::all();
        $news = News::all();
        $forms = FormBuilder::all();

        if ((request()->has("action") && empty(request()->input("menu_id"))) || request()->input("menu_id") == '0') {
            return view('menus.index')->with('menulist', $menulist)->with('languages', $languages);
        } else {

            $menu = Menu::find(request()->input("menu_id"));
            $menus = $menuitems->getall(request()->input("menu_id"));

            $data = [
                'menus' => $menus,
                'indmenu' => $menu,
                'menulist' => $menulist,
                'languages' => $languages,
                'pages' => $pages,
                'projects' => $projects,
                'news' => $news,
                'forms' => $forms
            ];

            return view('menus.index', $data);
        }

        return view('menus.index', compact('menulist', 'languages', 'pages'));
    }

    public function createnewmenu()
    {
        $menu = new Menu();
        $menu->name = request()->input("menuname");
        $menu->position = request()->input("position");
        $menu->is_active = request()->input("is_active");
        $menu->locale = request()->input("locale");

        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }

    public function deleteitemmenu()
    {
        $menuitem = MenuItem::find(request()->input("id"));

        $menuitem->delete();
    }

    public function deletemenug()
    {
        $menus = new MenuItem();
        $getall = $menus->getall(request()->input("id"));
        if (count($getall) == 0) {
            $menudelete = Menu::find(request()->input("id"));
            $menudelete->delete();

            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));
        }
    }

    public function updateitem()
    {
        $menuitem = MenuItem::find(request()->input("id"));
        if($menuitem) {
            $menuitem->label = request()->input("label");
            $menuitem->link = request()->input("url");
            $menuitem->class = request()->input("clases");
            if ($icon = $this->handleFileUpload('icon', 'icons')) {
                $menuitem->icon = $icon;
            }
            if ($image = $this->handleFileUpload('image', 'images')) {
                $menuitem->image = $image;
            }

            $menuitem->is_mega = request()->input("is_mega") ?? 0;
            $menuitem->save();
        }
    }

    public function addcustommenu()
    {
        $menuitem = new MenuItem();
        $menuitem->label = request()->input("labelmenu");
        $menuitem->link = request()->input("linkmenu");
        if ($icon = $this->handleFileUpload('icon', 'icons')) {
            $menuitem->icon = $icon;
        }
        if ($image = $this->handleFileUpload('image', 'images')) {
            $menuitem->image = $image;
        }
        $menuitem->is_mega = request()->input("is_mega") ?? 0;

        $menuitem->menu_id = request()->input("idmenu");
        $menuitem->sort = MenuItem::getNextSortRoot(request()->input("idmenu"));

        if(request()->input('type') == 'page') {
            $menuitem->page_id = request()->input("page_id");
            $menuitem->type = 'page';
        }
        if(request()->input('type') == 'project') {
            $menuitem->page_id = request()->input("project_id");
            $menuitem->type = 'project';
        }
        if(request()->input('type') == 'news') {
            $menuitem->page_id = request()->input("news_id");
            $menuitem->type = 'news';
        }
        if(request()->input('type') == 'form') {
            $menuitem->page_id = request()->input("form_id");
            $menuitem->type = 'form';
        }
        $menuitem->save();
    }

    public function generatemenucontrol()
    {
        $menu = Menu::find(request()->input("idmenu"));

        if ($menu) {
            $menu->name = request()->input("menuname");
            $menu->position = request()->input("position");
            $menu->is_active = request()->input("is_active");
            $menu->locale = request()->input("locale");
            $menu->save();
        }

        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {
                $menuitem = MenuItem::find($value["id"]);
                if($menuitem) {
                    $menuitem->parent_id = $value["parent_id"];
                    $menuitem->sort = $value["sort"];
                    $menuitem->depth = $value["depth"];

                    $menuitem->save();
                }
            }
        }
        echo json_encode(array("resp" => 1));
    }

    public function handleFileUpload($inputName, $storagePath)
    {
        if (request()->hasFile($inputName)) {
            return request()->file($inputName)->store($storagePath, 'public');
        }

        return null;
    }
}
