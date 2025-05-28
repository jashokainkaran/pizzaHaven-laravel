<x-guest-layout :title="'Register'">
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-red-600 to-red-900 rounded-full flex items-center justify-center mb-4">
                    <span class="material-icons text-white text-2xl">restaurant</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Join Pizza Haven</h2>
                <p class="text-gray-600">Create your account to start ordering delicious pizzas</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name Fields Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                <span class="material-icons text-red-600 text-sm mr-2">person</span>
                                First Name
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('first_name') border-red-500 @enderror"
                                    placeholder="Enter your first name"
                                >
                                @error('first_name')
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="material-icons text-red-500 text-sm">error</span>
                                    </div>
                                @enderror
                            </div>
                            @error('first_name')
                                <p class="text-red-600 text-sm flex items-center mt-1">
                                    <span class="material-icons text-xs mr-1">info</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                <span class="material-icons text-red-600 text-sm mr-2">person_outline</span>
                                Last Name
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('last_name') border-red-500 @enderror"
                                    placeholder="Enter your last name"
                                >
                                @error('last_name')
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="material-icons text-red-500 text-sm">error</span>
                                    </div>
                                @enderror
                            </div>
                            @error('last_name')
                                <p class="text-red-600 text-sm flex items-center mt-1">
                                    <span class="material-icons text-xs mr-1">info</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <span class="material-icons text-red-600 text-sm mr-2">email</span>
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('email') border-red-500 @enderror"
                                placeholder="Enter your email address"
                            >
                            @error('email')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-icons text-red-500 text-sm">error</span>
                                </div>
                            @enderror
                        </div>
                        @error('email')
                            <p class="text-red-600 text-sm flex items-center mt-1">
                                <span class="material-icons text-xs mr-1">info</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <span class="material-icons text-red-600 text-sm mr-2">phone</span>
                            Phone Number
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('phone') border-red-500 @enderror"
                                placeholder="Enter your phone number"
                            >
                            @error('phone')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-icons text-red-500 text-sm">error</span>
                                </div>
                            @enderror
                        </div>
                        @error('phone')
                            <p class="text-red-600 text-sm flex items-center mt-1">
                                <span class="material-icons text-xs mr-1">info</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <span class="material-icons text-red-600 text-sm mr-2">location_on</span>
                            Delivery Address
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                name="address"
                                value="{{ old('address') }}"
                                class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('address') border-red-500 @enderror"
                                placeholder="Enter your delivery address"
                            >
                            @error('address')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-icons text-red-500 text-sm">error</span>
                                </div>
                            @enderror
                        </div>
                        @error('address')
                            <p class="text-red-600 text-sm flex items-center mt-1">
                                <span class="material-icons text-xs mr-1">info</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Fields -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                <span class="material-icons text-red-600 text-sm mr-2">lock</span>
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 pr-12 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none @error('password') border-red-500 @enderror"
                                    placeholder="Create a secure password"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
                                >
                                    <span class="material-icons text-sm" id="password-icon">visibility</span>
                                </button>
                                @error('password')
                                    <div class="absolute inset-y-0 right-12 flex items-center pr-3">
                                        <span class="material-icons text-red-500 text-sm">error</span>
                                    </div>
                                @enderror
                            </div>
                            @error('password')
                                <p class="text-red-600 text-sm flex items-center mt-1">
                                    <span class="material-icons text-xs mr-1">info</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 flex items-center">
                                <span class="material-icons text-red-600 text-sm mr-2">lock_outline</span>
                                Confirm Password
                            </label>
                            <div class="relative">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="w-full border-2 border-gray-200 rounded-lg p-3 pl-4 pr-12 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 outline-none"
                                    placeholder="Confirm your password"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password_confirmation')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors"
                                >
                                    <span class="material-icons text-sm" id="password_confirmation-icon">visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 mt-8"
                    >
                        <span class="material-icons">person_add</span>
                        <span>Create Account</span>
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-6 border-t border-gray-200">
                        <p class="text-gray-600">
                            <span>Already have an account?</span>
                            <a
                                href="{{ route('login') }}"
                                class="text-red-600 hover:text-red-700 font-semibold ml-2 inline-flex items-center transition-colors"
                            >
                                <span>Sign in here</span>
                                <span class="material-icons text-sm ml-1">arrow_forward</span>
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer Text -->
            <p class="text-center text-gray-500 text-sm mt-8">
                By creating an account, you agree to our terms of service and privacy policy
            </p>
        </div>
    </div>

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
    </script>
</x-guest-layout>
