<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory; 

    protected $table="fields";
    protected $fillable = [
        'label',
        'field_name',
        'type',
        'value',
    ];
}
