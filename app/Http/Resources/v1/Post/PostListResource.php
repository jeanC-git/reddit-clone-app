<?php

namespace App\Http\Resources\v1\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'text' => $this->text,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,

            'comments_count' => $this->comments_count ?? 0,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];

        if (!in_array('my-posts', $request->segments()))
            $data['creator'] = new PostCreatorResource($this->creator);

        return $data;
    }


}
