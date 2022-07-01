<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            // 'type'=>'data',
            'id' => (string) $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'email' => $this->email,
            // 'password' => $this->password,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at' => $this->updated_at->format('M d Y'),
            
           
        ];
    }
}
