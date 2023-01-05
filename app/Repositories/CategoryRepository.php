<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Models\CategoryNews;
use App\Models\News;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function selectedCategories($newsId)
    {
        return News::findOrFail($newsId)->category_news;
    }
}
