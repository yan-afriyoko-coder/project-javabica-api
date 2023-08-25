<?php


namespace App\Repositories;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Blog\BlogShowAllResource;
use App\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Pipeline\Pipeline;
use App\PipelineFilters\BlogPipeline\GetByKey;
use App\PipelineFilters\BlogPipeline\GetByWord;
use App\PipelineFilters\BlogPipeline\UseSort;



class BlogRepository extends BaseController implements BlogInterface 
{
    public function show($request,$getOnlyColumn,$collection='show_all') {
        try {
          
            $getData =  app(Pipeline::class)
                                ->send(Blog::query())
                                ->through([
                                    GetByKey::class,
                                    GetByWord::class,
                                    UseSort::class,
                                ])
                                ->thenReturn();
                            
                                if(request()->get('paginate') == true)
                                {
                                    $outputData            =  $getData->paginate(request()->get('per_page') ,$getOnlyColumn,'page',request()->get('page'));
                                    $getCollection         =  $outputData->getCollection();
                                }
                                else
                                {   
                                    $getCollection  =   $getData->limit(250)->get();
                                }
                                
                                $itemsTransformed = $getCollection
                                ->map(function($item) use($collection)  { 
                                    return $this->resourceFormat($collection,$item);
                                    
                                });

                                if (request()->has('sort_type')) { 
                                    $getData = $getData->orderBy('created_at', request()->get('sort_type'));
                                }

                                if (request()->has('category_id')) { 
                                    $getData->whereHas('fk_category', function ($query) {
                                        $query->where('taxonomy_slug', request()->get('category_id'));
                                    });
                                }

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

                                $message =   'get blog with paginate success';
                            }
                            else {
                            
                                $outputData =  $itemsTransformed;
                                if(count($getCollection) > 1 )
                                {
                                    $message =   'get blog data success without pagination max 250 data';
                                }
                                else
                                {
                                    $message =   'get blog data success';
                                }
                                
                        }
                                

            return $this->handleQueryArrayResponse($outputData,$message);

        } catch (\Exception $e) {

            return $this->handleQueryErrorArrayResponse($e->getMessage(),'error when get products');
        
        }
           
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