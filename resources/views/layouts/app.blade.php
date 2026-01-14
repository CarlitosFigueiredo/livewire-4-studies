<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="h-screen flex gap-8">

        <aside class="min-w-64 bg-zinc-100 h-full">

        </aside>

        <main class="pt-8">

            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>
