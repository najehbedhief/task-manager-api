<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'Date' => $this->created_at->format('Y-m-d'),
            'profile'=>new ProfileResource($this->whenLoaded('profile'))
        ];
    }
}
