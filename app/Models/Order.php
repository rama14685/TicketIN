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
<<<<<<< HEAD
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
=======
        return $this->belongsTo(User::class);
    }

    public function details()
{
    return $this->hasMany(DetailOrder::class);
}

public function event()
{
    return $this->belongsTo(Event::class);
}
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810

}
