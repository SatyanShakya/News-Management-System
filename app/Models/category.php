<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\post;


class category extends Model
{
    use HasFactory;


    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'published',
    ];

   public function posts(){
    return $this->belongsToMany(post::class,'post_categories');
   }
}
