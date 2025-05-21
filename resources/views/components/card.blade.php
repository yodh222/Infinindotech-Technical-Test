@props([
    'stat',
    'unit' => '',
])
<div class="group relative flex flex-col bg-white rounded-2xl shadow-md overflow-hidden transition-all duration-300 dark:bg-gray-800 dark:border dark:border-gray-700">

    <div class="relative z-10 p-6">
        <!-- Icon -->
        <div class="flex items-center justify-between mb-4">
            {{ $icon ?? '' }}
        </div>

        <!-- Content -->
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
            {{ $slot }}
        </h3>
        <div class="flex items-center gap-2 mb-4">
            <span class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $stat ?? '1,250' }}
            </span>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ $unit ?? 'Penjualan' }}
            </span>
        </div>
    </div>

    <!-- Hover Effect -->
    <div class="absolute inset-0 bg-white/20 dark:bg-gray-900/20 transition-opacity"></div>
</div>
