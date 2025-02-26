<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('images/01.png') }}" class="block h-9 w-auto" alt="Logo">
                    </a>
                    <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Monitoring Ketinggian Air
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @if (request()->is('/') || request()->is('before-kf'))
                    <a href="{{ url('/combined') }}"
                       class="text-gray-800 dark:text-gray-200 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:shadow-md transition duration-200">
                       Lihat Gabungan
                    </a>
                @endif

                @if (request()->is('/'))
                    <a href="{{ url('/before-kf') }}"
                       class="text-gray-800 dark:text-gray-200 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:shadow-md transition duration-200">
                       Lihat tanpa Kalman Filter
                    </a>
                @elseif (request()->is('before-kf'))
                    <a href="{{ url('/') }}"
                       class="text-gray-800 dark:text-gray-200 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:shadow-md transition duration-200">
                       Lihat dengan Kalman Filter
                    </a>
                @elseif (request()->is('combined'))
                    <a href="{{ url('/') }}"
                        class="text-gray-800 dark:text-gray-200 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:shadow-md transition duration-200">
                        Lihat dengan Kalman Filter
                    </a>
                    <a href="{{ url('/before-kf') }}"
                       class="text-gray-800 dark:text-gray-200 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:shadow-md transition duration-200">
                       Lihat tanpa Kalman Filter
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
