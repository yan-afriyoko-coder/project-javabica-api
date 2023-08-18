<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingAddressRequest\ShippingAddressCreateRequest;
use App\Http\Requests\ShippingAddressRequest\ShippingAddressDestroyRequest;
use App\Http\Requests\ShippingAddressRequest\ShippingAddressGetRequest;
use App\Http\Requests\ShippingAddressRequest\ShippingAddressUpdateRequest;
use App\Interfaces\ShippingAddressInterface;
use App\Services\RajaOngkir\CityServices;
use Illuminate\Http\Request;

class ShippingAddressController extends BaseController
{
    private $shippingAddressInterface;
   
    
    public function __construct(ShippingAddressInterface $shippingAddressInterface)
    {
        $this->shippingAddressInterface            = $shippingAddressInterface;
     
    }
  
    public function show(ShippingAddressGetRequest $request) {

        $selectedColumn = array('*');

        $get = $this->shippingAddressInterface->show($request->all(),$selectedColumn);

        if($get['queryStatus']) {
            
            return $this->handleResponse( $get['queryResponse'],'get shipping address success',$request->all(),str_replace('/','.',$request->path()),201);
        }

        $data  = array([
            'field' =>'show-user',
            'message'=> 'error when show shipping address'
        ]);

        return   $this->handleError( $data,$get['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
    }
    public function create(ShippingAddressCreateRequest  $request,CityServices $cityService) {
        
        //calling raja ongkir to find label
        $payloadCity = array(
            'id'        => $request->city,
            'province_id' =>null
        );
        $getCity = $cityService->getCity($payloadCity);

        $request->merge([
            'city'           => $getCity['arrayResponse']['city_id'],
            'city_label'     => $getCity['arrayResponse']['city_name'],
            'province_label' => $getCity['arrayResponse']['province'],
            'province'       => $getCity['arrayResponse']['province_id']
        ]);
       
        $insert = $this->shippingAddressInterface->store($request->all(),'show_all');
        
        if($insert['queryStatus']) {

            return $this->handleResponse( $insert['queryResponse'],'Insert shipping address product success',$request->all(),str_replace('/','.',$request->path()),201);
        }
        else {

            $data  = array([
                'field' =>'create-shipping address-product',
                'message'=> 'shipping address product create fail'
            ]);

            return   $this->handleError($data,$insert['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
        }

    }

    public function destroy(ShippingAddressDestroyRequest  $request) {
        
         //remove data
         $destroyAdmin =   $this->shippingAddressInterface->destroy($request->by_id);

         if($destroyAdmin['queryStatus']) {
 
             //response
             $data  = array(
                 'field' =>'destroy-shipping address',
                 'message'=> 'shipping address successfuly destroyed'
             );
 
              return $this->handleResponse($data,'Destroy shipping address success',$request->all(),str_replace('/','.',$request->path()),204);
        
         } else {
             
             $data  = array([
                 'field' =>'destroy-shipping address',
                 'message'=> 'shipping address destroy fail'
             ]);
 
              return   $this->handleError($data,$destroyAdmin['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
         }


    }

    public function update(ShippingAddressUpdateRequest  $request,CityServices $cityService) {

         //calling raja ongkir to find label
         $payloadCity = array(
            'id'        => $request->city,
            'province_id' =>null
        );
        $getCity = $cityService->getCity($payloadCity);

        $request->merge([
            'city'           => $getCity['arrayResponse']['city_id'],
            'city_label'     => $getCity['arrayResponse']['city_name'],
            'province_label' => $getCity['arrayResponse']['province'],
            'province'       => $getCity['arrayResponse']['province_id']
        ]);

        $update = $this->shippingAddressInterface->update($request->id,$request->except(['id']),'show_all');

        if($update['queryStatus']) {


            return $this->handleResponse($update['queryResponse'],'Update shipping success',$request->all(),str_replace('/','.',$request->path()),201);
        }
        else {

            $data  = array([
                'field' =>'update-shipping',
                'message'=> 'shipping destroy fail'
            ]);

            return   $this->handleError($data,$update['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
        }

    }
}
