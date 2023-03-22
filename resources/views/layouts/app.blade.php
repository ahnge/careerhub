<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Font awesome -->
  <script src="https://kit.fontawesome.com/9cb1209535.js" crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased text-gray-900">
  <div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="bg-white shadow">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endif

    @if (session('flashes'))
      <x-flashes :flashes="session('flashes')" />
    @endif

    @if ($errors->any())
      <x-flashes :flashes="$errors->all()" />
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
      <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <span class="text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}</span>
      </div>
    </footer>
  </div>
</body>

</html>
