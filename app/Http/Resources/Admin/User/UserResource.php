<?php

namespace App\Http\Resources\Admin\User;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'balance' => $this->balance,
            'last_online' => $this->last_online->diffForHumans(),
            'online' => Cache::has('is_online' . $this->id)
        ];
    }
}
