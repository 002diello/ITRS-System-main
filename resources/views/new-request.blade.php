{{-- <x-layouts.app :title="__('New Request')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">New Request</h2>

        <!-- Grid of Selection Boxes -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['icon' => 'folder', 'label' => ' ITF001 User ID Creation / Amendment / Deactivation'],
                ['icon' => 'folder', 'label' => 'ITF002 Doctor Registration'],
                // ['icon' => 'folder', 'label' => 'ITF003 IT Equipment loan'],
                // ['icon' => 'folder', 'label' => 'ITF004 ICT Equipment Handover'],
                // ['icon' => 'folder', 'label' => 'ITF005 Website White List'],
                // ['icon' => 'folder', 'label' => 'ITF007 ALTY Server Maintanance'],
                // ['icon' => 'folder', 'label' => 'ITF008 Initial PC Configuration'],
                // ['icon' => 'folder', 'label' => 'ITF009 IT BYOD'],
                // ['icon' => 'folder', 'label' => 'ITF010 External Storage Access'],
            ] as $index => $item)
                @if ($index === 0)
                    <a href="{{ route('itf001') }}" class="block">
                        <div
                            class="flex cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-900"
                        >
                            <x-dynamic-component :component="'icon.' . $item['icon']" class="size-10 text-indigo-600 dark:text-indigo-400" />
                            <span class="text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                                {{ $item['label'] }}
                            </span>
                        </div>
                    </a>
                @elseif ($index === 1)
                    <a href="{{ route('itf002') }}" class="block h-full w-full no-underline">
                        <div
                            class="flex h-full w-full flex-col items-center justify-center gap-3 rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-900 cursor-pointer"
                        >
                            <x-dynamic-component :component="'icon.' . $item['icon']"
                                class="size-10 text-indigo-600 dark:text-indigo-400" />
                            <span class="text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                                {{ $item['label'] }}
                            </span>
                        </div>
                    </a>
                @else
                    <div
                        class="flex cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border border-neutral-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-900"
                    >
                        <x-dynamic-component :component="'icon.' . $item['icon']" class="size-10 text-indigo-600 dark:text-indigo-400" />
                        <span class="text-center text-sm font-semibold text-gray-700 dark:text-gray-200">
                            {{ $item['label'] }}
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts.app> --}}


<x-layouts.app :title="__('New Request')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-950 dark:to-neutral-900 p-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-10 bg-gradient-to-b from-green-600 to-emerald-600 rounded-full"></div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ __('New Request') }}</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-4">Select a request type to get started</p>
        </div>

        <!-- Info Banner -->
        <div class="mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 flex items-start gap-3">
            <div class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-green-800 dark:text-green-200">Choose a Request Type</p>
                <p class="text-sm text-green-700 dark:text-green-300">Select the type of IT request you need to submit. Fill out the form with accurate information for faster processing.</p>
            </div>
        </div>

        <!-- Selection Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['icon' => 'folder', 'label' => 'ITF001 User ID Creation / Amendment / Deactivation', 'description' => 'Create, update, or deactivate user accounts', 'route' => 'itf001', 'color' => 'blue'],
                ['icon' => 'folder', 'label' => 'ITF002 Doctor Registration', 'description' => 'Register new doctors in the system', 'route' => 'itf002', 'color' => 'green'],
                // ['icon' => 'folder', 'label' => 'ITF003 IT Equipment loan', 'description' => 'Request to borrow IT equipment', 'route' => null, 'color' => 'purple'],
                // ['icon' => 'folder', 'label' => 'ITF004 ICT Equipment Handover', 'description' => 'Handle equipment handover process', 'route' => null, 'color' => 'orange'],
                // ['icon' => 'folder', 'label' => 'ITF005 Website White List', 'description' => 'Request website whitelisting', 'route' => null, 'color' => 'red'],
                // ['icon' => 'folder', 'label' => 'ITF007 ALTY Server Maintanance', 'description' => 'Schedule server maintenance', 'route' => null, 'color' => 'indigo'],
                // ['icon' => 'folder', 'label' => 'ITF008 Initial PC Configuration', 'description' => 'Configure new PC setup', 'route' => null, 'color' => 'pink'],
                // ['icon' => 'folder', 'label' => 'ITF009 IT BYOD', 'description' => 'Bring Your Own Device requests', 'route' => null, 'color' => 'yellow'],
                // ['icon' => 'folder', 'label' => 'ITF010 External Storage Access', 'description' => 'Request external storage access', 'route' => null, 'color' => 'cyan'],
            ] as $index => $item)
                @php
                    $colorClasses = [
                        'blue' => 'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'green' => 'from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
                        'purple' => 'from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
                        'orange' => 'from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400',
                        'red' => 'from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                        'indigo' => 'from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400',
                        'pink' => 'from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400',
                        'yellow' => 'from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400',
                        'cyan' => 'from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400',
                    ];
                    $bgColor = $colorClasses[$item['color']] ?? $colorClasses['blue'];
                @endphp

                @if ($item['route'])
                    <a href="{{ route($item['route']) }}" class="block group h-full no-underline">
                        <div class="h-full flex flex-col rounded-2xl border border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden cursor-pointer">
                            <!-- Gradient Top Bar -->
                            <div class="h-1.5 bg-gradient-to-r {{ $bgColor }}"></div>

                            <!-- Content -->
                            <div class="flex flex-col items-center justify-center gap-4 p-8 flex-1">
                                <!-- Icon -->
                                <div class="w-16 h-16 rounded-2xl {{ $bgColor }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <x-dynamic-component :component="'icon.' . $item['icon']" class="size-8 text-white" />
                                </div>

                                <!-- Text -->
                                <div class="text-center">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $item['label'] }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $item['description'] }}
                                    </p>
                                </div>

                                <!-- CTA Arrow -->
                                <div class="mt-auto pt-4">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-neutral-700 group-hover:bg-gray-200 dark:group-hover:bg-neutral-600 transition-colors">
                                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">Submit Request</span>
                                        <svg class="w-4 h-4 text-gray-700 dark:text-gray-300 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="flex flex-col rounded-2xl border border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-lg opacity-60 cursor-not-allowed overflow-hidden">
                        <!-- Gradient Top Bar -->
                        <div class="h-1.5 bg-gradient-to-r from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700"></div>

                        <!-- Content -->
                        <div class="flex flex-col items-center justify-center gap-4 p-8 flex-1">
                            <!-- Icon -->
                            <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-neutral-700 flex items-center justify-center">
                                <x-dynamic-component :component="'icon.' . $item['icon']" class="size-8 text-gray-400" />
                            </div>

                            <!-- Text -->
                            <div class="text-center">
                                <h3 class="text-lg font-bold text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $item['label'] }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-500">
                                    {{ $item['description'] }}
                                </p>
                            </div>

                            <!-- Coming Soon Badge -->
                            <div class="mt-auto pt-4">
                                <span class="inline-block px-3 py-1 rounded-full bg-gray-200 dark:bg-neutral-700 text-gray-700 dark:text-gray-400 text-xs font-semibold">
                                    Coming Soon
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Empty State Message (if no forms) -->
        @if (empty([
            ['icon' => 'folder', 'label' => 'ITF001 User ID Creation / Amendment / Deactivation', 'description' => 'Create, update, or deactivate user accounts', 'route' => 'itf001', 'color' => 'blue'],
            ['icon' => 'folder', 'label' => 'ITF002 Doctor Registration', 'description' => 'Register new doctors in the system', 'route' => 'itf002', 'color' => 'green'],
        ]))
            <div class="flex flex-col items-center justify-center py-16">
                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-50 dark:from-neutral-800 dark:to-neutral-900 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Request Forms Available</h3>
                <p class="text-gray-600 dark:text-gray-400 text-center max-w-md">Request forms will be available soon. Please check back later.</p>
            </div>
        @endif
    </div>
</x-layouts.app>