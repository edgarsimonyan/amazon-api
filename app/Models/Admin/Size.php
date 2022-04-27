<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table='sizes';
    protected $fillable = [
        "size"
    ];
    public function products()
    {
        return $this->belongsToMany(Size::class,'product_colors');
    }
}
