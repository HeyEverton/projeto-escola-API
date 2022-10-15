<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'email' => (string)$this->email,
            'role' => $this->role,
            // 'confirmation_token' => $this->confirmation_token,
            'profile_photo' => $this->profile_photo,
            'created_at' => (string)$this->created_at,
        ];
    }
}
