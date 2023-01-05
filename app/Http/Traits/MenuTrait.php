<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Models\Menu;

trait MenuTrait
{
    public function activeMenu($id = 1)
    {
        $menu = Menu::findOrFail($id);
        $arrayId = explode(',', $menu->body);
        $categories = array();
        foreach ($arrayId as $id) {
            if ($obj = Category::find($id)) {
                array_push($categories, $obj);
            }
        }
        return $categories;
    }
}
