@props(['title' => 'Richard Profile | RVPS', 'description' => 'Creative & Tech Enthusiast. Dokumentasi portofolio dan artikel seputar pengembangan sistem informasi.', 'image' => asset('default-og.png')])

<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }"
      class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    
    <meta name="description" content="{{ $description }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-900 dark:bg-darkbg dark:text-gray-100 antialiased selection:bg-brand selection:text-white overflow-x-hidden">

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    @php
        $profile = \App\Models\Profile::first();
        $waNumber = $profile->whatsapp ?? '';
        
        // Membersihkan format nomor menjadi standar internasional (62)
        if(str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        } elseif(str_starts_with($waNumber, '+')) {
            $waNumber = substr($waNumber, 1);
        }
    @endphp

    @if($waNumber)
    <a href="https://wa.me/{{ $waNumber }}?text=Halo%20Richard,%20saya%20melihat%20portofolio%20website%20Anda%20dan%20tertarik%20untuk%20berdiskusi%20lebih%20lanjut." target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-[90] bg-[#25D366] text-white p-4 rounded-full shadow-xl hover:scale-110 hover:shadow-2xl transition-all duration-300 focus:outline-none flex items-center justify-center group">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.334.101.154.453.729.966 1.147.664.54 1.212.71 1.368.796.155.087.246.072.336-.029.09-.101.391-.462.493-.62.102-.158.204-.13.346-.079.143.05.908.428 1.065.504.157.075.26.116.299.181.039.065.039.376-.105.781zM12.031 2C6.495 2 2 6.494 2 12.029c0 1.764.456 3.492 1.328 5.011l-1.328 4.96 5.064-1.33c1.464.793 3.125 1.21 4.834 1.21h.005c5.534 0 10.03-4.494 10.03-10.03C22.062 6.494 17.568 2 12.031 2zm0 18.064c-1.492 0-2.898-.4-4.148-1.156l-.297-.178-3.086.81.821-3.008-.196-.312c-.829-1.32-1.267-2.839-1.267-4.423 0-4.489 3.649-8.138 8.138-8.138 4.49 0 8.138 3.649 8.138 8.138s-3.648 8.14-8.138 8.14z"/>
        </svg>
    </a>
    @endif

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50, duration: 800, easing: 'ease-out-cubic' });
    </script>
</body>
</html>