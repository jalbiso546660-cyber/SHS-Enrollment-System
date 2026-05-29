<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>University of Mindanao Senior High School</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            <script src="{{ mix('js/app.js') }}" defer></script>
        @endif
        <link rel="icon" type="image/png" href="{{ asset('images/Um logo.png') }}">

    </head>
    <body class="font-sans antialiased bg-white text-gray-900">
        <div class="bg-white text-gray-900">
            <img id="background" class="fixed top-0 left-0 w-full h-full object-cover opacity-10 -z-10" src="{{ asset('images/UM_BE.jpg') }}" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <img src="{{ asset('images/Um logo.png') }}" 
                                 class="h-40 w-auto">
                        </div>
                        <div class="flex flex-col items-center lg:col-start-2">
                            <!-- Login navigation -->
                            @if (Route::has('login'))
                                <nav class="mt-4 flex gap-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" 
                                           class="w-full py-4 px-6 border border-transparent rounded-md shadow-sm text-white text-xl font-medium bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                                            Dashboard
                                        </a>    
                                    @else
                                        <button type="button" 
                                                class="w-full py-4 px-6 border border-transparent rounded-md shadow-sm text-white text-xl font-medium bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#loginModal">
                                            Log in
                                        </button>
                                    @endauth
                                </nav>
                            @endif
                        </div>
                    </header>

                        <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <a
                                
                                id="docs-card"
                                <div style="background-color: #800000;"
                                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                                       
                                <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                    
                                    <img
                                        src="{{ asset('images/um_ps.jpg') }}"
                                        alt="um capmus"
                                        class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-[#800000] to-[#800000]">

                                </div>
                                
                                </div>

                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">

                                        <div class="pt-3 sm:pt-5 lg:pt-0">
                                            <h2 class="text-xl font-semibold text-black dark:text-white">University of Mindanao</h2>

                                            <p class="mt-4 text-sm/relaxed text-white">
                                                University of Mindanao is a private university in Davao City, Philippines. It was founded in 1946 by Atty. Guillermo E. Torres Sr.
                                                The university is known for its commitment to academic excellence and has produced numerous graduates who have excelled in various fields.
                                                It offers three strands in Senior High School: Science, Technology, Engineering, and Mathematics (STEM), Accountancy, Business, and Management (ABM), and Humanities and Social Sciences (HUMSS).
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- STEM Card -->
                            <div class="card text-bg-dark rounded-lg overflow-hidden w-full max-w-sm bg-[#800000]">
                                <div class="relative h-48">
                                    <img src="{{ asset('images/stem.jpg') }}" 
                                         class="w-full h-full object-cover" 
                                         alt="STEM">
                                    <div class="absolute inset-0 bg-[#800000]/80 p-4 flex flex-col justify-end">
                                        <h5 class="card-title text-lg font-semibold text-white mb-1"></h5>
                    
                                    </div>
                                </div>
                            </div>

                            <!-- ABM Card -->
                            <div class="card text-bg-dark rounded-lg overflow-hidden w-full max-w-sm bg-[#800000]">
                                <div class="relative h-48">
                                    <img src="{{ asset('images/ABM.jpg') }}" 
                                         class="w-full h-full object-cover" 
                                         alt="ABM">
                                    <div class="absolute inset-0 bg-[#800000]/80 p-4 flex flex-col justify-end">
                                        <h5 class="card-title text-lg font-semibold text-white mb-1"></h5>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- HUMSS Card -->
                            <div class="card text-bg-dark rounded-lg overflow-hidden w-full max-w-sm bg-[#800000]">
                                <div class="relative h-48">
                                    <img src="{{ asset('images/HUMSS.jpg') }}" 
                                         class="w-full h-full object-cover" 
                                         alt="HUMSS">
                                    <div class="absolute inset-0 bg-[#800000]/80 p-4 flex flex-col justify-end">
                                        <h5 class="card-title text-lg font-semibold text-white mb-1"></h5>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <p>
                            &copy; {{ date('Y') }} University of Mindanao. All rights reserved.
                        </p>
                    </footer>
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div id="loginModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <!-- Increased width and height -->
    <div class="bg-white rounded-lg shadow-xl w-[600px] h-[600px] mx-4 p-8">
        <!-- Adjusted close button position -->
        <div class="flex justify-right mb-4">
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeLoginModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="px-6 pb-6">
            <!-- Increased logo size -->
            <div class="text-center mb-8">
                <p class="text-3xl font-semibold text-gray-700">Login</p><img src="{{ asset('images/UM_name.png') }}" class="w-16 h-20 mx-auto mt-4" alt="University of Mindanao">
                <p class="text-lg text-black-500">Welcome back! Please enter your credentials.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <!-- Added more spacing between elements -->
                <div class="space-y-8 max-w-2xl mx-auto">
                    <div>
                        <label for="email" class="block text-xl font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required autofocus
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 text-lg h-12">
                    </div>

                    <div>
                        <label for="password" class="block text-xl font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 text-lg h-12">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                               class="h-6 w-6 rounded border-gray-300 text-red-600 focus:ring-red-600">
                        <label for="remember" class="ml-3 text-lg text-gray-700">Remember me</label>
                    </div>

                    <!-- Smaller button size -->
                    <button type="submit" 
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white text-base font-medium bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                        Log in
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-6">
                            <a href="{{ route('password.request') }}" 
                               class="text-base text-gray-600 hover:text-red-600">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add this script at the bottom of the body -->
<script>
    function closeLoginModal() {
        document.getElementById('loginModal').classList.add('hidden');
    }

    document.querySelector('[data-bs-target="#loginModal"]').addEventListener('click', function() {
        document.getElementById('loginModal').classList.remove('hidden');
    });

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.json();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
    </body>
</html>
