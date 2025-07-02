<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Moodify') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="//unpkg.com/alpinejs" defer></script>
 <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-100 text-gray-800 min-h-screen antialiased">

<div class="d-flex flex-column min-vh-100">
  
  {{-- Sidebar (fixed left) --}}
  @include('layouts.sidebar')

  {{-- Content wrapper (nav + main + footer) --}}
  <div class="flex-1 flex flex-col ml-64 min-h-screen overflow-x-hidden">

    {{-- Top Navbar (fixed top but starts after sidebar) --}}
    <div class="fixed top-0 left-64 right-0 z-40">
      @include('layouts.navigation')
    </div>

    {{-- Push content below navbar (navbar height ~64px) --}}
    <main class="pt-2 px-6 flex-grow">
      {{ $slot }}

      
    
    </main>

  </div>
   
</div>

@stack('scripts')


</body>
</html>
