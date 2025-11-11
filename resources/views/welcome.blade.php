{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IT Request System</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-zinc-50 dark:bg-zinc-900 min-h-screen">
        <!-- Header with Login/Register -->
        <header class="border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <x-app-logo class="h-8 w-auto" />
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">IT Request System</h1>
                    </div>
                    
                    @if (Route::has('login'))
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
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Submit an IT Request</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Select a form below to submit your IT request. No login required for submitting requests.
                </p>
            </div>

            <!-- Request Form Cards -->
            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- ITF001 Card -->
                    <a href="{{ route('itf001') }}" class="block group">
                        <div class="h-full bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all duration-200 shadow-sm hover:shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/50 transition-colors">
                                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            ITF001
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                            User ID Creation / Amendment / Deactivation
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center text-sm text-indigo-600 dark:text-indigo-400 font-medium group-hover:translate-x-1 transition-transform">
                                    Submit Request
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="h-1 bg-gradient-to-r from-indigo-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </div>
                    </a>

                    <!-- ITF002 Card -->
                    <a href="{{ route('itf002') }}" class="block group">
                        <div class="h-full bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all duration-200 shadow-sm hover:shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/50 transition-colors">
                                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            ITF002
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                            Doctor Registration
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center text-sm text-indigo-600 dark:text-indigo-400 font-medium group-hover:translate-x-1 transition-transform">
                                    Submit Request
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="h-1 bg-gradient-to-r from-indigo-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </div>
                    </a>
                </div>

                <!-- Info Section -->
                <div class="mt-12 text-center">
                    <div class="inline-flex items-center gap-2 px-6 py-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-800 dark:text-blue-300">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-semibold underline hover:text-blue-900 dark:hover:text-blue-200">
                                Log in
                            </a> 
                            to track your requests
                        </p>
                    </div>
                </div>
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
</html> --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IT Request System</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-neutral-950 dark:to-neutral-900 min-h-screen flex flex-col">
        <!-- Header with Navigation -->
        <header class="border-b border-gray-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <x-app-logo class="h-6 w-auto text-white" />
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">ITRS</h1>
                            <p class="text-xs text-gray-500 dark:text-gray-400">IT Request System</p>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    @if (Route::has('login'))
                        <nav class="flex items-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="inline-flex items-center px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-semibold transition-colors">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM9 19c-4.35 0-8 1.343-8 3v2h16v-2c0-1.657-3.65-3-8-3z"></path>
                                        </svg>
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-16">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <div class="inline-block mb-6">
                    <div class="flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 rounded-full border border-blue-200 dark:border-blue-800">
                        <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                        <p class="text-sm font-semibold text-blue-700 dark:text-blue-300">Welcome to ITRS</p>
                    </div>
                </div>
                
                <h2 class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                    Submit Your <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">IT Requests</span> with Ease
                </h2>
                
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto leading-relaxed">
                    Fast, simple, and secure request submission. No login required to get started. Track your requests in real-time once you create an account.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
                    <a href="{{ route('itf001') }}" 
                       class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Submit Request Now
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-neutral-800 hover:bg-gray-100 dark:hover:bg-neutral-700 text-gray-900 dark:text-white font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl border border-gray-200 dark:border-neutral-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Go to Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Request Form Cards Grid -->
            <div class="max-w-5xl mx-auto mb-16">
                <div class="mb-8 text-center">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Available Request Forms</h3>
                    <p class="text-gray-600 dark:text-gray-400">Choose the form that matches your request type</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- ITF001 Card -->
                    <a href="{{ route('itf001') }}" class="group block">
                        <div class="h-full bg-white dark:bg-neutral-800 rounded-2xl border border-gray-200 dark:border-neutral-700 hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 overflow-hidden">
                            <!-- Gradient Bar -->
                            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>

                            <div class="p-8">
                                <!-- Icon -->
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div class="mb-6">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        ITF001
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                                        User ID Creation, Amendment, and Deactivation requests
                                    </p>
                                </div>

                                <!-- Features -->
                                <ul class="space-y-2 mb-6 text-sm text-gray-600 dark:text-gray-400">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Quick processing
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Secure handling
                                    </li>
                                </ul>

                                <!-- CTA -->
                                <div class="flex items-center text-blue-600 dark:text-blue-400 font-semibold group-hover:translate-x-2 transition-transform">
                                    Submit Form
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- ITF002 Card -->
                    <a href="{{ route('itf002') }}" class="group block">
                        <div class="h-full bg-white dark:bg-neutral-800 rounded-2xl border border-gray-200 dark:border-neutral-700 hover:border-indigo-400 dark:hover:border-indigo-500 transition-all duration-300 shadow-lg hover:shadow-2xl hover:-translate-y-2 overflow-hidden">
                            <!-- Gradient Bar -->
                            <div class="h-2 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>

                            <div class="p-8">
                                <!-- Icon -->
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-indigo-50 dark:from-indigo-900/30 dark:to-indigo-800/20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div class="mb-6">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                        ITF002
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                                        Doctor Registration in the system
                                    </p>
                                </div>

                                <!-- Features -->
                                <ul class="space-y-2 mb-6 text-sm text-gray-600 dark:text-gray-400">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Verified credentials
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Priority processing
                                    </li>
                                </ul>

                                <!-- CTA -->
                                <div class="flex items-center text-indigo-600 dark:text-indigo-400 font-semibold group-hover:translate-x-2 transition-transform">
                                    Submit Form
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Info Banner -->
            <div class="max-w-5xl mx-auto mb-16">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900 dark:text-blue-200 mb-2">Track Your Requests</h4>
                            <p class="text-blue-800 dark:text-blue-300 text-sm leading-relaxed">
                                Create an account to submit requests and track their status in real-time. Get instant notifications on request updates and approvals.
                                <a href="{{ route('register') }}" class="font-semibold underline hover:text-blue-900 dark:hover:text-blue-100">
                                    Register now
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-gray-200 dark:border-neutral-800 bg-white dark:bg-neutral-900 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    <!-- Brand -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <x-app-logo class="h-5 w-auto text-white" />
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">Request Hub</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Streamline your IT request management with our modern platform.
                        </p>
                    </div>

                    <!-- Links -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('itf001') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Submit Request</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Log In</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Register</a></li>
                        </ul>
                    </div>

                    <!-- Info -->
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Help Center</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Contact Us</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Documentation</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-gray-200 dark:border-neutral-800 pt-8">
                    <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                        © {{ date('Y') }} Request Hub - IT Management System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>