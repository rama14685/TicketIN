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

        // Cek stok
        if ($tiket->stok < $request->jumlah) {
            return back()->with('error', 'Stok tiket tidak mencukupi');
        }

        DB::transaction(function () use ($tiket, $request) {
            if ($tiket->stok < $request->jumlah) {
                throw new \Exception('Stok tiket tidak mencukupi');
            }

            Transaksi::create([
                'user_id' => Auth::id(),
                'tiket_id' => $tiket->id,
                'jumlah' => $request->jumlah,
                'total_harga' => $tiket->harga * $request->jumlah
            ]);

            $tiket->decrement('stok', $request->jumlah);
        });

        return back()->with('success', 'Tiket berhasil dibeli 🎉');
    }
}
