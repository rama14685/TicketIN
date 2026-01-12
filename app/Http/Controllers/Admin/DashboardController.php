<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use App\Models\Tiket;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic statistics
        $totalEvent = Event::count();
        $totalKategori = Kategori::count();
        $totalTiket = Tiket::count();
        $totalTransaksi = Transaksi::count();

        // Revenue calculation
        $totalRevenue = Transaksi::sum(DB::raw('jumlah * (SELECT harga FROM tikets WHERE tikets.id = transaksis.tiket_id)'));

        // Recent transactions
        $recentTransactions = Transaksi::with(['user', 'tiket.event'])
            ->latest()
            ->take(5)
            ->get();

        // Events with most tickets sold
        $popularEvents = Event::select('events.id', 'events.judul', 'events.gambar')
            ->selectRaw('COALESCE(SUM(transaksis.jumlah), 0) as tickets_sold')
            ->leftJoin('tikets', 'events.id', '=', 'tikets.event_id')
            ->leftJoin('transaksis', 'tikets.id', '=', 'transaksis.tiket_id')
            ->groupBy('events.id', 'events.judul', 'events.gambar')
            ->orderBy('tickets_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvent',
            'totalKategori',
            'totalTiket',
            'totalTransaksi',
            'totalRevenue',
            'recentTransactions',
            'popularEvents'
        ));
    }
}
