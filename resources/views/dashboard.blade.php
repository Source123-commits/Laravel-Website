<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Login Message -->
                    <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300">
                        <p class="text-green-700 font-semibold text-lg">
                            ✅ You're logged in!
                        </p>
                    </div>

                    <!-- User Info Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- User ID -->
                        <div class="p-4 rounded-lg bg-gray-50 border">
                            <p class="text-sm text-gray-500">User ID</p>
                            <p class="text-lg font-semibold">
                                {{ auth()->user()->id }}
                            </p>
                        </div>

                        <!-- Roles -->
                        <div class="p-4 rounded-lg bg-gray-50 border">
                            <p class="text-sm text-gray-500">Role(s)</p>
                            <p class="text-lg font-semibold text-blue-600">
                                {{ auth()->user()->getRoleNames()->implode(', ') }}
                            </p>
                        </div>

                        <!-- Login Date -->
                        <div class="p-4 rounded-lg bg-gray-50 border">
                            <p class="text-sm text-gray-500">Login Date</p>
                            <p class="text-lg font-semibold">
                                {{ now()->format('d M Y') }}
                            </p>
                        </div>

                        <!-- Login Time -->
                        <div class="p-4 rounded-lg bg-gray-50 border">
                            <p class="text-sm text-gray-500">Login Time</p>
                            <p class="text-lg font-semibold">
                                {{ now()->setTimezone('Asia/Dhaka')->format('h:i A') }}

                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
