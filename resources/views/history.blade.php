{{-- <x-layouts.app :title="__('History')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">History</h1>

        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-xl shadow">
            <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Department</th>
                        <th class="px-6 py-3">Request Type</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t border-gray-200 dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                            <td class="px-6 py-3">{{ $request->name }}</td>
                            <td class="px-6 py-3">{{ $request->department }}</td>
                            <td class="px-6 py-3">{{ $request->form_code }} - {{ $request->form_title }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('pending.view', $request->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                No completed requests at the moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app> --}}


<x-layouts.app :title="__('History')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-900 dark:to-neutral-800 p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-8 bg-gradient-to-b from-cyan-600 to-cyan-400 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('History') }}</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-4">View all completed and processed requests</p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Completed</p>
                        <p class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">{{ $requests->count() ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">On This Page</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $requests->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Last Updated</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">Just now</p>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 dark:bg-neutral-700 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-lg border border-gray-200 dark:border-neutral-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-neutral-900 dark:to-neutral-800 border-b border-gray-200 dark:border-neutral-700">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Department</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Request Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($requests as $request)
                            <tr class="hover:bg-cyan-50 dark:hover:bg-neutral-700 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                            {{ substr($request->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $request->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-900 text-cyan-700 dark:text-cyan-300 text-sm font-medium">
                                        <span class="w-2 h-2 bg-cyan-600 rounded-full"></span>
                                        {{ $request->department }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $request->form_code }}</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-xs">{{ $request->form_title }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($request->status === 'completed')
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-2 h-2 bg-green-600 rounded-full animate-pulse"></span>
                                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs font-semibold">
                                                {{ __('Completed') }}
                                            </span>
                                        </div>
                                    @elseif($request->status === 'rejected')
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-2 h-2 bg-red-600 rounded-full animate-pulse"></span>
                                            <span class="px-3 py-1 rounded-full bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold">
                                                {{ __('Rejected') }}
                                            </span>
                                            @if($request->rejection_reason)
                                                <div x-data="{ showReason: false }" class="relative">
                                                    <button @click="showReason = !showReason" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <div x-show="showReason" @click.away="showReason = false" class="absolute z-10 w-64 p-3 mt-1 -ml-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-200">
                                                        <p class="font-semibold">Reason for rejection:</p>
                                                        <p class="mt-1">{{ $request->rejection_reason }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('pending.view', $request->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg text-xs font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-gradient-to-br from-cyan-100 to-cyan-50 dark:from-cyan-900 dark:to-neutral-900 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Completed Requests</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-center max-w-md">There are no completed requests in the history yet. Completed requests will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($requests->isNotEmpty())
            <div class="mt-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Showing <span class="font-semibold">{{ $requests->count() }}</span> completed requests
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>