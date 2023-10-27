<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $table ="products";
    protected $fillable = [
        'name',	
        'description',
        'product_image',	
        'price',
        'category_id',
        'stock'
        
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}
