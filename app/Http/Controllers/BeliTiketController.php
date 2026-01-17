<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class BeliTiketController extends Controller
{
    public function store(Request $request, Tiket $tiket)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

<<<<<<< HEAD
        // Validasi kuota: Cek apakah stok tiket mencukupi sebelum transaksi
=======
        // Cek stok
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
        if ($tiket->stok < $request->jumlah) {
            return back()->with('error', 'Stok tiket tidak mencukupi');
        }

        DB::transaction(function () use ($tiket, $request) {
<<<<<<< HEAD
            // Validasi kuota lagi di dalam transaksi untuk thread safety
=======
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
            if ($tiket->stok < $request->jumlah) {
                throw new \Exception('Stok tiket tidak mencukupi');
            }

<<<<<<< HEAD
            // Simpan data transaksi menggunakan Eloquent
=======
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
            Transaksi::create([
                'user_id' => Auth::id(),
                'tiket_id' => $tiket->id,
                'jumlah' => $request->jumlah,
                'total_harga' => $tiket->harga * $request->jumlah
            ]);

<<<<<<< HEAD
            // Update stok tiket
=======
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
            $tiket->decrement('stok', $request->jumlah);
        });

        return back()->with('success', 'Tiket berhasil dibeli 🎉');
    }
}
