<?php

namespace App\PipelineFilters\BlogPipeline;

use Closure;

class GetByKey
{

  public function handle($query, Closure $next)
  { 

      if (request()->has('slug') && request()->get('slug'))
      {
          $query->where('slug', request()->get('slug'));
      }

      if (request()->has('category_id') && request()->get('category_id'))
      {   
          $query->where('fk_category', request()->get('category_id'));
      }

      if (request()->has('hot_news') && request()->get('hot_news'))
      {   
          $query->where('hot_news', request()->get('hot_news'));
      }
      
    return $next($query);
  }
}