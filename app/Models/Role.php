<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permision;

class Role extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $fillable = [
        'name',
        'slug',

    ];

    public function users(){
        return $this->belongsToMany(User::class,'user_roles');
       }

    public function permissions(){
        return $this->belongsToMany(Permision::class,'roles_permision');
    }
}
