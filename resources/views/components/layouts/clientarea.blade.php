<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <title>{{ $title }}</title>

    <meta name="description" content="{{ $description ?? 'Platform belajar interaktif untuk latihan dan persiapan LKS Web Technologies. Akses modul latihan, marking mandiri, dan berbagi materi untuk membantu siswa mencapai standar kompetisi nasional dan internasional.' }}">
    <meta name="keywords" content="web technologies, web technology, web tech, webtech, lks, lomba kompetensi siswa">
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo.jpg') }}">
    <link rel="icon" sizes="192x192" href="{{ asset('images/logo.jpg') }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/logo.jpg') }}">

    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description"
        content="{{ $description ?? 'Platform belajar interaktif untuk latihan dan persiapan LKS Web Technologies. Akses modul latihan, marking mandiri, dan berbagi materi untuk membantu siswa mencapai standar kompetisi nasional dan internasional.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $title }}">
    <meta property="article:modified_time" content="2024-01-10T15:28:37+00:00">
    <meta property="og:image" content="{{ asset('images/logo.jpg') }}">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'Platform belajar interaktif untuk latihan dan persiapan LKS Web Technologies. Akses modul latihan, marking mandiri, dan berbagi materi untuk membantu siswa mencapai standar kompetisi nasional dan internasional.' }}">
    <meta name="twitter:image" content="{{ asset('images/logo.jpg') }}">

    <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Dashboard"
        href="{{ route('dashboard') }}">
    <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Forum Diskusi" href="">
    <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Client Area"
        href="{{ route('login') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-gray-800 bg-gray-100">
    <x-toast /> 
    <div id="app" class="flex flex-col lg:flex-row min-h-screen">
        <aside id="sidebar" class="fixed lg:relative bg-white w-72 h-full lg:h-[112vh] top-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50 shadow-lg lg:shadow-none">
            <div class="p-6 flex flex-col gap-8 border-r h-full">
                <div class="flex justify-between items-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Web Technologies Logo" class="w-24 rounded-full">
                    <h1 class="ml-4 font-bold text-lg">Web Technologies</h1>
                    <button class="lg:hidden" id="closeSidebar" aria-label="Close Sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <nav class="flex flex-col gap-4">
                    <h3 class="font-semibold text-sm text-gray-500">GENERAL</h3>
                    <a href="{{ route('clientarea.dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('clientarea.dashboard') ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        <i class="fa fa-chart-bar text-lg"></i>
                        <span class="font-medium">Overview</span>
                    </a>
                    <a href="dashboard-my-people.html" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('clientarea.as') ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        <i class="fa fa-comments text-lg"></i>
                        <span class="font-medium">Forum Diskusi</span>
                    </a>
                    <a href="{{ route('clientarea.publish-module') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('clientarea.publish-module') ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        <i class="fa fa-hand-holding-heart text-lg"></i>
                        <span class="font-medium">Publish Module</span>
                    </a>
                    <a href="{{ route('clientarea.upload-assets') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('clientarea.upload-assets') ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        <i class="fa fa-cloud-upload-alt text-lg"></i>
                        <span class="font-medium">Upload Assets</span>
                    </a>
                    <a href="{{ route('logout') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('logout') ? 'bg-blue-200' : 'hover:bg-gray-100' }}">
                        <i class="fa fa-sign-out-alt text-lg"></i>
                        <span class="font-medium">Logout</span>
                    </a>
                </nav>
            </div>
        </aside>

        <main class="flex-1 p-6 lg:p-12 bg-gray-50">
            <header class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm mb-6 gap-2 max-w-4xl">
                <button id="hamburgerButton" class="lg:hidden" aria-label="Open Sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <form class="flex items-center h-10 w-[60%] lg:w-1/2 bg-gray-100 rounded-full px-4 py-2">
                    <input type="text" class="bg-transparent border-none w-full focus:outline-none text-sm" placeholder="Search ..." aria-label="Search">
                    <button type="submit" class="text-gray-500">
                        <img src="{{ asset('images/icons/search-normal.svg') }}" alt="Search Icon" class="w-5 h-5">
                    </button>
                </form>
                <div class="flex items-center justify-between gap-1 md:gap-6">
                    <a href="#" class="flex justify-center items-center w-10 h-10 rounded-full bg-gray-100">
                        <img src="{{ asset('images/icons/direct.svg') }}" alt="Direct Icon">
                    </a>
                    <a href="#" class="flex justify-center items-center w-10 h-10 rounded-full bg-gray-100">
                        <img src="{{ asset('images/icons/activity.svg') }}" alt="Activity Icon">
                    </a>
                    {{-- @dd(auth('web')->user()) --}}
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm text-gray-500">Howdy,</p>
                            <p class="font-bold">{{ explode(' ', auth()->user()->name)[0] }}</p>
                        </div>
                        <img src="{{ auth()->user()->avatar_url }}" alt="User Photo" class="w-10 h-10" style="border-radius: 50%;">
                    </div>
                </div>
            </header>

            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburgerButton = document.getElementById('hamburgerButton');
        const closeSidebar = document.getElementById('closeSidebar');

        hamburgerButton.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>
</body>

</html>
