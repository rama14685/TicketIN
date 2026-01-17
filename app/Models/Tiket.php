<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = [
        'event_id',
        'tipe',
        'harga',
        'stok',
    ];

    public function event()
    {
<<<<<<< HEAD
        return $this->belongsTo(Event::class); // Relasi Eloquent: Tiket belongs to Event (ticket-event)
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class); // Relasi ke DetailOrder dari checkout cart
    }
=======
        return $this->belongsTo(Event::class);
    }
    public function transaksis()
{
    return $this->hasMany(Transaksi::class);
}

>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
}
