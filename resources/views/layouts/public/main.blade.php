<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        @yield('cdn')

        <style>
            #backToTopBtn {
                display: none; /* Hidden by default */
                position: fixed; /* Fixed position */
                bottom: 20px; /* Place the button at the bottom of the page */
                right: 30px; /* Place the button 30px from the right */
                z-index: 99; /* Make sure it does not overlap */
                border: none; /* Remove borders */
                outline: none; /* Remove outline */
                cursor: pointer; /* Add a mouse pointer on hover */
            }
        </style>

        @include('pages.public.cookie-policy.style')

        @yield('styles')
        @stack('styles')
    </head>
    <body class="font-sans antialiased h-screen flex flex-col justify-between">

        @yield('modals')

        <!-- Header -->
        @include('layouts.public.header')

        <!-- Main -->
        <main class="grow bg-slate-50">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.public.footer')

        <button id="backToTopBtn" title="Go to top" class="bg-blue-500 hover:bg-blue-600 rounded-full p-4 text-white transition-colors duration-300 flex items">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
            </svg>
        </button>

        @include('pages.public.cookie-policy.popup')
        @include('pages.public.cookie-policy.script')

        @yield('scripts')
        @stack('scripts')

        <script>
            $(document).ready(function() {
                // Show or hide the button based on scroll position
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 300) {
                        $('#backToTopBtn').fadeIn();
                    } else {
                        $('#backToTopBtn').fadeOut();
                    }
                });

                // Scroll to the top when the button is clicked
                $('#backToTopBtn').click(function(event) {
                    event.preventDefault();
                    $('html, body').animate({scrollTop: 0}, 500);
                    return false;
                });
            });
        </script>
    </body>
</html>
