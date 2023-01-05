<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MenuTrait;
use App\Models\Category;
use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use MenuTrait;
    public function index()
    {
        // dd((new Menu())->active());
        try {
            return view('admin.setting.header.menu')->with([
                'categories' => Category::all(),
                'active_menu' => $this->activeMenu(1),
            ]);
        } catch (Exception $e) {
            return response('something wrong' . $e);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required'
        ]);
        $categories_id = $request->category_id;
        Menu::findOrFail(1)->update([
            'body' => implode(',', $categories_id)
        ]);
        return back()->with('success', 'successfully added');
    }
}
