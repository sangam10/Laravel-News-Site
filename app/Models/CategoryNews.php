<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasFactory;

    protected $table = 'category_news';
    protected $fillable = ['category_id', 'news_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
