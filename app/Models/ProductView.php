<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    protected $fillable = ['product_id', 'session_id', 'ip_address', 'viewed_date'];

    protected $casts = [
        'viewed_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
