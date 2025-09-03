<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Penjualan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <style>
        /* Custom animations */
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .nav-animate { animation: slideDown 0.3s ease-out; }
        
        .nav-item-hover {
            transition: all 0.2s ease;
            position: relative;
        }
        
        .nav-item-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -8px;
            left: 50%;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-item-hover:hover::after {
            width: 100%;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(79, 70, 229, 0.3));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    <nav class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50 nav-animate border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 logo-glow">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                SalesManager
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-1">
                        <!-- Primary CTA Button -->
                        <a href="{{ route('pos.index') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl mr-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>TRANSAKSI BARU</span>
                            </div>
                        </a>

                        <!-- Navigation Links -->
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            Produk
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            Kategori
                        </a>
                        <a href="{{ route('customers.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            Pelanggan
                        </a>
                        <a href="{{ route('sales.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            Riwayat Penjualan
                        </a>
                        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-lg text-sm font-medium nav-item-hover hover:bg-indigo-50 transition-colors">
                            User
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button (you can add mobile functionality later) -->
                <div class="md:hidden">
                    <button class="text-gray-600 hover:text-gray-900 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="transition-all duration-300">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    @livewireScripts
</body>
</html>