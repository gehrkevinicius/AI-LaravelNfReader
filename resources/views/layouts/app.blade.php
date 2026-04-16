<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @hasSection('title')
            @yield('title') — {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-full bg-zinc-100 font-sans text-zinc-900 antialiased">
    <header class="border-b-4 border-sky-500 bg-zinc-900 text-zinc-100">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4 sm:px-6">
            <a href="{{ url('/') }}" class="group rounded-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">
                <span class="text-xl font-semibold tracking-tight text-white group-hover:text-sky-200">{{ config('app.name', 'Notas fiscais') }}</span>
            </a>
            <nav class="flex items-center gap-4 text-sm font-medium">
                <a href="{{ url('/') }}" class="rounded-sm text-zinc-200 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">Enviar</a>
                <a href="{{ route('notas.index') }}" class="rounded-sm text-zinc-200 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">Notas</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6 sm:py-10">
        @yield('content')
    </main>

    <footer class="mx-auto max-w-5xl px-4 pb-10 text-center text-xs text-zinc-500 sm:px-6">
        {{ config('app.name') }}
    </footer>
</body>
</html>
