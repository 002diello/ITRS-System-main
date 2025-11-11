{{-- <x-layouts.app :title="__('ITF001 - User ID Creation / Amendment / Deactivation')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
            ITF001 - User ID Creation / Amendment / Deactivation
        </h2>

        <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
            <form method="POST" action="#">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" class="mt-1 w-full rounded-md border-gray-300 dark:bg-neutral-800 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                        <input type="text" name="department" class="mt-1 w-full rounded-md border-gray-300 dark:bg-neutral-800 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Request Type</label>
                        <select name="request_type" class="mt-1 w-full rounded-md border-gray-300 dark:bg-neutral-800 dark:text-white">
                            <option value="creation">Creation</option>
                            <option value="amendment">Amendment</option>
                            <option value="deactivation">Deactivation</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason</label>
                        <input type="text" name="reason" class="mt-1 w-full rounded-md border-gray-300 dark:bg-neutral-800 dark:text-white">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app> --}}



@if(auth()->check())
    <x-layouts.app :title="__('ITF001 User ID Creation / Amendment / Deactivation')">
        <div class="max-w-2xl mx-auto bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-md">
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ITF001 - User ID Creation / Amendment / Deactivation</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="max-w-2xl w-full bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-md">
                <div class="mb-6">
                    <a href="{{ route('home') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 text-sm font-medium">
                        ← Back to Home
                    </a>
                </div>
@endif
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">User Information</h2>

        <form action="{{ route('itf001.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Enter your name"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NRIC / Passport No</label>
                <input
                    type="text"
                    name="nric"
                    placeholder="Enter your NRIC / Passport No"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of Birth</label>
                <input
                    type="date"
                    name="date_of_birth"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
                <select
                    name="Gender"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nationality</label>
                <input
                    type="Nationality"
                    name="Nationality"
                    placeholder="Enter your Nationality"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            {{-- <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                <input
                    type="Department"
                    name="Department"
                    placeholder="Enter your Department"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div> --}}

             <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                <select
                    name="department"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your Department</option>
                        <option value="Administration">Administration</option>
                        <option value="Business Office">Business Office</option>
                        <option value="CathLab">Cathlab</option>
                        <option value="Customer Service">Customer Service</option>
                        <option value="Endoscopy">Endoscopy</option>
                        <option value="Facility Management">Facility Management</option>
                        <option value="Finance">Finance</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Health Screening">Health Screening</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="International Marketing">Inpatient</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Management Office">Management Office</option>
                        <option value="Marketing & Brand Comm.">Marketing & Brand Comm.</option>
                        <option value="Medical Records">Medical Records</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Phlebotomy">Phlebotomy</option>
                        <option value="Procurement & Inventory">Procurement & Inventory</option>
                        <option value="Quality & Risk Management">Quality & Risk Management</option>
                        <option value="Radiology">Radiology</option>
                        <option value="Security">Security</option>
                        <option value="Tags">Tags</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Position</label>
                <input
                    type="Position"
                    name="Position"
                    placeholder="Enter your Position"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Request Type</label>

                <div class="space-y-2">
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="request_type[]"
                            value="HIS"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">HIS Vesalius Account</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="request_type[]"
                            value="Email"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Email</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="request_type[]"
                            value="Access Card"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Access Card</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="request_type[]"
                            value="VPN"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">VPN</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="request_type[]"
                            value="Resign/Deactive"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Resign/Deactive</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Add Access</label>
                <input
                    type="Add Access"
                    name="Add Access"
                    placeholder="Enter your Access for HIS Vesalius Account"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Remarks/Other</label>
                <input
                    type="Remarks/Other"
                    name="Remarks/Other"
                    placeholder="Remarks Resignation Date / Others"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <!-- Back and Submit Buttons -->
            <div class="flex justify-between items-center mt-6">
                <button
                    type="button"
                    onclick="window.history.back()"
                    class="rounded-lg bg-gray-500 px-4 py-2 font-semibold text-white hover:bg-gray-600 transition"
                >
                    Back
                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 transition"
                >
                    Submit
                </button>
            </div>

            {{-- <button
                type="submit"
                class="mt-4 w-full rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 transition"
            >
                Submit
            </button> --}}
        </form>
        </div>
@if(auth()->check())
    </x-layouts.app>
@else
        </div>
    </body>
    </html>
@endif
