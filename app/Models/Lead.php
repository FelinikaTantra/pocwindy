<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'whatsapp', 'product_id', 'product_name',
        'source', 'status', 'referrer_page', 'notes', 'contacted_at',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
    ];

    public const STATUSES = [
        'new'         => ['label' => 'New Lead',    'color' => 'blue'],
        'contacted'   => ['label' => 'Contacted',   'color' => 'yellow'],
        'negotiation' => ['label' => 'Negotiation', 'color' => 'purple'],
        'deal'        => ['label' => 'Deal',         'color' => 'green'],
        'lost'        => ['label' => 'Lost',         'color' => 'red'],
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status]['label'] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUSES[$this->status]['color'] ?? 'gray';
    }

    /**
     * Format WA number to wa.me link
     */
    public function getWaLinkAttribute(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }
        $productLabel = $this->product_name ?? 'produk Anda';
        $message = urlencode("Halo Kak {$this->name}, kemarin sempat melihat katalog kami. Ada pertanyaan tentang {$productLabel}?");
        return "https://wa.me/{$number}?text={$message}";
    }
}
