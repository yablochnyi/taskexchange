<?php

namespace App\Http\Resources\Admin\Order;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'performer' => $this->offer->performer->username,
            'customer' => $this->task->customer->username,
            'task_id' => $this->task->id,
            'option' => $this->task->task_options->option->title,
            'status' => $this->status,
            'date' => Carbon::parse($this->created_at)->translatedFormat('d.m.Y в H:i'),
        ];
    }
}
