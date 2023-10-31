<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public $table = "user_roles";

    protected $fillable = [
        'user_id',
        'role_id',


    ];
}
