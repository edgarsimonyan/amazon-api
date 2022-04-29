<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'size_id',
        'product_id'
    ];

}
