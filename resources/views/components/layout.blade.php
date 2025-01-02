@props(['fixed' => false, 'activeRoute'=> null])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,600;1,600&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Job Space</title>
    @livewireStyles
   @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="mb-24">
       <x-nav-bar :activeRoute="$activeRoute"/>
    </div>

    <div class="mb-16 mt-20 space-y-10">
        <main class="mx-auto max-w-[986px]">
            {{ $slot }}
        </main>
    </div>
   <x-footer :fixed="$fixed" />
    @livewireScripts
</body>
</html>
