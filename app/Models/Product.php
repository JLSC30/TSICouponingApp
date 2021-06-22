<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku'
    ];

    public function product_name()
    {
        return $this->name;
    }

    /**
     * Get all of the coupon for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupon(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }
}
