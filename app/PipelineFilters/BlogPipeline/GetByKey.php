<?php

namespace App\PipelineFilters\BlogPipeline;

use Closure;

class GetByKey
{

  public function handle($query, Closure $next)
  { 

      if (request()->has('by_id') && request()->get('by_id'))
      {
          $query->where('id', request()->get('by_id'));
      }
      if (request()->has('slug') && request()->get('slug'))
      {
          $query->where('slug', request()->get('slug'));
      }
      
    return $next($query);
  }
}