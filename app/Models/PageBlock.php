<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    protected $fillable = ['page_id', 'type', 'order_index', 'settings'];

    protected $casts = [
        'settings' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
