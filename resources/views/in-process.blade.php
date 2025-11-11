{{-- <x-layouts.app :title="__('In Process - Verified Requests')">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">In Process - Verified by HOD</h1>
        <p class="mb-4 text-gray-600 dark:text-gray-400">These requests have been verified by department HOD and are waiting for HOD IT approval.</p>

        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-xl shadow">
            <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Department</th>
                        <th class="px-6 py-3">Request Type</th>
                        <th class="px-6 py-3">Verified By</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t border-gray-200 dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                            <td class="px-6 py-3">{{ $request->name }}</td>
                            <td class="px-6 py-3">{{ $request->department }}</td>
                            <td class="px-6 py-3">{{ $request->form_code }} - {{ $request->form_title }}</td>
                            <td class="px-6 py-3">{{ $request->hodVerifier->name ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('pending.view', $request->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs">View</a>
                                    <form action="{{ route('in.process.approve', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs">Approve</button>
                                    </form>
                                    <button onclick="openRejectModal({{ $request->id }})" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-xs">Reject</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                No requests in process at the moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Reject Modal -->
        <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-neutral-900 rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Reject Request</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rejection Reason</label>
                        <textarea name="reason" rows="4" class="w-full rounded-md border-gray-300 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" placeholder="Please provide a reason for rejection..." required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Reject Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(requestId) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectForm').action = `/in-process/reject/${requestId}`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-layouts.app> --}}


<?php /* resources/views/in-process.blade.php */ ?>

<x-layouts.app :title="__('In Process - Verified Requests')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-900 dark:to-neutral-800 p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-8 bg-gradient-to-b from-purple-600 to-purple-400 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">In Process - Verified by HOD</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-4">These requests have been verified by department HOD and are waiting for HOD IT approval.</p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</p>
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ count($requests) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Awaiting Approval</p>
                        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ count($requests) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-gray-200 dark:border-neutral-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Verified By</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">Department HOD</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-lg border border-gray-200 dark:border-neutral-700 overflow-hidden">
            @if(count($requests) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-neutral-900 dark:to-neutral-800 border-b border-gray-200 dark:border-neutral-700">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Department</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Request Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Verified By</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($requests as $request)
                                <tr class="hover:bg-purple-50 dark:hover:bg-neutral-700 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm">
                                                {{ substr($request->name, 0, 1) }}
                                            </div>
                                            <span class="font-medium text-gray-900 dark:text-white">{{ $request->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 text-sm font-medium">
                                            <span class="w-2 h-2 bg-purple-600 rounded-full"></span>
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
                                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-100 dark:bg-green-900">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-sm font-semibold text-green-700 dark:text-green-300">{{ $request->hodVerifier->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pending.view', $request->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg text-xs font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <form action="{{ route('in.process.approve', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 shadow-md hover:shadow-lg text-xs font-medium">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>
                                            <button onclick="openRejectModal({{ $request->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg text-xs font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Reject
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900 dark:to-neutral-900 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Requests In Process</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-center max-w-md">All in-process requests have been resolved. Check back soon for new requests requiring IT HOD approval.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 w-full max-w-md shadow-2xl border border-gray-200 dark:border-neutral-700 transform transition-all">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Reject Request</h3>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Rejection Reason *</label>
                    <textarea name="reason" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none transition-all" placeholder="Please provide a detailed reason for rejection..." required></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeRejectModal()" class="px-5 py-2.5 bg-gray-200 dark:bg-neutral-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-neutral-600 font-medium transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        Reject Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(requestId) {
            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.querySelector('#rejectForm').action = `/in-process/reject/${requestId}`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) closeRejectModal();
        });
    </script>
</x-layouts.app>