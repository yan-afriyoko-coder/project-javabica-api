<?php

namespace App\Http\Resources\MachineResource;

use Illuminate\Http\Resources\Json\JsonResource;

class MachineShowAllResource extends JsonResource
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
            'id'               => $this->resource['data']->id,
            'user_id'          => $this->resource['data']->user_id,
            'category_machine' => $this->resource['data']->category_machine,
            'purchase_date'    => $this->resource['data']->purchase_date,
            'description'      => $this->resource['data']->description,
        ];
    }
}
