<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'message' => $this->message,
            'status' => $this->status,
            'delivered_at' => $this->delivered_at->diffForHumans(),
            'created_at' => $this->created_at->format('Y-m-d h:i A'),
        ];
    }
}
