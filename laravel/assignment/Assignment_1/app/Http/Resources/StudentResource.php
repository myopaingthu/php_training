<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'major' => new MajorResource($this->major),
            'phone' => $this->phone,
            'address' => $this->address,
            'dob' => $this->dob,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
