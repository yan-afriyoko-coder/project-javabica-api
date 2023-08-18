<?php

namespace App\Http\Resources\ProductResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowThumbnailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource['data']->hasMany_image != null) {

            $image =  $this->resource['data']->hasMany_imageThumbnail->map(function ($query) {
               
                    return array(
                        'id'                   => $query->id,
                        'path'                 => $query->path,
                        'order_number'         => $query->order_number,
                    );
               
            });
        } else {

            $image = null;
        }
        //==
        if ($this->resource['data']->hasMany_category != null) {

            $category =  $this->resource['data']->hasMany_category->map(function ($query) {

                if ($query->fk_category != null) {
                    return array(
                        'id'                   => $query->fk_category->id,
                        'name'                 => $query->fk_category->taxonomy_name,
                        'slug'                 => $query->fk_category->taxonomy_slug,
                       
                    );
                } else {

                    return null;
                }
            });
        } else {

            $category = null;
        }
        //==
        if ($this->resource['data']->variant_active_or_inactive_cheapest_price != null) {

            $variant =  $this->resource['data']->variant_active_or_inactive_cheapest_price->map(function ($query) {

           
                if($query->discount == null || $query->discount <= 0)
                {
                    $price = array(
                        'purchase_price'      => $query->price,
                        'normal_price'        => $query->price,
                        'discount'            => null,
                        'discount_persentage' => null,
                        'discount_margin'     => null
                    );
                }
                else 
                {
                    //convert into persentage
                    $discount_margin     =  $query->price-$query->discount;
                    $getNominal          =  $query->price/$query->discount;
                    $getPersentage       =  100-(100/$getNominal);

                    $price = array(
                        'purchase_price'      => $query->discount,
                        'normal_price'        => $query->price,
                        'discount'            => $query->discount,
                        'discount_persentage' => round($getPersentage),
                        'discount_margin'     => $discount_margin
                    );
                }


                return array(
                    'id'                      => $query->id,
                    'sku'                     => $query->sku,                
                    'price'                   => $price,
                   
                );
            });
        } else {

            $variant = null;
        }
       
        return [
            'product'                 => [
                'id'                   => $this->resource['data']->id,
                'name'                 => $this->resource['data']->name,
                'slug'                 => $this->resource['data']->slug,
                'sort'                   =>   $this->resource['data']->sort,
            ],
            'image'                             => $image,
            'category'                          => $category,
            'variant_price'                     => $variant,
        ];
    }
}
