<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['kategori', 'tikets']);

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter berdasarkan search jika ada
        if ($request->has('search') && $request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $events = $query->latest()->get();
        $kategoris = \App\Models\Kategori::all();

        return view('events.index', compact('events', 'kategoris'));
    }

    public function show(Event $event)
    {
        $cart = session('cart', []);
        $cartItems = collect($cart)->pluck('jumlah', 'tiket_id')->toArray();

        // Calculate available stock considering cart items
        foreach ($event->tikets as $tiket) {
            $inCart = $cartItems[$tiket->id] ?? 0;
            $tiket->available_stok = max(0, $tiket->stok - $inCart);
        }

        return view('events.show', compact('event'));
    }

    public function history()
    {
        $transaksis = Transaksi::with(['tiket.event'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('history', compact('transaksis'));
    }
}
