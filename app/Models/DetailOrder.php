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
<<<<<<< HEAD
        return $this->belongsTo(Order::class); // Relasi ke Order induk
=======
        return $this->belongsTo(Order::class);
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
    }

    public function tiket()
    {
<<<<<<< HEAD
        return $this->belongsTo(Tiket::class); // Relasi ke Tiket yang dibeli
=======
        return $this->belongsTo(Tiket::class);
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
    }
}
