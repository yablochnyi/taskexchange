<?php

namespace App\Http\Resources\Admin\Post;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'author' => ['first_name' => $this->author->first_name, 'last_name' => $this->author->first_name],
            'image' => $this->image,
            'title' => $this->title,
            'category' => $this->category,
        ];
    }
}
