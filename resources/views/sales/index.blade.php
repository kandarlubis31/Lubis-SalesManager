@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Penjualan</h1>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">No. Invoice</th>
                <th class="py-2 px-4 border-b text-left">Tanggal</th>
                <th class="py-2 px-4 border-b text-left">Pelanggan</th>
                <th class="py-2 px-4 border-b text-left">Kasir</th>
                <th class="py-2 px-4 border-b text-right">Grand Total</th>
                <th class="py-2 px-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $sale->invoice_number }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y, H:i') }}</td>
                    <td class="py-2 px-4 border-b">{{ $sale->customer->name ?? 'Pelanggan Umum' }}</td>
                    <td class="py-2 px-4 border-b">{{ $sale->user->name ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b text-right">Rp {{ number_format($sale->grand_total, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="{{ route('sales.show', $sale->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600">DETAIL</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                        Belum ada riwayat penjualan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $sales->links() }}
    </div>
</div>
@endsection