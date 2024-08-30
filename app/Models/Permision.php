<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permision extends Model
{
    use HasFactory;
    protected $table='permisions';
    protected $fillable = [
        'name',
        'slug',

    ];
    public function roles(){
        return $this->belongsToMany(Role::class,'roles_permision');
    }
}
