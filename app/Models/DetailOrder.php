<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $fillable = [
        'order_id',
        'tiket_id',
        'jumlah',
        'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class); // Relasi ke Order induk
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class); // Relasi ke Tiket yang dibeli
    }
}
