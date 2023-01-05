<?php

namespace App\Http\Traits;

use App\Models\Tag;
use Illuminate\Http\Request;

trait TagTrait
{
    public function syncTags(Request $request)
    {
        $allTagIds = array();
        if ($request->has('tags')) {
            foreach ($request->tags as $tagId) {
                if (substr($tagId, 0, 4) == 'new:') {
                    $newTag = Tag::create(['tag_name' => substr($tagId, 4)]);
                    $allTagIds[] = $newTag->id;
                    continue;
                }
                $allTagIds[] = (int)$tagId;
            }
        }
        return $allTagIds;
    }
}
