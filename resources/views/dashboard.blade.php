<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido!!") }} {{ Auth::user()->name }}
                </div>
            </div>

            <!-- Tarjetas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Tarjeta 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        👤 Usuarios
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400">
                        Total de usuarios registrados
                    </p>

                    <span class="text-3xl font-bold text-indigo-600">
                        {{ $totalUsers }}
                    </span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
