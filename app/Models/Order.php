<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'total_harga',
        'order_date'
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke User yang membuat order
    }

    public function details()
    {
        return $this->hasMany(DetailOrder::class); // Relasi ke DetailOrder (item-item dalam order)
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
