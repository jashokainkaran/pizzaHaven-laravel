<header class="text-white p-4 shadow-lg" style="background: linear-gradient(to right, #d31310, #730303);">
    <div class="w-full flex flex-wrap items-center justify-between mx-auto">
      <!-- Logo -->
      <a href="{{route('home')}}" class="flex items-center space-x-3 group">
        <img src="{{asset('img/favicon.png')}}" class="w-10 group-hover:rotate-12 transition-transform duration-300">
        <h1 class="text-2xl font-bold tracking-wide group-hover:scale-105 transition-transform duration-300">Pizza Haven</h1>
      </a>

      <!-- Hamburger Button -->
      <button
        data-collapse-toggle="navbar-default"
        type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
        aria-controls="navbar-default"
        aria-expanded="false"
      >
        <span class="sr-only">Open main menu</span>
        <span class="material-icons text-2xl">menu</span>
      </button>

      <!-- Navbar Links -->
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <nav class="flex flex-col items-center text-center md:flex-row md:items-center md:space-x-6 space-y-4 md:space-y-0 w-full">
          <!-- Navigation Links -->
          <a href="{{route('admin.dashboard')}}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
            <span class="flex items-center space-x-2">
              <span class="material-icons text-lg">home</span>
              <span>Home</span>
            </span>
            <div class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" style="background-color: #b8860b;"></div>
          </a>

          <a href="{{route('admin.pizza')}}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
            <span class="flex items-center space-x-2">
              <span class="material-icons text-lg">local_pizza</span>
              <span>Pizzas</span>
            </span>
            <div class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" style="background-color: #b8860b;"></div>
          </a>

          <a href="{{route('admin.drinks')}}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
            <span class="flex items-center space-x-2">
              <span class="material-icons text-lg">local_drink</span>
              <span>Drinks</span>
            </span>
            <div class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" style="background-color: #b8860b;"></div>
          </a>

          @auth
              <!-- Orders Link - Only visible when logged in -->
              <a href="{{ route('admin.orders') }}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
                <span class="flex items-center space-x-2">
                  <span class="material-icons text-lg">receipt_long</span>
                  <span>Orders</span>
                </span>
                <div class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-300" style="background-color: #b8860b;"></div>
              </a>

              <!-- User Section -->
              <div class="flex items-center space-x-4 ml-6 pl-6 border-l border-white/30">
                <!-- User Greeting -->
                <a href="{{route('profile.edit')}}" class="group relative px-3 py-2 rounded-lg hover:bg-white/20 transition-all duration-300">
                  <span class="flex items-center space-x-2">
                    <span class="material-icons text-lg group-hover:scale-110 transition-transform duration-300" style="color: #b8860b;">waving_hand</span>
                    <span>Hi, <span class="font-semibold group-hover:scale-105 transition-transform duration-300">{{ Auth::user()->first_name ?? Auth::user()->name }}</span>!</span>
                  </span>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="group flex items-center space-x-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all duration-300 border border-white/30 hover:border-white/50">
                        <span class="material-icons text-lg group-hover:rotate-12 transition-transform duration-300">logout</span>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
              </div>
          @endauth
        </nav>
      </div>
    </div>
</header>
