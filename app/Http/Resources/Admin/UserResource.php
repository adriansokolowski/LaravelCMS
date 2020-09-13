<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role_id,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at->format('h:i d/m/Y'),
            'isNew' => ($this->created_at > Carbon::now()->subDays(1)) ? 1 : 0
        ];
    }
}
