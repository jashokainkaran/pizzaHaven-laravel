<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Main Content Section --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Profile Information Section --}}
                <div class="bg-white shadow-lg border border-gray-100 p-6 sm:p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">Profile Information</h3>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Update Password Section --}}
                <div class="bg-white shadow-lg border border-gray-100 p-6 sm:p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">Update Password</h3>
                    </div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Sidebar Section --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Account Overview Card --}}
                <div class="bg-gradient-to-br from-secondary to-secondary/80 text-white shadow-lg border border-gray-100 p-6 rounded-xl lg:top-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Account Overview</h3>
                            <p class="text-white/80 text-sm">Manage your account settings</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="bg-white/10 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Profile Status</span>
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Active</span>
                            </div>
                        </div>

                        <div class="bg-white/10 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Account Type</span>
                                <span class="text-white/90 text-sm">Standard</span>
                            </div>
                        </div>

                        <div class="bg-white/10 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Member Since</span>
                                <span class="text-white/90 text-sm">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Danger Zone Card --}}
                <div class="bg-white shadow-lg border border-red-200 p-6 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-red-600">Danger Zone</h3>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
