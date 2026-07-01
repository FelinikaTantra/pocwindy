<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['page_url', 'session_id', 'ip_address', 'viewed_date'];

    protected $casts = [
        'viewed_date' => 'date',
    ];
}
