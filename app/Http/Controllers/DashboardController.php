<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $saleCount = Sale::count();

        $pendapatanHariIni = Sale::whereDate('sale_date', today())->sum('grand_total');
        $transaksiHariIni = Sale::whereDate('sale_date', today())->count();

        $produkTerlaris = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
        
        return view('dashboard', [
            'productCount' => $productCount,
            'saleCount' => $saleCount,
            'pendapatanHariIni' => $pendapatanHariIni,
            'transaksiHariIni' => $transaksiHariIni,
            'produkTerlaris' => $produkTerlaris,
        ]);
    }
}