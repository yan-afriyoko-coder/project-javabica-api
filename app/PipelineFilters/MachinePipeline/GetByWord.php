<?php

namespace App\PipelineFilters\MachinePipeline;

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
              $query->where('serial_number','like', '%' .$keyword.'%');
          });
          
        }
      
    }

    return $next($query);
  }
}
