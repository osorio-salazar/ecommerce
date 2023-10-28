<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $table ="categories";

    public function productos()
    {
        return $this->hasMany(Producto::class, 'category_id');
    }
}
