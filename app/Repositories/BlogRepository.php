<?php


namespace App\Repositories;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Blog\BlogShowAllResource;
use App\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Pipeline\Pipeline;




class BlogRepository extends BaseController implements BlogInterface 
{
    public function show($request,$getOnlyColumn,$returnCollection) {

        
    }
    public function store($data,$returnColumn) {

        try {
            $create = Blog::create($data);

            if($create) {
                
                $reformatUpdate =  $this->resourceFormat($returnColumn,$create);
                return $this->handleQueryArrayResponse($reformatUpdate,'insert blog Success');
    
            } else {
    
                return $this->handleQueryErrorArrayResponse($create,'insert blog fail');
            }
      
        } catch (\Exception $e) {
        
            return $this->handleQueryErrorArrayResponse($e->getMessage(),'error when store blog');
        }
     

    }
    public function update($id,$data,$returnColumn) {
        
        try {
            $update  =  Blog::find($id);

            if($update) {

            $update->update($data);
            
            $refotmatData =  $this->resourceFormat($returnColumn,$update);

            return $this->handleQueryArrayResponse($refotmatData,'update blog success');

            } else {

                return $this->handleQueryErrorArrayResponse($update,'updates fail - blog id not found');
                
            }
        } 
        catch (\Exception $e) {
            return $this->handleQueryErrorArrayResponse($e->getMessage(),'error when update blog');
        }
      

    }
    public function destroy($id) {

       
    }
    private  function resourceFormat($returnCollection,$data) {

        if($returnCollection == 'show_all') //faq service & experience
        {   
            return new BlogShowAllResource([
                'data' => $data,
                'status' => true
            ]);
        }
       
       
    }
   
}