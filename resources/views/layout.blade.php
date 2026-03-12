<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Post Master</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<!-- Hauptlayout der Seite.

Definiert die grundlegende Seitenstruktur mit Navigation, Hauptinhalt und Footer.
Die Navigation zeigt Links zu Nutzern, Beiträgen sowie Login/Registrierung oder
Benutzerinformationen für angemeldete Nutzer. -->
<body class="min-h-screen flex flex-col bg-white text-black dark:bg-gray-900 dark:text-white">
    <nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">Master Post</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                    <li>
                        <a href="{{ route('users.index') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent" aria-current="page">Users</a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Posts</a>
                    </li>
                    @guest
                    <li>
                        <a href="{{ route('show.register') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Register</a>
                    </li>
                    <li>
                        <a href="{{ route('show.login') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Login</a>
                    </li>
                    @endguest
                    @auth
                    <li>
                        <a href="{{ route('users.show', Auth::id())}}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Hello, {{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="cursor-pointer block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Logout</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-1 pt-16 my-4">
        <div class="max-w-[1300px] mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-default p-4 text-center">
        <p>&copy; {{ date("Y") }}</p>
    </footer>
</body>

</html>
