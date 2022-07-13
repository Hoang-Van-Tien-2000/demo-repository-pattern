<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const INTERNAL_SERVER_ERROR = 500;
    const UNPROCESSABLE_ENTITY = 422; 
    
    protected $table = "products";
    
    protected $fillable = [
        'name', 'price', 
    ];

}