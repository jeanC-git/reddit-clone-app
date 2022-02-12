<?php

namespace App\Http\Resources\v1\Thread;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreaListResource extends JsonResource
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
//            'comments' => ThreadCommentsResource::collection($this->comments),

            'comments_count' => $this->comments_count ?? 0,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];

        if (!in_array('my-threads', $request->segments()))
            $data['creator'] = new ThreadCreatorResource($this->creator);

        return $data;
    }


}
