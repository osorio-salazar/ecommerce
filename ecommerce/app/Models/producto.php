<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    public $table ="producto";
    protected $fillable = array("*");

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
