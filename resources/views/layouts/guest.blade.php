<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VantageHRIS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-vantage-900 antialiased bg-vantage-bg relative overflow-x-hidden min-h-screen">

    <!-- Decorative Header Background -->
    <div class="absolute top-0 left-0 w-full h-[45vh] bg-vantage-900 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-vantage-800 to-transparent opacity-50"></div>
    </div>

    <!-- Main Content Container -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">

        <!-- The $slot is where your login.blade.php card gets injected -->
        <div class="w-full sm:max-w-md mt-6 px-4">
            {{ $slot }}
        </div>

        <!-- Footer text for the authentication pages -->
        <div class="mt-8 text-center text-sm text-vantage-900/60 font-medium">
            &copy; {{ date('Y') }} VantageHRIS. All rights reserved.
        </div>

    </div>
</body>

</html>