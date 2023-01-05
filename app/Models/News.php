<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'author_id',
        'is_published',
        'is_trending_news',
        'views_count',
        'featured_image_name'

    ];
    public function images()
    {
        return $this->hasMany(Image::class, 'news_id');
    }
    public function category_news()
    {
        return $this->hasMany(CategoryNews::class, 'news_id');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function is_featured_image()
    {
        if ($this->featured_image() instanceof Image) {
            return true;
        }
        return false;
    }
    public function featured_image()
    {
        if ($this->images != null)
            return $this->images->where('is_featured_image', true)->first();
        return '';
    }
    public function increment_views()
    {
        $this->views_count++;
        $this->save();
    }
}
