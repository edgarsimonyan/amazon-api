<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_name",
        "parent_id",
    ];

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id','id')->with('subCategories');
    }
}
