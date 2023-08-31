<?php

namespace App\PipelineFilters\BlogCategoryPipeline;

use Closure;

class GetByKey
{

  public function handle($query, Closure $next)
  { 

      if (request()->has('by_id') && request()->get('by_id'))
      {
          $query->where('id', request()->get('by_id'));
      }

    return $next($query);
  }
}