<?php

namespace App\PipelineFilters\BlogPipeline;

use Closure;

class GetByWord
{

  public function handle($query, Closure $next)
  {
    if (request()->has('keyword') )
    {
      
        $keyword = request()->get('keyword');

        if($keyword) {
          
          $query->where(function ($query)use ($keyword)  {
              $query->where('title','like', '%' .$keyword.'%');
          });
          
        }
      
    }

    return $next($query);
  }
}
