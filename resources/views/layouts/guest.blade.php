<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8fafc]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VantageHRIS') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-[#081a2b] antialiased bg-[#f8fafc] h-full flex items-center justify-center p-4 selection:bg-[#2982d6] selection:text-white">

    <div class="w-full max-w-md space-y-6">

        {{-- Brand Logo Element Header --}}
        <div class="flex flex-col items-center justify-center text-center space-y-3">
            <div class="w-12 h-12 bg-[#2982d6] rounded-xl flex items-center justify-center shadow-md">
                <span class="text-white font-extrabold text-2xl tracking-tighter">V</span>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-[#081a2b]">
                    Vantage<span class="text-[#2982d6] font-bold">HRIS</span>
                </h1>
                <p class="text-sm font-medium text-[#2168ab] mt-1">
                    Sign in to access your operational workspace
                </p>
            </div>
        </div>

        {{-- Authentication View Slot Frame --}}
        <div class="bg-white rounded-2xl shadow-sm border border-[#e2e8f0] p-6 sm:p-8 space-y-6">
            {{ $slot }}
        </div>

        {{-- Attribution Information Sign-off Block --}}
        <div class="text-center text-xs text-slate-500 font-medium space-y-1">
            <p>&copy; {{ date('Y') }} VantageHRIS. All rights reserved.</p>
            <p>By Ambos, Joshua</p>
        </div>

    </div>

</body>

<script>
    // Password visibility toggle

    function togglePassword() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    } </script>

</html>