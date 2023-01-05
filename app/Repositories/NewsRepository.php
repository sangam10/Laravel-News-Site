<?php

namespace App\Repositories;

use App\Interfaces\NewsInterface;
use App\Models\News;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository implements NewsInterface
{
    public function __construct(News $news)
    {
        parent::__construct($news);
    }
    
    public function top_trending($paginate)
    {
        return News::where('is_trending_news', false)->paginate($paginate);
    }
    public function news_featured_image_name($id)
    {
        return News::findOrFail($id)->featured_image_name;
    }
    public function main_trending()
    {
        return News::first();
    }
    public function politics_news($paginate)
    {
    }
    public function sports_news($paginate)
    {
    }
}
