<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function imageListing(Request $request)
    {
        $imageListing = view('admin.setting.media.components.image-listing', [
            'images' => $this->imageInterface->all()
        ])->render();
    }
    public function getImage($id)
    {
        $image = Image::findOrFail($id);
        if ($image instanceof Image)
            return response($image, 200);
        return response('not found', 404);
    }
    public function getCategory(Request $request)
    {
        $request->validate([
            'categories_id' => 'required'
        ]);
        $arrayIds = explode(',', $request->categories_id);
        $categories = array_map(function ($id) {
            return Category::findOrFail($id);
        }, $arrayIds);
        return response()->json($categories, 200);
    }
}
