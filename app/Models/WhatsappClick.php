<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappClick extends Model
{
    protected $fillable = [
        'product_id', 'product_name', 'referrer_page', 'session_id', 'ip_address',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
