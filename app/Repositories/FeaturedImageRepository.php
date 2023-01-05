<?php

namespace App\Repositories;

use App\Interfaces\FeaturedImageInterface;
use App\Models\FeaturedImage;

class FeaturedImageRepository extends BaseRepository implements FeaturedImageInterface
{
    public function __construct(FeaturedImage $featuredImage)
    {
        parent::__construct($featuredImage);
    }
}
