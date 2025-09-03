@extends('layouts.app')

@section('title', 'Detail Penjualan ' . $sale->invoice_number)

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
            <p class="text-gray-600">{{ $sale->invoice_number }}</p>
        </div>
        <a href="{{ route('sales.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Kembali ke Riwayat</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 border-b pb-6">
        <div>
            <h3 class="text-sm font-semibold text-gray-500">Tanggal</h3>
            <p class="text-gray-800">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d F Y, H:i:s') }}</p>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-500">Pelanggan</h3>
            <p class="text-gray-800">{{ $sale->customer->name ?? 'Pelanggan Umum' }}</p>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-500">Kasir</h3>
            <p class="text-gray-800">{{ $sale->user->name ?? 'N/A' }}</p>
        </div>
    </div>

    <div>
        <h2 class="text-lg font-bold text-gray-800 mb-4">Rincian Produk</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-2 px-4 text-left">No.</th>
                    <th class="py-2 px-4 text-left">Produk</th>
                    <th class="py-2 px-4 text-right">Harga Satuan</th>
                    <th class="py-2 px-4 text-center">Jumlah</th>
                    <th class="py-2 px-4 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleDetails as $index => $detail)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $detail->product->name ?? 'Produk Dihapus' }}</td>
                    <td class="py-2 px-4 border-b text-right">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $detail->quantity }}</td>
                    <td class="py-2 px-4 border-b text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-6">
        <div class="w-full md:w-1/3">
            <div class="flex justify-between py-2">
                <span class="text-gray-600">Subtotal</span>
                <span class="text-gray-800">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-gray-600">Diskon</span>
                <span class="text-gray-800">- Rp {{ number_format($sale->discount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2 font-bold border-t mt-2">
                <span class="text-lg">Grand Total</span>
                <span class="text-lg">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2 text-sm">
                <span class="text-gray-600">Metode Bayar</span>
                <span class="text-gray-800 capitalize">{{ $sale->payment_method }}</span>
            </div>
            <div class="flex justify-between py-2 text-sm">
                <span class="text-gray-600">Jumlah Bayar</span>
                <span class="text-gray-800">Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2 text-sm">
                <span class="text-gray-600">Kembalian</span>
                <span class="text-gray-800">Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection