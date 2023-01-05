<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\ImageInterface;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageRepository extends BaseRepository implements ImageInterface
{
    public function __construct(Image $image)
    {
        parent::__construct($image);
    }
    public function upload($file)
    {
        $imageName = Str::random(10) . time() . '.' . $file->extension();
        $path = $file->storeAs('public/images', $imageName);
        return str_replace('public/images/', '', $path);
    }
    public function unlinkImage($path)
    {
        if (File::exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
    public function image_by_name($image_name)
    {
        return Image::where('image_name', $image_name)->first();
    }
}
