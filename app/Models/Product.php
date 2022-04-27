<?php

namespace App\Models;

use App\Models\Admin\Color;
use App\Models\Admin\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'brand',
        'price',
        'category_status',
        'main',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'product_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class,'product_sizes');
    }


}
