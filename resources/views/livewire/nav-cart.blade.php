<a href="{{route('cart')}}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
    <span class="flex items-center space-x-2">
        <span class="material-icons text-lg group-hover:scale-110 transition-transform duration-300 relative">shopping_cart
            <span class="absolute -top-2 -right-2 text-white text-xs px-2 py-0.5 rounded-full">
                {{ $count }}
            </span>
        </span>
<span>Cart</span>
    </span>
<div class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" style="background-color: #b8860b;"></div>
</a>



