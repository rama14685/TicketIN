<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function create(Event $event)
    {
        return view('admin.tiket.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'tipe' => 'required|in:reguler,premium',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
        ]);

        $event->tikets()->create($request->only(['tipe', 'harga', 'stok']));

        return redirect()
            ->route('admin.events.show', $event->id)
            ->with('success', 'Tiket berhasil ditambahkan');
    }

    public function edit(Tiket $tiket)
    {
        return view('admin.tiket.edit', compact('tiket'));
    }

    public function update(Request $request, Tiket $tiket)
    {
        $request->validate([
            'tipe' => 'required|in:reguler,premium',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
        ]);

        $tiket->update($request->only(['tipe', 'harga', 'stok']));

        return redirect()
            ->route('admin.events.show', $tiket->event_id)
            ->with('success', 'Tiket berhasil diperbarui');
    }

    public function destroy(Tiket $tiket)
    {
        $eventId = $tiket->event_id;
        $tiket->delete();
        return redirect()
            ->route('admin.events.show', $eventId)
            ->with('success', 'Tiket berhasil dihapus');
    }
}
