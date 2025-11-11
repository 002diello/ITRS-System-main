{{-- <x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Quick Stats</h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
        </div>

        <!-- Grid of ITF boxes -->
        <div class="grid gap-6 sm:grid-cols-2">
            @foreach($forms as $form)
                <div class="flex flex-col rounded-xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-lg dark:border-neutral-700 dark:bg-neutral-900">
                    <!-- Header -->
                    <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <x-dynamic-component 
                                :component="'icon.folder'" 
                                class="size-8 text-indigo-600 dark:text-indigo-400" 
                            />
                            <div>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $form['code'] }} - {{ $form['label'] }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Total Requests: {{ $form['pending_bpo_hod'] + $form['pending_it_hod'] + $form['approved_unassigned'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats section -->
                    <div class="grid grid-cols-1 divide-y divide-neutral-200 dark:divide-neutral-700">
                        <!-- Pending BPO/HOD Approval -->
                        <a href="{{ route('requests.pending-verification', ['form' => $form['code']]) }}" 
                           class="group flex items-center justify-between px-6 py-4 transition hover:bg-neutral-50 dark:hover:bg-neutral-800">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Pending BPO/HOD</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Waiting for department approval</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400">
                                    {{ $form['pending_bpo_hod'] }}
                                </span>
                                <x-icon.chevron-right class="h-4 w-4 text-gray-400 group-hover:translate-x-1 transition-transform" />
                            </div>
                        </a>

                        <!-- Pending IT HOD Approval -->
                        <a href="{{ route('in.process') }}" 
                           class="group flex items-center justify-between px-6 py-4 transition hover:bg-neutral-50 dark:hover:bg-neutral-800">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Pending IT HOD</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Waiting for IT approval</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                    {{ $form['pending_it_hod'] }}
                                </span>
                                <x-icon.chevron-right class="h-4 w-4 text-gray-400 group-hover:translate-x-1 transition-transform" />
                            </div>
                        </a>

                        <!-- Approved but Unassigned -->
                        <a href="{{ route('approved.unassign') }}" 
                           class="group flex items-center justify-between px-6 py-4 transition hover:bg-neutral-50 dark:hover:bg-neutral-800">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Approved & Unassigned</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Waiting for IT assignment</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-bold text-green-600 dark:text-green-400">
                                    {{ $form['approved_unassigned'] }}
                                </span>
                                <x-icon.chevron-right class="h-4 w-4 text-gray-400 group-hover:translate-x-1 transition-transform" />
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app> --}}


<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-950 dark:to-neutral-900 p-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1 h-10 bg-gradient-to-b from-blue-600 to-indigo-600 rounded-full"></div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Quick Stats</h1>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 ml-4">Monitor all request statuses in real-time</p>
                </div>
                <div class="bg-white dark:bg-neutral-800 rounded-lg px-6 py-3 border border-gray-200 dark:border-neutral-700 shadow-sm">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-semibold text-gray-900 dark:text-white">Last updated:</span> 
                        <span class="ml-2">{{ now()->setTimezone('Asia/Kuala_Lumpur')->format('M d, Y • h:i A') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 auto-rows-max">
            @foreach($forms as $form)
                <div class="group bg-white dark:bg-neutral-800 rounded-2xl border border-gray-200 dark:border-neutral-700 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-neutral-900 dark:to-neutral-800 border-b border-gray-200 dark:border-neutral-700 px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <x-dynamic-component 
                                    :component="'icon.folder'" 
                                    class="size-6 text-white" 
                                />
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">
                                    {{ $form['code'] }} - {{ $form['label'] }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <span class="font-semibold">{{ $form['pending_bpo_hod'] + $form['pending_it_hod'] + $form['approved_unassigned'] }}</span> total requests
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="divide-y divide-gray-200 dark:divide-neutral-700">
                        <!-- Pending BPO/HOD Approval -->
                        <a href="{{ route('requests.pending-verification', ['form' => $form['code']]) }}" 
                           class="group/item flex items-center justify-between px-6 py-5 transition-all hover:bg-yellow-50 dark:hover:bg-yellow-900/10">
                            <div class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Pending BPO/HOD</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Awaiting department approval</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0 ml-4">
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                        {{ $form['pending_bpo_hod'] }}
                                    </p>
                                    <p class="text-xs text-gray-400">requests</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400 group-hover/item:text-yellow-600 dark:group-hover/item:text-yellow-400 group-hover/item:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </a>

                        <!-- Pending IT HOD Approval -->
                        <a href="{{ route('in.process') }}" 
                           class="group/item flex items-center justify-between px-6 py-5 transition-all hover:bg-blue-50 dark:hover:bg-blue-900/10">
                            <div class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/30 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Pending IT HOD</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Awaiting IT approval</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0 ml-4">
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        {{ $form['pending_it_hod'] }}
                                    </p>
                                    <p class="text-xs text-gray-400">requests</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 group-hover/item:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </a>

                        <!-- Approved but Unassigned -->
                        <a href="{{ route('approved.unassign') }}" 
                           class="group/item flex items-center justify-between px-6 py-5 transition-all hover:bg-green-50 dark:hover:bg-green-900/10">
                            <div class="flex items-center gap-4 flex-1 min-w-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 dark:bg-green-900/30 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Approved & Unassigned</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Ready for IT assignment</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0 ml-4">
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        {{ $form['approved_unassigned'] }}
                                    </p>
                                    <p class="text-xs text-gray-400">requests</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400 group-hover/item:text-green-600 dark:group-hover/item:text-green-400 group-hover/item:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>