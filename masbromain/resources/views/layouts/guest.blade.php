<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMERAH - TELKOMSEL</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

</head>

<body class="bg-[#fff5f5] text-white min-h-screen">
    <div class="max-w-sm mx-auto min-h-screen">

        <!-- masbro -->
        <div class="mt-5">
            <x-masbro />
        </div>

        <!-- Login Form Container -->
        <div class="px-6 py-1">
            <div class="action-gradient rounded-2xl p-6 shadow-xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
