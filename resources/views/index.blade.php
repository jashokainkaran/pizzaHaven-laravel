<x-app-layout>
    <!-- Hero Section -->
    <section class="relative text-center w-full">
        <div class="relative w-full">
            <img src="{{ asset('img/hero.jpg') }}" class="w-full h-[50vh] object-cover sm:h-[60vh] md:h-[70vh]">
            <div class="absolute inset-0 flex flex-col justify-center items-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-md">
                    Welcome to Pizza Haven
                </h1>
                <p class="mt-4 text-lg md:text-xl text-white font-bold">
                    Serving the Best Pizzas in Town, Day or Night.
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Items -->
    <section class="bg-background px-4 pb-4 pt-3 mt-4">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-primary text-center">Featured Pizzas</h2>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="bg-background py-8 px-4">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <!-- Text Section -->
            <div class="lg:w-1/2 text-center lg:text-left mb-8 lg:mb-0">
                <h2 class="text-3xl font-bold text-primary">Welcome to Pizza Haven – Where Every Slice Feels Like Home!</h2>
                <p class="mt-4 text-gray-700">
                    At Pizza Haven, we believe that great pizza brings people together...
                </p>
                <p class="mt-4 text-gray-700">
                    Our journey began with a simple idea: to create a haven...
                </p>
            </div>

            <!-- Image -->
            <div class="lg:w-1/2 flex justify-center">
                <img src="{{ asset('img/about-us.jpg') }}" alt="Delicious Pizza" class="w-full lg:w-3/4 rounded-lg shadow-lg" />
            </div>
        </div>
    </section>
</x-app-layout>
