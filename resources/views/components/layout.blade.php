<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name', 'MBA - Retail Store') }}</title>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body class="bg-white dark:bg-gray-900">
    <x-navheader></x-navheader>

    {{ $slot }}

    {{-- Script --}}
    @livewireScripts
</body>

</html>
