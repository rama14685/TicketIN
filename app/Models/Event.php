<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lokasi',
        'tanggal_waktu',
        'gambar'
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    public function kategori()
    {
<<<<<<< HEAD
        return $this->belongsTo(Kategori::class); // Relasi Eloquent: Event belongs to Kategori (event-category)
=======
        return $this->belongsTo(Kategori::class);
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tikets()
    {
<<<<<<< HEAD
        return $this->hasMany(Tiket::class); // Relasi Eloquent: Event has many Tikets (event-ticket)
=======
        return $this->hasMany(Tiket::class);
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function transaksis()
    {
        return $this->hasManyThrough(Transaksi::class, Tiket::class);
    }
}
