<nav x-data="{ open: false, cartCount: 0 }" x-init="cartCount = {{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold" style="color: #1B4332;">Warung <span style="color: #D4A373;">Aku</span></span>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-[#1B4332] transition-colors {{ request()->routeIs('home') ? 'text-[#1B4332]' : '' }}">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-[#1B4332] transition-colors {{ request()->routeIs('products.*') ? 'text-[#1B4332]' : '' }}">Produk</a>
                    <a href="{{ route('home') }}#tentang" class="text-sm font-medium text-gray-600 hover:text-[#1B4332] transition-colors">Tentang</a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-[#1B4332] transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                    <span x-text="cartCount" class="absolute -top-1 -right-1 bg-[#D4A373] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ session()->has('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
                </a>
                @auth
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium px-4 py-2 rounded-lg text-white transition-all duration-200" style="background-color: #1B4332; hover:background-color: #2D6A4F;">Dashboard</a>
                    </div>
                    <div class="hidden md:block relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-1 text-sm font-medium text-gray-600 hover:text-[#1B4332] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-1 z-50">
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Pesanan Saya</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden md:inline-flex text-sm font-medium text-gray-500 hover:text-[#1B4332] transition-colors">Masuk</a>
                @endauth
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden bg-white border-t shadow-lg">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Beranda</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Produk</a>
            <a href="{{ route('home') }}#tentang" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Tentang</a>
            @auth
                <hr class="my-2 border-gray-100">
                <a href="{{ route('orders.index') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Pesanan Saya</a>
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors">Edit Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2.5 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">Logout</button>
                </form>
            @else
                <hr class="my-2 border-gray-100">
                <a href="{{ route('login') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1B4332] hover:bg-gray-50 rounded-lg transition-colors font-semibold">Masuk</a>
            @endauth
        </div>
    </div>
</nav>
