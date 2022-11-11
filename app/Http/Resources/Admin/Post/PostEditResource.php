<?php

namespace App\Http\Resources\Admin\Post;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostEditResource extends JsonResource
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
            'id' => $this->id,
            'image' => $this->image,
            'title' => $this->title,
            'text' => $this->text,
            'short' => $this->text,
            'category' => $this->category,
        ];
    }
}
