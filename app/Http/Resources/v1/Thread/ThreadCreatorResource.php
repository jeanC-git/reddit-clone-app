<?php

namespace App\Http\Resources\v1\Thread;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadCreatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'last_name' => $this->last_name,
        ];
    }
}
