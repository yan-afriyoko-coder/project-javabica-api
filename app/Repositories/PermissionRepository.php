<?php


namespace App\Repositories;

use App\Http\Controllers\BaseController;
use App\Http\Resources\RolePermissionResource\PermissionsResource;
use App\Interfaces\PermissionInterface;
use Spatie\Permission\Models\Permission;

class  PermissionRepository extends BaseController implements PermissionInterface 
{
    public function show($request,$getOnlyColumn) {
       
        try {
                
            $getData =  Permission::select($getOnlyColumn);
                            if(request()->get('keywords') != null)
                            {  
                                $getData            =   $getData->where('name','like', '%' .request()->get('keywords').'%');
                               
                            }
                            if(request()->get('paginate') == true)
                            {
                                $outputData            =  $getData->paginate(request()->get('per_page') ,$getOnlyColumn,'page',request()->get('currentPage'));
                                $getCollection         =  $outputData->getCollection();
                            }
                            else
                            {   
                                $getCollection  =   $getData->limit(250)->get();
                            }
                            $itemsTransformed = $getCollection
                            ->map(function($item) { 

                                return new PermissionsResource([
                                    'data' => $item,
                                    'status' => true
                                ]);
                                  
                            });


                            if(count($getCollection) > 1 || request()->get('paginate') == true)
                            {
                                
                                $itemsTransformed =  $itemsTransformed->toArray();
                            }
                            else
                            {
                                $itemsTransformed =  $itemsTransformed->first();
                            }
                            
                            
                        if(request()->get('paginate') == true)
                        {
                            $outputData = new \Illuminate\Pagination\LengthAwarePaginator(
                                $itemsTransformed,
                                $outputData->total(),
                                $outputData->perPage(),
                                $outputData->currentPage(), [
                                    'path' => \Request::url(),
                                    'query' =>request()->all()
                                ]
                            );

                            $message =   'get permission with paginate success';
                        }
                        else {
                        
                            $outputData =  $itemsTransformed;
                            if(count($getCollection) > 1)
                            {
                                $message =   'get permission data success without pagination max 250 data';
                            }
                            else
                            {
                                $message =   'get permission data success';
                            }
                            
                        }
                        

             return $this->handleQueryArrayResponse($outputData,$message);

        } catch (\Exception $e) {

            return $this->handleQueryErrorArrayResponse($e->getMessage(),'show permission fail');
        }
        
    }
    public function store($data) {

     

    }
    public function update($id,$data) {
        
      

    }
    public function destroy($id) {

       
    }
   
}