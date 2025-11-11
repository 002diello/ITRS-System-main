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
 <x-layouts.app :title="__('ITF002 Doctor Registration')">
    <div class="max-w-2xl mx-auto bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-md">
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ITF002 - Doctor Registration</title>
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
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Doctor Information</h2>

        <form action="{{ route('itf002.store') }}" method="POST" class="space-y-4">
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

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input
                    type="text"
                    name="email"
                    placeholder="Enter your email"
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
                    type="text"
                    name="Nationality"
                    placeholder="Enter your Nationality"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            {{-- <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                <input
                    type="text"
                    name="Department"
                    placeholder="Enter your Department"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div> --}}

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">MMC Number</label>
                <input
                    type="integer"
                    name="MMC Number"
                    placeholder="Enter your MMC Number"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Effective Date</label>
                <input
                    type="date"
                    name="effective_date"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

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

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grade Type</label>
                <select
                    name="Grade Type"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400">
                        <option value="" disabled selected>Select your Grade</option>
                        <option value="Visiting">Visiting</option>
                        <option value="Locum">Locum</option>
                        <option value="Resident">Resident</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Clinic Room</label>
                <input
                    type="integer"
                    name="Clinic Room Number"
                    placeholder="Enter your Clinic Room"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-100 dark:focus:border-indigo-400"
                />
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">INTERVAL TIME (MINUTE) :</label>
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
                            <td class="border border-gray-400 px-4 py-2 font-medium bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                                NEW CASE :
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="new_min" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="new_max" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="new_default" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-neutral-900">
                            <td class="border border-gray-400 px-4 py-2 font-medium bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-gray-200">
                                FOLLOW-UP :
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="follow_min" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="follow_max" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">
                                <input type="number" name="follow_default" min="0" class="w-full border-none text-center focus:ring-0 bg-transparent" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div x-data="{ days: {
                            Sunday: false,
                            Monday: false,
                            Tuesday: false,
                            Wednesday: false,
                            Thursday: false,
                            Friday: false,
                            Saturday: false
                        }}">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Roster</label>

                <div class="space-y-2">
                    <!-- Sunday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Sunday"
                            x-model="days.Sunday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Sunday</span>

                        <template x-if="days.Sunday">
                            <input type="text" name="remark_sunday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Monday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Monday"
                            x-model="days.Monday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Monday</span>

                        <template x-if="days.Monday">
                            <input type="text" name="remark_monday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Tuesday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Tuesday"
                            x-model="days.Tuesday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Tuesday</span>

                        <template x-if="days.Tuesday">
                            <input type="text" name="remark_tuesday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Wednesday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Wednesday"
                            x-model="days.Wednesday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Wednesday</span>

                        <template x-if="days.Wednesday">
                            <input type="text" name="remark_wednesday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Thursday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Thursday"
                            x-model="days.Thursday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Thursday</span>

                        <template x-if="days.Thursday">
                            <input type="text" name="remark_thursday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Friday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Friday"
                            x-model="days.Friday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Friday</span>

                        <template x-if="days.Friday">
                            <input type="text" name="remark_friday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>

                    <!-- Saturday -->
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="roster_day[]"
                            value="Saturday"
                            x-model="days.Saturday"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-700 dark:bg-neutral-900"
                        />
                        <span class="text-gray-800 dark:text-gray-200">Saturday</span>

                        <template x-if="days.Saturday">
                            <input type="text" name="remark_saturday" placeholder="Add Time (e.g., 9am - 5pm)"
                                class="ml-2 flex-1 rounded-md border-gray-300 px-2 py-1 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:text-gray-200">
                        </template>
                    </label>
                </div>
            </div>

            <!-- Back and Submit Buttons -->
            <div class="flex justify-between items-center mt-6">
                <button type="button"onclick="window.history.back()"class="rounded-lg bg-gray-500 px-4 py-2 font-semibold text-white hover:bg-gray-600 transition">Back</button>
                <button type="submit"class="rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 transition">Submit</button>
            </div>
        </form>
        </div>
@if(auth()->check())
    </x-layouts.app>
@else
        </div>
    </body>
    </html>
@endif




