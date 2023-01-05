<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['tag_name'];
    
    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}
