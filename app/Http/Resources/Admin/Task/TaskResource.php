<?php

namespace App\Http\Resources\Admin\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'status' => $this->status,
            'amount' => $this->amount,
            'delivery_date' => $this->delivery_date,
            'link' => $this->link,
            'description' => $this->description,
            'report' => $this->report,
            'customer' => $this->customer->username
        ];
    }
}
