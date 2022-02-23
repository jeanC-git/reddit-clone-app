<?php

namespace App\Http\Resources\v1\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'slug' => $this->slug,
            'title' => $this->title,
            'text' => Str::limit($this->text, 150, ''),
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,

            'creator_username' => $this->creator->username,
            'category' => strtoupper($this->category->name),

            'comments_count' => $this->comments_count ?? 0,
            'last_updated' => $this->updated_at->longAbsoluteDiffForHumans(),
        ];

        if (in_array('my-posts', $request->segments()))
            $data['creator'] = new PostCreatorResource($this->creator);

        return $data;
    }


}
