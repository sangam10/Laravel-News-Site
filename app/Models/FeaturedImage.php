<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    use HasFactory;
    protected $table = 'featured_images';
    protected $fillable = [
        'image_id',
        'news_id',
    ];

}
