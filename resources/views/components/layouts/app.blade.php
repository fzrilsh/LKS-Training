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
        <meta property="og:description" content="{{ $description ?? 'Platform belajar interaktif untuk latihan dan persiapan LKS Web Technologies. Akses modul latihan, marking mandiri, dan berbagi materi untuk membantu siswa mencapai standar kompetisi nasional dan internasional.' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $title }}">
        <meta property="article:modified_time" content="2024-01-10T15:28:37+00:00">
        <meta property="og:image" content="{{ asset('images/logo.jpg') }}">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">
        <meta property="og:image:type" content="image/jpeg">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description ?? 'Platform belajar interaktif untuk latihan dan persiapan LKS Web Technologies. Akses modul latihan, marking mandiri, dan berbagi materi untuk membantu siswa mencapai standar kompetisi nasional dan internasional.' }}">
        <meta name="twitter:image" content="{{ asset('images/logo.jpg') }}">

        <link rel="sitemap" title="Sitemap" href="{{ asset('sitemap.xml') }}" type="application/xml">
        <link rel="canonical" href="{{ url()->current() }}">

        <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Dashboard" href="{{ route('dashboard') }}">
        <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Forum Diskusi" href="">
        <link rel="alternate" type="application/rss+xml" title="{{ $title }} » Client Area" href="{{ route('login') }}">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>

        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script>
            new WOW().init();
        </script>

        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-800 bg-gray-100">
        <div class="ud-header absolute left-0 top-0 z-40 flex w-full items-center bg-transparent">
            <div class="container">
                <div class="relative -mx-4 flex items-center justify-between">
                    <div class="w-fit max-w-full px-4">
                        <a href="{{ route('dashboard') }}" class="navbar-logo block py-5">
                            <img src="{{ asset('images/logo.jpg') }}" alt="logo"
                                class="header-logo w-20 md:w-24 rounded-full" />
                        </a>
                    </div>
                    <div class="flex w-full items-center justify-between px-4">
                        <div class="m-auto">
                            <button id="navbarToggler"
                                class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden">
                                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
                                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
                                <span class="relative my-[6px] block h-[2px] w-[30px] bg-white"></span>
                            </button>
                            <nav id="navbarCollapse"
                                class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg dark:bg-dark-2 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:px-4 lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6 ">
                                <ul class="blcok lg:flex 2xl:ml-20 items-center">
                                    <li class="group relative">
                                        <a href="{{ route('dashboard') }}"
                                            class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70">
                                            Beranda
                                        </a>
                                    </li>
                                    <li class="group relative">
                                        <a href="https://github.com/fzrilsh/WebTech-Academy"
                                            class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10">
                                            Kontribusi
                                        </a>
                                    </li>
                                    <li class="group relative">
                                        <a href="#pricing"
                                            class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10">
                                            Forum Diskusi
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="flex items-center justify-end pr-16 lg:pr-0">
                            <div class="hidden sm:flex">
                                <a href="{{ route('clientarea.dashboard') }}" class="signUpBtn rounded-md bg-white bg-opacity-20 px-6 py-2 text-base font-medium text-white duration-300 ease-in-out hover:bg-opacity-100 hover:text-black">
                                    <i class="fas fa-lock mr-2"></i> Client Area
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot }}

        <footer class="wow fadeInUp relative z-10 bg-[#090E34] h-20 lg:h-[100px] text-white flex justify-center items-center" data-wow-delay=".15s">
            <div class="container">
                <div class="-mx-4 flex justify-center">
                    <p class="text-white text-gray-7">
                        Designed by
                        <a href="https://tailgrids.com" rel="nofollow noopner" target="_blank"
                            class="text-gray-1 hover:underline">
                            TailGrids and UIdeck
                        </a>
                    </p>
                </div>
            </div>
        </footer>

        @livewireScripts
        <script>
            let navbarToggler = document.querySelector("#navbarToggler");
            const navbarCollapse = document.querySelector("#navbarCollapse");
    
            navbarToggler.addEventListener("click", () => {
                navbarToggler.classList.toggle("navbarTogglerActive");
                navbarCollapse.classList.toggle("hidden");
            });
    
            document
                .querySelectorAll("#navbarCollapse ul li:not(.submenu-item) a")
                .forEach((e) =>
                    e.addEventListener("click", () => {
                        navbarToggler.classList.remove("navbarTogglerActive");
                        navbarCollapse.classList.add("hidden");
                    })
                );
        </script>
    </body>
</html>
