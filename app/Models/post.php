<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table='posts';

    protected $fillable = [
        'title',
        'content',
        'summary',
        'published',
        'image',
    ];
    protected $appends = ['image_link'];

    public function getImageLinkAttribute()
    {
        if ($this->image) {
            return asset('/images/posts/' . $this->image);
        } else {
            return asset('/images/posts/default1.jpg');
        }
    }
    public function authors(){
        return $this->belongsToMany(Author::class, 'post_authors');
    }

    public function categories(){
        return $this->belongsToMany(category::class,'post_categories');
    }
}
