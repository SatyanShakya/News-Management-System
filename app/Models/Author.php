<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\post;

class Author extends Model
{
    use HasFactory;
    protected $table='authors';

    protected $fillable = [
        'name',
        'description',
        'image',
        'published',
    ];
    public function posts(){
        return $this->belongsToMany(post::class,'post_authors');
    }
}
