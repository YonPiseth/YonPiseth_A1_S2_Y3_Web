<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4QG6fZaSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTI7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    @include('partials.header')
    <main class="container mx-auto p-6">@yield('content')</main>
    @include('partials.footer')
    <!-- Scripts -->
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1cDi7MGQ1Z7Qa0bqlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFcozFSxQBwxHKO" crossorigin="anonymous"></script>
</body>
</html> 