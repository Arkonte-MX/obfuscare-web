<!DOCTYPE html>
<html lang="es" class="bg-zinc-950">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen">
    <x-encabezado.contenedor></x-encabezado.contenedor>

    <div class="flex flex-row">
        <div class="w-1/6">
        </div>
        <div class="flex flex-col flex-grow items-center justify-center px-4 pt-24">
            {{ $contenido }}
        </div>
        <div class="w-1/6">
        </div>
    </div>

    <footer class="p-4">
        <x-pie.contenedor></x-pie.contenedor>
    </footer>
</body>

</html>