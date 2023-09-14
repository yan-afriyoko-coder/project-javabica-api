<?php

namespace App\Http\Resources\VoucherResource;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherShowAllResource extends JsonResource
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
            'id'            => $this->resource['data']->id,
            'code'          => $this->resource['data']->code,
            'description'   => $this->resource['data']->description,
            'type'          => $this->resource['data']->type,
            'amount'        => $this->resource['data']->amount,
            'start_date'    => $this->resource['data']->start_date,
            'end_date'      => $this->resource['data']->end_date,
            'max_usage'     => $this->resource['data']->max_usage,
            'is_active'     => $this->resource['data']->is_active,
        ];
    }
}
