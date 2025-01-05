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

        <!-- toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <div class="h-screen grow flex">
                @yield('sidebar')
                <div class="w-full">
                    @yield('content')
                </div>
            </div>
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

        <!-- flowbite scripts -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

        <!-- toastr scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @if(Session::has('action_message'))
            <script>
                toastr.options = {
                    'progressBar': true,
                    'closeButton': true,
                }

                toastr.success('{{ Session::get('action_message') }}', 'Success', {timeOut: 6000});
                // toastr.info('{{ Session::get('message') }}');
                // toastr.warning('{{ Session::get('message') }}');
                // toastr.error('{{ Session::get('message') }}');
            </script>
            {{ Session::forget('action_message') }}
        @endif
    </body>
</html>
