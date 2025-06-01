<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Haven - Main Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(45deg, #d31310, #730303);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 20px rgba(211, 19, 16, 0.3); }
            50% { box-shadow: 0 0 30px rgba(211, 19, 16, 0.6); }
            100% { box-shadow: 0 0 20px rgba(211, 19, 16, 0.3); }
        }
    </style>
</head>
<body class="bg-white">
    @include('layouts.navigation')
    <main>
        <!-- Hero Section -->
        <section class="relative text-center w-full">
            <div class="relative w-full">
                <div class="w-full h-[50vh] sm:h-[60vh] md:h-[70vh] relative overflow-hidden">
                    <!-- Hero Image -->
                    <img
                        src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                        alt="Delicious pizza with fresh ingredients"
                        class="absolute inset-0 w-full h-full object-cover"
                    />
                    <!-- Dark overlay -->
                    <div class="absolute inset-0 bg-black/40"></div>
                    <!-- Content overlay -->
                    <div class="absolute inset-0 flex flex-col justify-center items-center z-10">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-md mb-4">
                            Welcome to Pizza Haven
                        </h1>
                        <p class="mt-4 text-lg md:text-xl text-white font-bold mb-8">
                            Serving the Best Pizzas in Town, Day or Night.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="{{route('pizza')}}">
                            <button class="px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-full font-semibold text-lg hover:from-red-700 hover:to-red-800 transform hover:scale-105 transition-all duration-300 pulse-glow">
                                Order Now
                            </button>
                            </a>
                            <a href="{{route('pizza')}}">
                            <button class="px-8 py-4 border-2 border-white text-white rounded-full font-semibold text-lg hover:bg-white hover:text-red-600 transform hover:scale-105 transition-all duration-300">
                                View Menu
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center hover-lift">
                        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-3xl text-red-600">local_pizza</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">500+</h3>
                        <p class="text-gray-600">Pizzas Sold Daily</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-3xl text-green-600">star</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">4.9</h3>
                        <p class="text-gray-600">Customer Rating</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-3xl text-blue-600">schedule</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">20</h3>
                        <p class="text-gray-600">Minutes Delivery</p>
                    </div>
                    <div class="text-center hover-lift">
                        <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-3xl text-purple-600">people</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">1000+</h3>
                        <p class="text-gray-600">Happy Customers</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold gradient-text mb-4">Why Choose Pizza Haven?</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">We're committed to delivering the best pizza experience with quality, speed, and service</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center hover-lift p-6 bg-white rounded-2xl shadow-lg">
                        <div class="w-20 h-20 mx-auto mb-6 bg-red-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-4xl text-red-600">eco</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Fresh Ingredients</h3>
                        <p class="text-gray-600">We use only the freshest, locally-sourced ingredients for every pizza we make</p>
                    </div>

                    <div class="text-center hover-lift p-6 bg-white rounded-2xl shadow-lg">
                        <div class="w-20 h-20 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-4xl text-blue-600">flash_on</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Lightning Fast</h3>
                        <p class="text-gray-600">Hot, fresh pizza delivered to your door in 20 minutes or less, guaranteed</p>
                    </div>

                    <div class="text-center hover-lift p-6 bg-white rounded-2xl shadow-lg">
                        <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="material-icons text-4xl text-green-600">favorite</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Made with Love</h3>
                        <p class="text-gray-600">Every pizza is handcrafted with care by our passionate pizza artisans</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="bg-white py-16 px-4">
            <div class="container mx-auto flex flex-col lg:flex-row items-center gap-12">
                <!-- Text Section -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h2 class="text-4xl font-bold gradient-text mb-6">Welcome to Pizza Haven – Where Every Slice Feels Like Home!</h2>
                    <p class="mt-4 text-gray-700 text-lg leading-relaxed mb-6">
                        At Pizza Haven, we believe that great pizza brings people together. Our commitment to quality ingredients, traditional techniques, and innovative flavors creates an unforgettable dining experience.
                    </p>
                    <p class="mt-4 text-gray-700 text-lg leading-relaxed mb-8">
                        Our journey began with a simple idea: to create a haven where families and friends can enjoy authentic, delicious pizza in a warm and welcoming atmosphere.
                    </p>
                    <button class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-full font-semibold hover:from-red-700 hover:to-red-800 transform hover:scale-105 transition-all duration-300">
                        Learn More About Us
                    </button>
                </div>
                <!-- Image -->
                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative hover-lift">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Delicious Pizza" class="w-full lg:w-3/4 rounded-2xl shadow-2xl mx-auto" />
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                            <span class="material-icons text-3xl text-yellow-800">star</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold gradient-text mb-4">What Our Customers Say</h2>
                    <p class="text-gray-600 text-lg">Don't just take our word for it - hear from our happy customers</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-2xl hover-lift shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4 italic">"The best pizza in town! Fresh ingredients, perfect crust, and amazing service. Pizza Haven has become our family's go-to place."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <span class="material-icons text-red-600">person</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Sarah Johnson</p>
                                <p class="text-gray-600 text-sm">Regular Customer</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl hover-lift shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4 italic">"Incredible variety and taste! The delivery is super fast and the pizza always arrives hot. Highly recommended!"</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="material-icons text-blue-600">person</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Mike Chen</p>
                                <p class="text-gray-600 text-sm">Food Enthusiast</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl hover-lift shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                                <span class="material-icons">star</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4 italic">"Pizza Haven never disappoints! Great atmosphere, friendly staff, and consistently delicious food. 5 stars!"</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="material-icons text-green-600">person</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Emma Rodriguez</p>
                                <p class="text-gray-600 text-sm">Local Resident</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-16 bg-gradient-to-r from-red-600 to-red-700">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">Ready to Order?</h2>
                <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">Join thousands of satisfied customers and experience the Pizza Haven difference today</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="px-8 py-4 bg-white text-red-600 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Order Online Now
                    </button>
                    <button class="px-8 py-4 border-2 border-white text-white rounded-full font-semibold text-lg hover:bg-white hover:text-red-600 transform hover:scale-105 transition-all duration-300">
                        Call: 119
                    </button>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to buttons
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255,255,255,0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to { transform: scale(4); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
