<?php

namespace App\Http\Resources\v1\Thread;

use App\Http\Resources\v1\Comment\CommentCreatorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'likes' =>$this->likes,
            'dislikes' =>$this->dislikes,
            'creator' => new CommentCreatorResource($this->creator),
            'replies_count' => $this->replies_count ?? 0,

            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
