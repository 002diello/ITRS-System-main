<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITF002 - Doctor Registration</title>
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
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Doctor Registration</h1>
            <p class="text-gray-600 dark:text-gray-400">Form ITF002</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-700 p-8">
            <form action="{{ route('itf002.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name *</label>
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of Birth</label>
                    <input
                        type="date"
                        name="date_of_birth"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Mobile Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mobile Number</label>
                    <input
                        type="text"
                        name="mobile_number"
                        placeholder="Enter your Mobile Number"
                        required
                        maxlength="15"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Gender -->
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

                <!-- Nationality -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nationality</label>
                    <input
                        type="text"
                        name="Nationality"
                        placeholder="Enter your Nationality"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- MMC Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">MMC Number *</label>
                    <input
                        type="text"
                        name="MMC Number"
                        placeholder="Enter your MMC number"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Effective Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Effective Date *</label>
                    <input
                        type="date"
                        name="effective_date"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Speciality -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Speciality</label>
                    <select
                        name="Speciality"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                            <option value="" disabled selected>Select your Speciality</option>
                            <option value="ANAESTHESIOLOGY">ANAESTHESIOLOGY</option>
                            <option value="CARDIOLOGY">CARDIOLOGY</option>
                            <option value="DENTAL">DENTAL</option>
                            <option value="DERMATOLOGY">DERMATOLOGY</option>
                            <option value="ENDOCRINOLOGY">ENDOCRINOLOGY</option>
                            <option value="GASTROENTEROLOGY">GASTROENTEROLOGY</option>
                            <option value="GENERAL MEDICINE">GENERAL MEDICINE</option>
                            <option value="GENERAL SURGERY">GENERAL SURGERY</option>
                            <option value="INFECTION PHYSICIAN">INFECTION PHYSICIAN</option>
                            <option value="INTERNAL MEDICINE">INTERNAL MEDICINE</option>
                            <option value="OCCUPATIONAL THERAPY">OCCUPATIONAL THERAPY</option>
                            <option value="ONCOLOGY">ONCOLOGY</option>
                            <option value="ORTHOPEDICS">ORTHOPEDICS</option>
                            <option value="OTORHINOLARYNGOLOGY (ENT)">OTORHINOLARYNGOLOGY (ENT)</option>
                            <option value="PATHOLOGY">PATHOLOGY</option>
                            <option value="PHYSIOTHERAPY">PHYSIOTHERAPY</option>
                            <option value="PLASTIC SURGEON">PLASTIC SURGEON</option>
                            <option value="RADIOLOGY">RADIOLOGY</option>
                            <option value="REHABILITATION">REHABILITATION</option>
                            <option value="SPORT PHYSICIAN">SPORT PHYSICIAN</option>
                            <option value="UROLOGIST">UROLOGIST</option>
                    </select>
                </div>

                <!-- Grade Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grade Type *</label>
                    <select
                        name="Grade Type"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your grade</option>
                        <option value="Visiting">Visiting</option>
                        <option value="Locum">Locum</option>
                        <option value="Resident">Resident</option>
                    </select>
                </div>

                <!-- Clinic Room Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Clinic Room Number *</label>
                    <input
                        type="text"
                        name="Clinic Room Number"
                        placeholder="Enter your clinic room number"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                    />
                </div>

                <!-- Interval Time Table -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Interval Time (Minute):</label>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-400 text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                                    <th class="border border-gray-400 px-4 py-2 text-center"></th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">MINIMUM</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">MAX</th>
                                    <th class="border border-gray-400 px-4 py-2 text-center">DEFAULT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-gray-50 dark:bg-neutral-900">
                                    <td class="border border-gray-400 px-4 py-2 font-medium bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">NEW CASE:</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="new_min" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="new_max" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="new_default" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                </tr>
                                <tr class="bg-gray-50 dark:bg-neutral-900">
                                    <td class="border border-gray-400 px-4 py-2 font-medium bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">FOLLOW-UP:</td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="follow_min" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="follow_max" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                    <td class="border border-gray-400 px-4 py-2 text-center"><input type="number" name="follow_default" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Roster Section -->
                <div x-data="{ days: { Sunday: false, Monday: false, Tuesday: false, Wednesday: false, Thursday: false, Friday: false, Saturday: false }}">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Roster</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Sunday" x-model="days.Sunday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Sunday</span>
                            <template x-if="days.Sunday">
                                <input type="text" name="remark_sunday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Monday" x-model="days.Monday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Monday</span>
                            <template x-if="days.Monday">
                                <input type="text" name="remark_monday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Tuesday" x-model="days.Tuesday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Tuesday</span>
                            <template x-if="days.Tuesday">
                                <input type="text" name="remark_tuesday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Wednesday" x-model="days.Wednesday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Wednesday</span>
                            <template x-if="days.Wednesday">
                                <input type="text" name="remark_wednesday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Thursday" x-model="days.Thursday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Thursday</span>
                            <template x-if="days.Thursday">
                                <input type="text" name="remark_thursday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Friday" x-model="days.Friday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Friday</span>
                            <template x-if="days.Friday">
                                <input type="text" name="remark_friday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="roster_day[]" value="Saturday" x-model="days.Saturday" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900" />
                            <span class="text-gray-800 dark:text-gray-200">Saturday</span>
                            <template x-if="days.Saturday">
                                <input type="text" name="remark_saturday" placeholder="Add Time (e.g., 9am - 5pm)" class="ml-2 flex-1 rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200" />
                            </template>
                        </label>
                    </div>
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
