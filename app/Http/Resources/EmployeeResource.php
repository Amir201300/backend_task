<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'manger_name' => $this->manger_name,
            'type' => (int)$this->type,
            'salary' => priceFormat($this->salary),
            'image' => getImageUrl('Employee',$this->image),
            'department'=>new DepartmentResource($this->department),
            'token' => $this->my_token,
        ];
    }
}
