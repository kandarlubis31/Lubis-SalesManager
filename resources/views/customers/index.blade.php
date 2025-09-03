@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pelanggan</h1>
        <a href="{{ route('customers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Tambah Pelanggan
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Telepon</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->phone ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->email ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="flex items-center space-x-2">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm hover:bg-yellow-600">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                        Tidak ada data pelanggan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection