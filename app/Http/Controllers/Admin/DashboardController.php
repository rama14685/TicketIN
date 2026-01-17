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
        $totalOrders = \App\Models\Order::count(); // Total orders dari checkout

        // Revenue calculation dari Transaksi
        $transaksiRevenue = Transaksi::sum(DB::raw('jumlah * (SELECT harga FROM tikets WHERE tikets.id = transaksis.tiket_id)'));
        
        // Revenue calculation dari Orders
        $ordersRevenue = \App\Models\Order::sum('total_harga');
        
        // Total Revenue gabungan
        $totalRevenue = ($transaksiRevenue ?? 0) + ($ordersRevenue ?? 0);

        // Recent transactions
        $recentTransactions = Transaksi::with(['user', 'tiket.event'])
            ->latest()
            ->take(5)
            ->get();

        // Recent orders dari checkout
        $recentOrders = \App\Models\Order::with(['user', 'details.tiket.event'])
            ->latest('order_date')
            ->take(5)
            ->get();

        // Events with most tickets sold (gabungan dari Transaksi dan Orders)
        $popularEvents = Event::select('events.id', 'events.judul', 'events.gambar')
            ->selectRaw('COALESCE(SUM(transaksis.jumlah), 0) + COALESCE(SUM(detail_orders.jumlah), 0) as tickets_sold')
            ->leftJoin('tikets', 'events.id', '=', 'tikets.event_id')
            ->leftJoin('transaksis', 'tikets.id', '=', 'transaksis.tiket_id')
            ->leftJoin('detail_orders', 'tikets.id', '=', 'detail_orders.tiket_id')
            ->groupBy('events.id', 'events.judul', 'events.gambar')
            ->orderBy('tickets_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvent',
            'totalKategori',
            'totalTiket',
            'totalTransaksi',
            'totalOrders',
            'totalRevenue',
            'recentTransactions',
            'recentOrders',
            'popularEvents'
        ));
    }
}
