<x-guest-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-red-600 to-red-900 rounded-full flex items-center justify-center mb-4">
                    <span class="material-icons text-white text-2xl">local_pizza</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your Pizza Haven account</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <span class="material-icons text-red-600 text-sm mr-2">email</span>
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('email') border-red-500 @enderror"
                                placeholder="Enter your email address"
                            >
                            @if($errors->get('email'))
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-icons text-red-500 text-sm">error</span>
                                </div>
                            @endif
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="text-red-600 text-sm flex items-center mt-1">
                            <span class="material-icons text-xs mr-1">info</span>
                        </x-input-error>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <span class="material-icons text-red-600 text-sm mr-2">lock</span>
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 pr-12 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('password') border-red-500 @enderror"
                                placeholder="Enter your password"
                            >
                            <button
                                type="button"
                                onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <span class="material-icons text-sm" id="password-icon">visibility</span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="text-red-600 text-sm flex items-center mt-1">
                            <span class="material-icons text-xs mr-1">info</span>
                        </x-input-error>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between pt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2 transition-all duration-200"
                            >
                            <span class="ml-3 text-sm text-gray-600 group-hover:text-gray-800 transition-colors">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-red-600 hover:text-red-700 font-medium inline-flex items-center transition-colors group"
                            >
                                <span>Forgot password?</span>
                                <span class="material-icons text-xs ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 mt-8"
                    >
                        <span class="material-icons">login</span>
                        <span>Sign In</span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center pt-6 border-t border-gray-200">
                        <p class="text-gray-600">
                            <span>Don't have an account?</span>
                            <a
                                href="{{ route('register') }}"
                                class="text-red-600 hover:text-red-700 font-semibold ml-2 inline-flex items-center transition-colors"
                            >
                                <span>Create one here</span>
                                <span class="material-icons text-sm ml-1">person_add</span>
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Security Notice -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center text-gray-500 text-sm bg-white px-4 py-2 rounded-lg shadow-sm">
                    <span class="material-icons text-green-500 text-sm mr-2">security</span>
                    <span>Your information is secure and encrypted</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Password Toggle Script -->
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                field.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Add subtle animations on load
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.style.opacity = '0';
            form.style.transform = 'translateY(20px)';

            setTimeout(() => {
                form.style.transition = 'all 0.6s ease-out';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</x-guest-layout>
