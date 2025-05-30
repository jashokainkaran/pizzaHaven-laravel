<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>{{ $title ?? 'Pizza Haven' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    @include('layouts.footer')

    <div id="mobile-menu-backdrop" class="hidden fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm z-40 transition-opacity duration-300"></div>

    <div id="mobile-menu"
         class="fixed top-0 right-0 w-[280px] h-screen bg-gradient-to-br from-red-700 to-red-900 z-50 transform translate-x-full transition-transform duration-500 shadow-2xl overflow-y-auto">
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/favicon.png') }}" alt="Logo" class="w-8 h-8">
                <span class="text-white font-semibold text-lg">Pizza Haven</span>
            </div>
            <button id="mobile-menu-close" class="w-8 h-8 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-white/20 transition">
                <span class="material-icons text-sm">close</span>
            </button>
        </div>

        <div class="p-4 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 text-white rounded-lg hover:bg-white/10 border-l-4 border-transparent hover:border-yellow-500 transition">
                <span class="material-icons text-yellow-500">home</span>
                <span class="text-sm font-medium">Home</span>
            </a>
            <a href="{{ route('pizza') }}" class="flex items-center gap-3 px-4 py-2 text-white rounded-lg hover:bg-white/10 border-l-4 border-transparent hover:border-yellow-500 transition">
                <span class="material-icons text-yellow-500">local_pizza</span>
                <span class="text-sm font-medium">Pizzas</span>
            </a>
            <a href="{{ route('drinks') }}" class="flex items-center gap-3 px-4 py-2 text-white rounded-lg hover:bg-white/10 border-l-4 border-transparent hover:border-yellow-500 transition">
                <span class="material-icons text-yellow-500">local_drink</span>
                <span class="text-sm font-medium">Drinks</span>
            </a>
            <a href="{{ route('cart') }}" class="flex items-center gap-3 px-4 py-2 text-white rounded-lg hover:bg-white/10 border-l-4 border-transparent hover:border-yellow-500 transition">
                <span class="material-icons text-yellow-500">shopping_cart</span>
                <span class="text-sm font-medium">Cart</span>
            </a>

            @auth
            <a href="{{ route('orders') }}" class="flex items-center gap-3 px-4 py-2 text-white rounded-lg hover:bg-white/10 border-l-4 border-transparent hover:border-yellow-500 transition">
                <span class="material-icons text-yellow-500">receipt_long</span>
                <span class="text-sm font-medium">Orders</span>
            </a>
            @endauth
        </div>

        <div class="p-4 border-t border-white/10 mt-auto">
            @auth
            <div class="flex items-center gap-3 px-3 py-2 bg-white/5 rounded-lg text-white mb-3">
                <span class="material-icons text-yellow-500">waving_hand</span>
                <span class="text-sm font-medium">Welcome back!</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-white bg-white/10 hover:bg-white/20 rounded-lg border border-white/20 font-medium transition">
                    <span class="material-icons text-sm">logout</span>
                    Logout
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="block text-center text-white px-4 py-2 border border-white/30 rounded-lg mb-2 hover:bg-white/10 transition font-medium">
                <span class="material-icons align-middle text-sm mr-1">login</span>
                Login
            </a>
            <a href="{{ route('register') }}" class="block text-center text-white px-4 py-2 bg-gradient-to-r from-yellow-600 to-yellow-700 rounded-lg shadow hover:opacity-90 transition font-medium">
                <span class="material-icons align-middle text-sm mr-1">person_add</span>
                Get Started
            </a>
            @endauth
        </div>
    </div>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerBtn = document.querySelector('[data-collapse-toggle="navbar-default"]');
            const mobileMenu = document.getElementById('mobile-menu');
            const backdrop = document.getElementById('mobile-menu-backdrop');
            const closeBtn = document.getElementById('mobile-menu-close');

            if (!hamburgerBtn || !mobileMenu || !backdrop || !closeBtn) {
                console.error('Menu components missing.');
                return;
            }

            function openMenu() {
                mobileMenu.classList.remove('translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.add('opacity-100'), 10);
                document.body.style.overflow = 'hidden';
            }

            function closeMenu() {
                mobileMenu.classList.add('translate-x-full');
                backdrop.classList.remove('opacity-100');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
                document.body.style.overflow = '';
            }

            hamburgerBtn.addEventListener('click', openMenu);
            closeBtn.addEventListener('click', closeMenu);
            backdrop.addEventListener('click', closeMenu);
        });
    </script>
</body>
</html>
