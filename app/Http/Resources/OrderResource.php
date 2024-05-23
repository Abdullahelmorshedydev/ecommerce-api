<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'address' => $this->address,
            'notes' => $this->notes,
            'status' => $this->status->lang(),
            'payment_method' => $this->payment_method->lang(),
            'discount' => $this->discount,
            'total' => $this->total,
            'items' => $this->orderItems,
        ];
    }
}
