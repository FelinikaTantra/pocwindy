<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'status', 'meta_title', 'meta_description'];

    public function blocks()
    {
        return $this->hasMany(PageBlock::class)->orderBy('order_index');
    }
}
