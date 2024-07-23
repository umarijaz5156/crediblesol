<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'reviews_count',
        'avg_rating',
        'positive_reviews_count',
        'negative_reviews_count',
            
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
