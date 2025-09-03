<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'user'])->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        // Tampilkan form untuk transaksi penjualan baru
    }

    public function store(Request $request)
    {
        // Logika kompleks untuk menyimpan transaksi penjualan
        // Termasuk validasi, kalkulasi, dan menyimpan ke sale_details
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleDetails.product']);
        return view('sales.show', compact('sale'));
    }
}