<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITF001 - User ID Creation / Amendment / Deactivation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-50 dark:bg-zinc-900 min-h-screen">
    <!-- Header -->
    <header class="border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">IT Request System</h1>
                </div>
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium transition">
                            Log in
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">User ID Creation / Amendment / Deactivation</h1>
            <p class="text-gray-600 dark:text-gray-400">Form ITF001</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-8">
            <form action="{{ route('itf001.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name *</label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your full name"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NRIC / Passport No -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NRIC / Passport No *</label>
                    <input
                        type="text"
                        name="nric"
                        placeholder="Enter your NRIC or Passport number"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                    @error('nric')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of Birth *</label>
                    <input
                        type="date"
                        name="date_of_birth"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                    @error('date_of_birth')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender *</label>
                    <select
                        name="Gender"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('Gender')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nationality -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nationality *</label>
                    <input
                        type="text"
                        name="Nationality"
                        placeholder="Enter your nationality"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                    @error('Nationality')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address *</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-zinc-900 dark:text-white sm:text-sm"
                        placeholder="Enter your email address for notifications">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department *</label>
                    <select
                        name="department"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your department</option>
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
                        <option value="Inpatient">Inpatient</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Management Office">Management Office</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Medical Records">Medical Records</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Pharmacy">Pharmacy</option>
                    </select>
                    @error('department')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Position</label>
                    <input
                        type="text"
                        name="Position"
                        placeholder="Enter your position"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Request Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Request Type</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="request_type[]" value="HIS" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900">
                            <span class="text-gray-800 dark:text-gray-200">HIS Vesalius Account</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="request_type[]" value="Email" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900">
                            <span class="text-gray-800 dark:text-gray-200">Email</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="request_type[]" value="Access Card" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900">
                            <span class="text-gray-800 dark:text-gray-200">Access Card</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="request_type[]" value="VPN" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900">
                            <span class="text-gray-800 dark:text-gray-200">VPN</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="request_type[]" value="Resign/Deactive" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900">
                            <span class="text-gray-800 dark:text-gray-200">Resign/Deactive</span>
                        </label>
                    </div>
                </div>

                <!-- Add Access -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Add Access</label>
                    <textarea
                        name="Add Access"
                        placeholder="Specify access requirements (e.g., systems, applications, folders)"
                        rows="3"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    ></textarea>
                </div>

                <!-- Remarks -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Remarks / Other</label>
                    <textarea
                        name="Remarks/Other"
                        placeholder="Add any additional remarks (e.g., Resignation Date)"
                        rows="4"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    ></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-auto border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                © {{ date('Y') }} IT Request System. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
