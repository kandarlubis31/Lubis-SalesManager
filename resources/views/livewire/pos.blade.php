<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-7">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari produk berdasarkan nama atau kode..." class="w-full px-4 py-2 border rounded-lg">
                <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto">
                    @forelse ($products as $product)
                        <div wire:click="addToCart({{ $product->id }})" class="border rounded-lg p-2 cursor-pointer hover:bg-gray-100 flex flex-col items-center text-center">
                            <span class="font-semibold text-sm">{{ $product->name }}</span>
                            <span class="text-xs text-gray-600">Rp {{ number_format($product->price) }}</span>
                            <span class="text-xs text-blue-500">Stok: {{ $product->stock }}</span>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-4">
                            Produk tidak ditemukan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-span-5">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Keranjang</h2>
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="max-h-60 overflow-y-auto">
                    @forelse($cart as $productId => $item)
                    <div class="flex justify-between items-center mb-2 border-b pb-2">
                        <span class="text-sm">{{ $item['name'] }}</span>
                        <div class="flex items-center">
                            <input type="number" wire:model.live="cart.{{ $productId }}.quantity" wire:change="updateCartQuantity({{ $productId }}, $event.target.value)" class="w-16 text-center border rounded-md p-1">
                            <span class="text-sm mx-2">x {{ number_format($item['price']) }}</span>
                            <button wire:click="removeFromCart({{ $productId }})" class="text-red-500 hover:text-red-700">X</button>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500">Keranjang kosong.</p>
                    @endforelse
                </div>
                <div class="mt-4 pt-4 border-t">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal) }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span>Diskon</span>
                        <div class="flex items-center">
                           <input wire:model.live="discount_percentage" type="number" class="w-20 text-right border rounded-md p-1">
                           <span class="ml-2 font-semibold">%</span>
                        </div>
                    </div>
                    <div class="flex justify-between font-bold text-lg mt-2">
                        <span>Grand Total</span>
                        <span>Rp {{ number_format($grand_total) }}</span>
                    </div>
                </div>
                <div class="mt-4 border-t pt-4">
                    <div class="mb-4">
                        <label class="block">Pelanggan (Opsional)</label>
                        <select wire:model="customer_id" class="w-full border rounded-md p-2">
                            <option value="">-- Pelanggan Umum --</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block">Metode Bayar</label>
                        <select wire:model.live="payment_method" class="w-full border rounded-md p-2">
                            <option value="cash">Tunai (Cash)</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    @if($payment_method !== 'qris')
                        <div class="mb-4">
                            <label class="block">Jumlah Bayar</label>
                            <input wire:model.live="paid_amount" type="number" class="w-full border rounded-md p-2">
                             @error('paid_amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Kembalian</span>
                            <span>Rp {{ number_format($change_amount > 0 ? $change_amount : 0) }}</span>
                        </div>
                        <button wire:click.prevent="saveTransaction" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg mt-4 hover:bg-indigo-700" @if(empty($cart)) disabled @endif>
                            SIMPAN TRANSAKSI
                        </button>
                    @else
                        <div class="mb-4">
                             <p class="text-center text-gray-600">Total yang harus dibayar: <strong>Rp {{ number_format($grand_total) }}</strong></p>
                        </div>
                        <button wire:click.prevent="generateQrCode" class="w-full bg-sky-500 text-white font-bold py-2 px-4 rounded-lg mt-4 hover:bg-sky-600" @if(empty($cart)) disabled @endif>
                            BUAT KODE QRIS
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($showQrModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl text-center">
            <h2 class="text-2xl font-bold mb-2">Scan untuk Membayar</h2>
            <p class="mb-4">Invoice: {{ $invoiceNumberForQr }}</p>
            <div class="p-4 border rounded-md inline-block">
                {!! QrCode::size(250)->generate($qrCodeString) !!}
            </div>
            <p class="mt-4 font-bold text-2xl">Rp {{ number_format($grand_total) }}</p>
            <p class="text-gray-500 mt-2">Tunggu konfirmasi pembayaran dari pelanggan.</p>
            <button wire:click="processQrisPayment" class="mt-6 w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600">
                SAYA SUDAH BAYAR (SELESAIKAN TRANSAKSI)
            </button>
            <button wire:click="$set('showQrModal', false)" class="mt-2 text-sm text-gray-500 hover:text-gray-700">
                Batal
            </button>
        </div>
    </div>
    @endif
</div>