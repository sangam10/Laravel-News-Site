<?php
namespace App\Repositories;

use App\Interfaces\CategoryNewsInterface;
use App\Models\CategoryNews;

class CategoryNewsRepository extends BaseRepository implements CategoryNewsInterface{
    public function __construct(CategoryNews $categoryNews)
    {
        parent::__construct($categoryNews);
    }
}