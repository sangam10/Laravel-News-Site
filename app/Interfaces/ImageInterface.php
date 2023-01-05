<?php

namespace App\Interfaces;


interface ImageInterface
{
    public function upload($file);
    public function unlinkImage($path);
    public function image_by_name($image_name);
}
