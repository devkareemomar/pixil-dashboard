<?php

namespace App\Models;

use App\Enums\ItemMenuType;
use App\Traits\Filter;
use App\Traits\Sort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MenuItem extends Model implements Auditable
{
    use HasFactory;
    use Sort;
    use Filter;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'menu_items';

    protected $fillable = [
        'name', 'menu_id', 'parent_id', 'label', 'type', 'link', 'custom_url', 'sort', 'icon','image', 'is_mega', 'page_id', 'type'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function scopePages($query)
    {
        $query->where('type', ItemMenuType::Page);
    }

    public function getsons($id)
    {
        return $this->where("parent_id", $id)->get();
    }

    public function getall($id)
    {
        return $this->where("menu_id", $id)->orderBy("sort", "ASC")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu_id', $menu)->max('sort') + 1;
    }

    //    public function parent_menu()
    //    {
    //        return $this->belongsTo(Menu::class, 'menu_id');
    //    }

    public function child()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort', 'ASC');
    }

    public function getLinkAttribute($value)
    {
        if($this->type == 'page') {
            $page = SitePage::find($this->page_id);
            return '/page/' . $page?->key;
        } elseif($this->type == 'project') {
            $project = Project::find($this->page_id);
            return '/projects/' . $project?->slug;
        } elseif($this->type == 'news') {
            $news = News::find($this->page_id);
            return '/news/' . $news?->slug;
        } elseif($this->type == 'form') {
            $form = FormBuilder::find($this->page_id);
            return '/forms/' . $form?->id;
        } else {
            return $value;
        }
    }
}
