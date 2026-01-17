<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    public function events()
    {
<<<<<<< HEAD
        return $this->hasMany(Event::class); // Relasi Eloquent: Kategori has many Events (category-event)
=======
        return $this->hasMany(Event::class);
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
    }
}
