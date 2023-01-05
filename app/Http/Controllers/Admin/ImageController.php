<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageInterface;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $imageInterface;
    public function __construct(ImageInterface $imageInterface)
    {
        $this->imageInterface = $imageInterface;
    }
    public function index()
    {
        $images = $this->imageInterface->all();
        return view('admin.setting.media.media-setting', compact('images'));
    }
    public function store(Request $request)
    {
        $request->validate(['images' => 'required', 'array', 'image', 'mimes:png,jpg,jpeg,gif']);
        try {
            foreach ($request->images as $image) {
                $image_name = $this->imageInterface->upload($image);
                $this->imageInterface->create(['image_name' => $image_name]);
            }
            return back()->with('success', 'Upload Successfull !!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something wrong! Failed to upload');
        }
    }
    public function destroy($id)
    {
        try {
            $image = $this->imageInterface->findById($id);
            $path = public_path('storage/images') . '/' . $image->image_name;
            $is_unlinked = $this->imageInterface->unlinkImage($path);
            $this->imageInterface->delete($id);
            return back()->with('success', 'Delete Successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete!');
        }
    }
}
