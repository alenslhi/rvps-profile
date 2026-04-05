<nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-darkbg/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-bold text-brand dark:text-brand-light tracking-tighter">
                    RVPS<span class="text-gray-900 dark:text-white">.</span>
                </a>
            </div>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="/" class="text-gray-600 hover:text-brand dark:text-gray-300 dark:hover:text-brand-light transition-colors font-medium">Beranda</a>
                
                <a href="/galeri" class="text-gray-600 hover:text-brand dark:text-gray-300 dark:hover:text-brand-light transition-colors font-medium">Galeri</a>
                
                <a href="/blog" class="text-gray-600 hover:text-brand dark:text-gray-300 dark:hover:text-brand-light transition-colors font-medium">Blog</a>

                <button @click="darkMode = !darkMode" class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:text-brand dark:hover:text-brand-light transition-colors focus:outline-none">
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
            </div>
            
        </div>
    </div>
</nav>