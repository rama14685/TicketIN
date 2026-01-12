<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request, Tiket $tiket)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);

        // Hitung jumlah tiket yang sudah ada di cart
        $existingQuantity = 0;
        foreach ($cart as $item) {
            if ($item['tiket_id'] == $tiket->id) {
                $existingQuantity = $item['jumlah'];
                break;
            }
        }

        // Cek total jumlah (existing + new) tidak melebihi stok
        $totalQuantity = $existingQuantity + $request->jumlah;
        if ($tiket->stok < $totalQuantity) {
            return back()->with('error', 'Stok tiket tidak mencukupi. Maksimal ' . ($tiket->stok - $existingQuantity) . ' tiket lagi.');
        }

        $cartItem = [
            'tiket_id' => $tiket->id,
            'jumlah' => $request->jumlah,
            'harga' => $tiket->harga,
            'nama' => $tiket->tipe,
            'event' => $tiket->event->judul,
            'lokasi' => $tiket->event->lokasi,
            'tanggal' => $tiket->event->tanggal_waktu,
        ];

        // Jika tiket sudah ada di cart, update jumlah
        $found = false;
        foreach ($cart as &$item) {
            if ($item['tiket_id'] == $tiket->id) {
                $item['jumlah'] += $request->jumlah;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = $cartItem;
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Tiket berhasil ditambahkan ke keranjang');
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function remove($index)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reindex array
            Session::put('cart', $cart);
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        Session::forget('cart');
        return back()->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function count()
    {
        $cart = Session::get('cart', []);
        return count($cart);
    }
}