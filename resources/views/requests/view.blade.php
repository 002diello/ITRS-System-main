<x-layouts.app :title="__('View Request')">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                ← Back
            </a>
        </div>

        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Request Details</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reference Number</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->reference_number }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Form Type</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->form_code }} - {{ $request->form_title }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->department }}</p>
                </div>

                @if(isset($request->request_data['NRIC / Passport No']))
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NRIC / Passport No</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->nric }}</p>
                </div>
                @endif

                @if($request->phone)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->phone }}</p>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 text-sm rounded-full
                            @if($request->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @elseif($request->status === 'approved') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                            @elseif($request->status === 'verified_hod') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                            @elseif($request->status === 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Submitted At</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            @if($request->request_data)
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Additional Details</h3>
                <div class="bg-gray-50 dark:bg-neutral-800 p-4 rounded-lg">
                    @foreach($request->request_data as $key => $value)
                        @if($value)
                        <div class="mb-2">
                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                            <span class="text-gray-900 dark:text-gray-100">
                                @if(is_array($value))
                                    {{ implode(', ', $value) }}
                                @else
                                    {{ $value }}
                                @endif
                            </span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            @if($request->assigned_to)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Assigned To</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->assignedUser->name ?? 'N/A' }}</p>
            </div>
            @endif

            @if($request->rejection_reason)
            <div class="mt-6">
                <label class="block text-sm font-medium text-red-700 dark:text-red-300">Rejection Reason</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->rejection_reason }}</p>
            </div>
            @endif

            @if($request->completion_notes)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completion Notes</label>
                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $request->completion_notes }}</p>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
