<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pos extends Component
{
    public $search = '';
    public $cart = [];
    public $customers;
    public $customer_id = null;
    public $payment_method = 'cash';
    public $paid_amount = 0;

    public $subtotal = 0;
    public $discount_percentage = 0;
    public $discount = 0;
    public $grand_total = 0;
    public $change_amount = 0;

    public $showQrModal = false;
    public $qrCodeString = '';
    public $invoiceNumberForQr = '';

    protected $listeners = ['productAdded' => 'addToCart'];

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->calculateTotals();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product || $product->stock < 1) {
            session()->flash('error', 'Produk tidak ditemukan atau stok habis.');
            return;
        }

        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] < $product->stock) {
                $this->cart[$productId]['quantity']++;
            } else {
                session()->flash('error', 'Stok produk tidak mencukupi.');
            }
        } else {
            $this->cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        $this->calculateTotals();
    }

    public function updateCartQuantity($productId, $quantity)
    {
        $product = Product::find($productId);
        $quantity = (int)$quantity;
        if ($quantity > 0 && $quantity <= $product->stock) {
            $this->cart[$productId]['quantity'] = $quantity;
        } else {
            $this->cart[$productId]['quantity'] = 1;
            session()->flash('error', 'Kuantitas tidak valid atau melebihi stok.');
        }
        $this->calculateTotals();
    }
    
    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $this->discount = ($this->subtotal * (float)$this->discount_percentage) / 100;
        $this->grand_total = $this->subtotal - $this->discount;
        $this->updateChange();
    }

    public function updatedPaidAmount()
    {
        $this->updateChange();
    }

    public function updatedDiscountPercentage()
    {
        $this->discount_percentage = (float) $this->discount_percentage;
        if($this->discount_percentage > 100) $this->discount_percentage = 100;
        if($this->discount_percentage < 0) $this->discount_percentage = 0;
        $this->calculateTotals();
    }
    
    private function updateChange()
    {
        $paidAmount = (float) $this->paid_amount;
        $this->change_amount = $paidAmount > 0 ? $paidAmount - $this->grand_total : 0;
    }
    
    public function generateQrCode()
    {
        $this->validate([ 'cart' => 'required|array|min:1' ], [ 'cart.required' => 'Keranjang belanja tidak boleh kosong.' ]);
        
        $this->invoiceNumberForQr = 'INV-' . time();
        $this->qrCodeString = "Bayar Transaksi {$this->invoiceNumberForQr} sebesar Rp " . number_format($this->grand_total);
        $this->paid_amount = $this->grand_total;
        $this->showQrModal = true;
    }

    public function processQrisPayment()
    {
        $this->showQrModal = false;
        $this->saveTransaction();
    }

    public function saveTransaction()
    {
        if ($this->payment_method === 'qris') {
            $this->paid_amount = $this->grand_total;
        }

        $this->validate([
            'paid_amount' => 'required|numeric|min:' . $this->grand_total,
            'cart' => 'required|array|min:1'
        ], [
            'paid_amount.min' => 'Jumlah bayar tidak mencukupi.',
            'cart.required' => 'Keranjang belanja tidak boleh kosong.'
        ]);

        try {
            DB::transaction(function () {
                $sale = Sale::create([
                    'invoice_number' => $this->invoiceNumberForQr ?: 'INV-' . time() . '-' . Str::random(4),
                    'customer_id' => ($this->customer_id == '') ? null : $this->customer_id,
                    'user_id' => auth()->id(),
                    'total_amount' => $this->subtotal,
                    'discount' => $this->discount,
                    'grand_total' => $this->grand_total,
                    'payment_method' => $this->payment_method,
                    'paid_amount' => $this->paid_amount,
                    'change_amount' => $this->change_amount,
                    'sale_date' => now(),
                ]);

                foreach ($this->cart as $item) {
                    SaleDetail::create([
                        'sale_id' => $sale->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['price'] * $item['quantity'],
                    ]);
                    Product::find($item['product_id'])->decrement('stock', $item['quantity']);
                }
            });
            $this->resetCart();
            session()->flash('success', 'Transaksi berhasil disimpan.');
            return redirect()->to('/pos');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    private function resetCart()
    {
        $this->cart = [];
        $this->customer_id = null;
        $this->payment_method = 'cash';
        $this->paid_amount = 0;
        $this->discount_percentage = 0;
        $this->invoiceNumberForQr = '';
        $this->calculateTotals();
    }

    public function render()
    {
        $products = Product::where('stock', '>', 0)
            ->where(fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('code', 'like', "%{$this->search}%"))
            ->latest()
            ->take(10)
            ->get();
        return view('livewire.pos', compact('products'));
    }
}