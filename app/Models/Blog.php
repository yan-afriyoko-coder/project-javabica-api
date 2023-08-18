<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover',
        'title',
        'short_desc',
        'long_desc',
        'fk_category',
    ];

    public function fk_category()
    {
        return $this->belongsTo(Taxo_list::class, 'fk_category', 'id')->where('taxonomy_type',6);
    }
}
