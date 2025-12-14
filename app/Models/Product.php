<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_materials')->withPivot('quantity_needed');
    }
}
