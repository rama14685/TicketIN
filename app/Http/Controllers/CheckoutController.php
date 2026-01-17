<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Dummy Checkout Process
     * Mengubah item dari cart menjadi order dan update stok tiket
     */
    public function store(Request $request)
    {
        // Validasi bahwa cart tidak kosong
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang Anda kosong');
        }

        try {
            // Mulai database transaction untuk memastikan data konsisten
            DB::transaction(function () use ($cart) {
                // Hitung total harga dari semua item di cart
                $totalHarga = 0;
                $eventId = null;

                foreach ($cart as $item) {
                    $totalHarga += $item['harga'] * $item['jumlah'];
                }

                // Ambil tiket pertama untuk mendapatkan event_id (jika semua dari event yang sama)
                if (!empty($cart)) {
                    $firstTiket = Tiket::find($cart[0]['tiket_id']);
                    if ($firstTiket) {
                        $eventId = $firstTiket->event_id;
                    }
                }

                // Simpan Order dengan event_id dari tiket pertama (atau null jika multiple events)
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'event_id' => $eventId, // Diisi dari tiket pertama, atau null jika checkout dari multiple events
                    'total_harga' => $totalHarga,
                    'order_date' => now(),
                ]);

                // Proses setiap item di cart
                foreach ($cart as $cartItem) {
                    // Ambil tiket berdasarkan ID
                    $tiket = Tiket::find($cartItem['tiket_id']);

                    if (!$tiket) {
                        throw new \Exception('Tiket tidak ditemukan');
                    }

                    // Validasi stok sebelum dikurangi
                    if ($tiket->stok < $cartItem['jumlah']) {
                        throw new \Exception('Stok tiket ' . $tiket->tipe . ' tidak mencukupi');
                    }

                    // Simpan DetailOrder (item order)
                    DetailOrder::create([
                        'order_id' => $order->id,
                        'tiket_id' => $tiket->id,
                        'jumlah' => $cartItem['jumlah'],
                        'subtotal' => $tiket->harga * $cartItem['jumlah'],
                    ]);

                    // Kurangi stok tiket
                    $tiket->decrement('stok', $cartItem['jumlah']);
                }

                // Kosongkan cart setelah berhasil checkout
                Session::forget('cart');
            });

            return redirect()->route('history')
                ->with('success', 'Checkout berhasil! Tiket telah dibeli dan dapat dilihat di riwayat pembelian.');
        } catch (\Exception $e) {
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
