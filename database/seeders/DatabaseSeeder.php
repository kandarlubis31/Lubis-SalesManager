<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        SaleDetail::truncate();
        Sale::truncate();
        Product::truncate();
        Category::truncate();
        Customer::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();

        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        $manajer = User::create([
            'name' => 'Manajer Penjualan',
            'email' => 'manajer@example.com',
            'password' => Hash::make('password'),
            'role' => 'manajer',
        ]);
        $kasir1 = User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir1@example.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        $pelanggan1 = Customer::create(['name' => 'Budi Santoso', 'phone' => '081234567890', 'email' => 'budi.s@example.com', 'address' => 'Jl. Merdeka No. 10, Jakarta']);
        $pelanggan2 = Customer::create(['name' => 'Ani Lestari', 'phone' => '087712345678', 'email' => 'ani.lestari@example.com', 'address' => 'Jl. Pahlawan No. 5, Bandung']);
        
        $catMakanan = Category::create(['name' => 'Makanan Ringan', 'description' => 'Berbagai macam makanan ringan dan cemilan.']);
        $catMinuman = Category::create(['name' => 'Minuman Dingin', 'description' => 'Minuman kemasan yang disajikan dingin.']);
        $catATK = Category::create(['name' => 'Alat Tulis Kantor', 'description' => 'Perlengkapan untuk kebutuhan kantor dan sekolah.']);

        $p1 = Product::create(['code' => 'P001', 'name' => 'Keripik Kentang Original', 'category_id' => $catMakanan->id, 'price' => 12500, 'stock' => 150, 'unit' => 'pcs']);
        $p2 = Product::create(['code' => 'P002', 'name' => 'Biskuit Coklat', 'category_id' => $catMakanan->id, 'price' => 7000, 'stock' => 200, 'unit' => 'pcs']);
        $p3 = Product::create(['code' => 'P003', 'name' => 'Teh Botol Kotak', 'category_id' => $catMinuman->id, 'price' => 3500, 'stock' => 300, 'unit' => 'btl']);
        $p4 = Product::create(['code' => 'P004', 'name' => 'Air Mineral 600ml', 'category_id' => $catMinuman->id, 'price' => 3000, 'stock' => 400, 'unit' => 'btl']);
        $p5 = Product::create(['code' => 'P005', 'name' => 'Pulpen Pilot G2', 'category_id' => $catATK->id, 'price' => 15000, 'stock' => 100, 'unit' => 'pcs']);

        $penjualan1 = Sale::create([
            'invoice_number' => 'INV-'.Carbon::now()->subDays(2)->format('Ymd').'-0001',
            'customer_id' => $pelanggan1->id,
            'user_id' => $kasir1->id,
            'total_amount' => 28500,
            'discount' => 0,
            'grand_total' => 28500,
            'paid_amount' => 30000,
            'change_amount' => 1500,
            'payment_method' => 'cash',
            'sale_date' => Carbon::now()->subDays(2),
        ]);

        SaleDetail::create(['sale_id' => $penjualan1->id, 'product_id' => $p1->id, 'quantity' => 2, 'price' => $p1->price, 'subtotal' => $p1->price * 2]);
        SaleDetail::create(['sale_id' => $penjualan1->id, 'product_id' => $p4->id, 'quantity' => 1, 'price' => $p4->price, 'subtotal' => $p4->price * 1]);

        $penjualan2 = Sale::create([
            'invoice_number' => 'INV-'.Carbon::now()->subDay()->format('Ymd').'-0001',
            'customer_id' => $pelanggan2->id,
            'user_id' => $kasir1->id,
            'total_amount' => 38500,
            'discount' => 3500,
            'grand_total' => 35000,
            'paid_amount' => 35000,
            'change_amount' => 0,
            'payment_method' => 'qris',
            'sale_date' => Carbon::now()->subDay(),
        ]);

        SaleDetail::create(['sale_id' => $penjualan2->id, 'product_id' => $p5->id, 'quantity' => 1, 'price' => $p5->price, 'subtotal' => $p5->price * 1]);
        SaleDetail::create(['sale_id' => $penjualan2->id, 'product_id' => $p2->id, 'quantity' => 2, 'price' => $p2->price, 'subtotal' => $p2->price * 2]);
        SaleDetail::create(['sale_id' => $penjualan2->id, 'product_id' => $p3->id, 'quantity' => 2, 'price' => $p3->price, 'subtotal' => $p3->price * 2]);
    }
}

