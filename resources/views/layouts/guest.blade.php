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

    <!-- Main Content Container -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 bg-vantage-800">

        <div class="w-full sm:max-w-md mt-6 px-4">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-vantage-900/60 font-medium">
            &copy; {{ date('Y') }} VantageHRIS. All rights reserved.
            <br><br>
            By Ambos, Joshua
        </div>

    </div>
</body>

</html>