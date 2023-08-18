<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogShowAllResource extends JsonResource
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
            'id'                   => $this->resource['data']->id,
            'cover'                => $this->resource['data']->cover,
            'title'                => $this->resource['data']->title,
            'short_desc'           => $this->resource['data']->short_desc,
            'long_desc'            => $this->resource['data']->long_desc,
            'embed_map'            => $this->resource['data']->embed_map,
             
        ];
    }
}
