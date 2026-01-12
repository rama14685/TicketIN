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
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class);
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
