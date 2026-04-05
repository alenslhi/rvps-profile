<!-- Navbar Mengambang (Floating Pill) -->
<nav x-data="{ scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'top-4' : 'top-6'"
     class="fixed inset-x-0 z-50 transition-all duration-500 flex justify-center px-4 md:px-6 pointer-events-none">
    
    <div class="pointer-events-auto w-full max-w-4xl bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border border-gray-200 dark:border-gray-800 shadow-sm rounded-full px-5 py-3 flex items-center justify-between transition-colors">
        
        <!-- Logo -->
        <a href="/" class="text-xl font-extrabold tracking-tight text-gray-900 dark:text-white hover:opacity-80 transition-opacity">
            RVPS<span class="text-gray-400">.</span>
        </a>

        <!-- Menu Links -->
        <div class="hidden md:flex items-center gap-8 text-[13px] uppercase tracking-wider font-bold">
            <a href="/" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Beranda</a>
            <a href="/galeri" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Galeri</a>
            <a href="/blog" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Blog</a>
        </div>

        <!-- Right Side: Dark Mode Toggle -->
        <div class="flex items-center gap-4">
            <!-- Menu Mobile (Burger Icon) opsional jika kamu butuh -->
            <button class="md:hidden p-2 text-gray-500 dark:text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>

            <!-- Toggle Tombol Bulan / Matahari -->
            <button @click="toggleTheme()" 
                    class="p-2.5 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700">
                
                <!-- Sun Icon (Matahari, muncul saat mode gelap aktif) -->
                <svg x-show="isDark" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                
                <!-- Moon Icon (Bulan, muncul saat mode terang aktif) -->
                <svg x-show="!isDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>

    </div>
</nav>