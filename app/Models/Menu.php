<?php

namespace App\Models;

class Menu extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->with('child')->where('parent_id', 0)->orderBy('sort', 'ASC');
    }

    static public function selectHtml($name = "menu_id", $menulist = [])
        {
        $html = '<select  id="mySelect" onchange="submitForm()" name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu_id') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
