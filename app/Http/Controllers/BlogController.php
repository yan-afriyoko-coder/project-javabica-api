<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest\CreateBlogRequest;
use App\Http\Requests\BlogRequest\UpdateBlogRequest;
use App\Interfaces\BlogInterface;

class BlogController extends BaseController
{
    private $blogInterface;
   
    
    public function __construct(BlogInterface $blogInterface)
    {
        $this->blogInterface            = $blogInterface;
     
    }
    public function show( $request) {

       
    }
    public function create(CreateBlogRequest $request) { 

        $insert = $this->blogInterface->store($request->all(),'show_all');
          
        if($insert['queryStatus']) {

            return $this->handleResponse( $insert['queryResponse'],'Insert blog  success',$request->all(),str_replace('/','.',$request->path()),201);
        }
        else {

            $data  = array([
                'field' =>'create-blog',
                'message'=> 'blog create fail'
            ]);

            return   $this->handleError($data,$insert['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
        }

        
    }
    public function update(UpdateBlogRequest $request) { //done
        
     
        $update = $this->blogInterface->update($request->id,$request->except(['id']),'show_all');
          
        if($update['queryStatus']) {

            return $this->handleResponse( $update['queryResponse'],'update blog  success',$request->all(),str_replace('/','.',$request->path()),201);
        }
        else {

            $data  = array([
                'field' =>'create-blog',
                'message'=> 'blog create fail'
            ]);

            return   $this->handleError($data,$update['queryMessage'],$request->all(),str_replace('/','.',$request->path()),422);
        }

    }

}
