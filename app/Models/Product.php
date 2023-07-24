<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id', 'name', 'description', 'status'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
