<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">{{ $title ?? 'Website Profile RVPS' }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        @media (min-width: 768px) { body { cursor: none; } a, button, input, [role="button"], .cursor-pointer { cursor: none; } }
        .page-transition { opacity: 0; transform: translateY(10px); transition: opacity 0.4s ease, transform 0.4s ease; }
        .page-loaded { opacity: 1; transform: translateY(0); }
        
        /* EASTER EGG CSS */
        .barrel-roll { animation: roll 2s ease-in-out; }
        @keyframes roll { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        
        body.hacker-mode { background-color: #000 !important; }
        .hacker-mode * { 
            color: #0f0 !important; border-color: #0f0 !important; background-color: transparent !important; 
            font-family: 'Courier New', Courier, monospace !important; box-shadow: none !important;
        }
        .hacker-mode img { filter: sepia(100%) hue-rotate(80deg) saturate(400%); opacity: 0.8; }
    </style>

    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } } }
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark') } else { document.documentElement.classList.remove('dark') }
    </script>
</head>

<body x-data="{ 
        isDark: document.documentElement.classList.contains('dark'),
        cmdOpen: false, searchQuery: '', easterToast: '', showEasterToast: false,
        isHacker: false, isRolling: false,
        keys: [], konami: ['ArrowUp','ArrowUp','ArrowDown','ArrowDown','ArrowLeft','ArrowRight','ArrowLeft','ArrowRight','b','a'],
        hackKeys: [], hackWord: ['h','a','c','k'],
        
        checkEasterEggs(e) {
            this.keys.push(e.key);
            if (this.keys.length > this.konami.length) this.keys.shift();
            if (this.keys.join(',') === this.konami.join(',')) {
                this.isRolling = true; this.triggerToast('Cheat activated! +99 Aura');
                setTimeout(() => this.isRolling = false, 2500); this.keys = [];
            }
            
            this.hackKeys.push(e.key.toLowerCase());
            if (this.hackKeys.length > this.hackWord.length) this.hackKeys.shift();
            if (this.hackKeys.join('') === this.hackWord.join('')) {
                this.isHacker = true; this.triggerToast('System Bypassed. Access granted.');
                setTimeout(() => this.isHacker = false, 10000); this.hackKeys = [];
            }
        },
        triggerToast(msg) {
            this.easterToast = msg; this.showEasterToast = true;
            setTimeout(() => this.showEasterToast = false, 3000);
        },
        
        commands: [
            { id: 1, icon: '🏠', name: 'Ke Beranda', action: () => window.location.href = '/' },
            { id: 2, icon: '📸', name: 'Lihat Semua Galeri', action: () => window.location.href = '/galeri' },
            { id: 3, icon: '📝', name: 'Baca Artikel & Jurnal', action: () => window.location.href = '/blog' },
            { id: 4, icon: '🌗', name: 'Ganti Tema Gelap / Terang', action: 'toggleTheme' },
            { id: 5, icon: '🎉', name: 'Salin Link Website', action: 'copyLink' },
            { id: 6, icon: '🕵️', name: '[Easter Egg] Ketik huruf h-a-c-k pelan-pelan di keyboard...', action: () => alert('Ssst, jangan bilang siapa-siapa. Coba ketik langsung sekarang!') },
            { id: 7, icon: '🕹️', name: '[Easter Egg] Masukkan kode: ⬆️ ⬆️ ⬇️ ⬇️ ⬅️ ➡️ ⬅️ ➡️ B A', action: () => alert('Gunakan tombol panah dan huruf di keyboardmu. Dilarang pakai Caps Lock!') },
            { id: 8, icon: '👉', name: '[Easter Egg] Klik titik (.) pada logo RVPS di kiri atas', action: () => alert('Cari tulisan RVPS. di pojok, lalu klik titiknya!') },
            { id: 9, icon: '🏃', name: '[Easter Egg] Scroll paling bawah, cari tombol samar', action: () => alert('Coba tangkap tombolnya kalau kamu bisa!') },
            { id: 10, icon: '😵', name: '[Easter Egg] Spam klik foto profil yang miring-miring', action: () => alert('Klik foto wajahnya 5 kali dengan cepat!') }
        ],
        get filteredCommands() {
            if (this.searchQuery === '') return this.commands;
            return this.commands.filter(c => c.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
        },
        executeCommand(cmd) {
            if(cmd.action === 'toggleTheme') { this.toggleTheme(); this.cmdOpen = false; }
            else if(cmd.action === 'copyLink') { 
                navigator.clipboard.writeText(window.location.origin); 
                confetti({ particleCount: 150, spread: 80, origin: { y: 0.6 }, zIndex: 999999 });
                this.cmdOpen = false; 
            }
            else { cmd.action(); }
        },
        toggleTheme() {
            this.isDark = !this.isDark;
            if (this.isDark) { document.documentElement.classList.add('dark'); localStorage.theme = 'dark'; } 
            else { document.documentElement.classList.remove('dark'); localStorage.theme = 'light'; }
        },
        cursorX: 0, cursorY: 0, cursorHover: false,
        updateCursor(e) { this.cursorX = e.clientX; this.cursorY = e.clientY; }
      }" 
      @mousemove.window="updateCursor($event)"
      @mouseover.window="cursorHover = ['A','BUTTON','INPUT'].includes($event.target.tagName) || $event.target.closest('a') || $event.target.closest('button') || $event.target.classList.contains('cursor-pointer')"
      @keyup.window="checkEasterEggs($event)"
      @keydown.window.prevent.ctrl.k="cmdOpen = !cmdOpen"
      @keydown.window.prevent.meta.k="cmdOpen = !cmdOpen"
      @keydown.escape.window="cmdOpen = false"
      :class="{ 'hacker-mode': isHacker, 'barrel-roll': isRolling }"
      class="bg-gray-50 dark:bg-[#09090b] text-gray-900 dark:text-gray-100 font-sans antialiased min-h-screen flex flex-col selection:bg-gray-900 selection:text-white transition-colors duration-500 overflow-x-hidden">
    
    <!-- Kursor Custom -->
    <div class="hidden md:block pointer-events-none fixed top-0 left-0 z-[999999] transition-transform duration-75 ease-out" :style="`transform: translate(${cursorX}px, ${cursorY}px)`">
        <div class="absolute -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-gray-900 dark:bg-white rounded-full transition-all duration-200" :class="cursorHover ? 'scale-[2.5] opacity-50' : 'scale-100 opacity-100'"></div>
        <div class="absolute -translate-x-1/2 -translate-y-1/2 w-8 h-8 border border-gray-900 dark:border-white rounded-full transition-all duration-300 delay-75" :class="cursorHover ? 'scale-150 opacity-0' : 'scale-100 opacity-50'"></div>
    </div>

    <!-- MAIN CONTENT -->
    <main id="main-content" class="flex-grow page-transition">
        {{ $slot }}
    </main>

    <!-- TOAST EASTER EGG -->
    <div x-show="showEasterToast" style="display: none;" x-transition class="fixed top-10 left-1/2 -translate-x-1/2 z-[999999] bg-black text-green-400 border border-green-500 px-6 py-3 rounded-full font-mono text-xs font-bold shadow-2xl">
        <span x-text="easterToast"></span>
    </div>

    <!-- COMMAND PALETTE (CTRL+K) -->
    <div x-show="cmdOpen" style="display: none;" class="relative z-[99999]" role="dialog">
        <div x-show="cmdOpen" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
            <div x-show="cmdOpen" @click.away="cmdOpen = false" class="mx-auto max-w-xl overflow-hidden rounded-2xl bg-white dark:bg-[#18181b] shadow-2xl ring-1 ring-black/5 dark:ring-white/10">
                <div class="relative p-4 border-b border-gray-100 dark:border-gray-800">
                    <input x-model="searchQuery" x-ref="searchInput" x-init="$watch('cmdOpen', v => { if(v) setTimeout(() => $refs.searchInput.focus(), 100) })" type="text" class="w-full bg-transparent text-gray-900 dark:text-white outline-none" placeholder="Cari menu atau fitur rahasia...">
                </div>
                <ul class="max-h-[60vh] overflow-y-auto py-2 text-sm text-gray-800 dark:text-gray-200">
                    <template x-for="cmd in filteredCommands" :key="cmd.id">
                        <li @click="executeCommand(cmd)" class="cursor-pointer px-4 py-3 hover:bg-gray-100 dark:hover:bg-white/5 flex gap-3 border-b border-gray-50 dark:border-gray-800/50 last:border-0">
                            <span x-text="cmd.icon" class="text-lg"></span>
                            <span x-text="cmd.name" class="font-medium" :class="cmd.name.includes('[Misteri]') ? 'text-purple-600 dark:text-purple-400' : ''"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- GLOBAL LIGHTBOX COMPONENT -->
    <!-- ============================================================== -->
    <div x-data="{ 
            lightboxOpen: false, images: [], currentIndex: 0, 
            init() { 
                window.addEventListener('open-lightbox', (e) => { 
                    let incoming = e.detail.images; 
                    if (typeof incoming === 'string') { try { incoming = JSON.parse(incoming); } catch(err) { incoming = [incoming]; } } 
                    if (!incoming) return; 
                    this.images = Array.isArray(incoming) ? incoming : Object.values(incoming); 
                    if (this.images.length > 0) { this.currentIndex = 0; this.lightboxOpen = true; document.body.style.overflow = 'hidden'; } 
                }); 
            }, 
            closeLightbox() { this.lightboxOpen = false; document.body.style.overflow = ''; }, 
            next() { if(this.images.length > 1) this.currentIndex = (this.currentIndex + 1) % this.images.length; }, 
            prev() { if(this.images.length > 1) this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; } 
         }" 
         x-show="lightboxOpen" style="display: none;" 
         class="fixed inset-0 z-[9999999] flex items-center justify-center bg-black/95 backdrop-blur-md" 
         x-transition.opacity 
         @keydown.escape.window="closeLightbox()" @keydown.right.window="next()" @keydown.left.window="prev()">
        
        <button @click.stop="closeLightbox()" class="absolute top-6 right-6 p-2 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full z-50 cursor-pointer outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        <button @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 md:left-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full z-50 cursor-pointer outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
        <button @click.stop="next()" x-show="images.length > 1" class="absolute right-4 md:right-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full z-50 cursor-pointer outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
        
        <div class="relative w-full max-w-6xl h-full max-h-screen flex flex-col items-center justify-center p-4 md:p-12" @click.self="closeLightbox()">
            <img :src="images.length > 0 ? '/storage/' + images[currentIndex] : ''" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-transform duration-300">
            <div x-show="images.length > 1" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/80 text-xs font-bold tracking-widest bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm"><span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span></div>
        </div>
    </div>

    <script>
        AOS.init({ once: true, offset: 50, duration: 600, easing: 'ease-out-cubic' });
        document.addEventListener('DOMContentLoaded', () => document.getElementById('main-content').classList.add('page-loaded'));
        document.querySelectorAll('a[href^="/"]').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.target === '_blank' || this.hash) return;
                e.preventDefault();
                const target = this.href;
                document.getElementById('main-content').classList.remove('page-loaded');
                setTimeout(() => { window.location.href = target; }, 300);
            });
        });
        
        let originalTitle = document.title;
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) { document.title = 'Jangan pergi...'; } 
            else { document.title = originalTitle; }
        });
    </script>
</body>
</html>