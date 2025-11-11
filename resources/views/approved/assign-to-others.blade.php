{{-- <?php /* resources/views/approved/assign-to-others.blade.php */ ?>

<x-layouts.app :title="__('Assigned Requests')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Assigned Requests</h1>

        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-xl shadow">
            <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Department</th>
                        <th class="px-6 py-3">NRIC</th>
                        <th class="px-6 py-3">Type of Request</th>
                        <th class="px-6 py-3">Assigned To</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t border-gray-200 dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                            <td class="px-6 py-3">{{ $request->name }}</td>
                            <td class="px-6 py-3">{{ $request->department }}</td>
                            <td class="px-6 py-3">{{ $request->nric ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $request->form_code }} - {{ $request->form_title }}</td>
                            <td class="px-6 py-3">{{ $request->assignedUser->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($request->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('pending.view', $request->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                No assigned requests at the moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app> --}}


<?php /* resources/views/approved/assign-to-others.blade.php */ ?>

<x-layouts.app :title="__('Assigned Requests')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-900 dark:to-neutral-800 p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-8 bg-gradient-to-b from-rose-600 to-rose-400 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('Assigned Requests') }}</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-4">Monitor and track all requests assigned to IT staff</p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Assigned</p>
                        <p class="text-2xl font-bold text-rose-600 dark:text-rose-400">{{ $requests->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-rose-100 dark:bg-rose-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $requests->where('status', '!=', 'completed')->count() ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $requests->where('status', 'completed')->count() ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">On This Page</p>
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $requests->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
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
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Assigned To</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($requests as $request)
                            <tr class="hover:bg-rose-50 dark:hover:bg-neutral-700 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-rose-400 to-rose-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                            {{ substr($request->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $request->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-100 dark:bg-rose-900 text-rose-700 dark:text-rose-300 text-sm font-medium">
                                        <span class="w-2 h-2 bg-rose-600 rounded-full"></span>
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
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-xs flex-shrink-0">
                                            {{ substr($request->assignedUser->name ?? 'N/A', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $request->assignedUser->name ?? 'N/A' }}</span>
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
                                    @else
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs font-semibold">
                                                {{ __('In Progress') }}
                                            </span>
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
                                <td colspan="6" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-gradient-to-br from-rose-100 to-rose-50 dark:from-rose-900 dark:to-neutral-900 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Assigned Requests</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-center max-w-md">There are no requests assigned to IT staff at the moment. New assignments will appear here.</p>
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
                            Showing <span class="font-semibold">{{ $requests->count() }}</span> assigned requests
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>