<x-layout>
    <div x-data="{ 
            activeSection: 'profil',
            updateActiveSection() {
                const sections = ['profil', 'galeri', 'blog'];
                let current = this.activeSection;
                for (let id of sections) {
                    const el = document.getElementById(id);
                    if (el && el.getBoundingClientRect().top <= 300) current = id;
                }
                this.activeSection = current;
            }
         }" 
         @scroll.window="updateActiveSection()"
         class="flex flex-col lg:flex-row max-w-[1400px] mx-auto relative">

        <!-- ========================================== -->
        <!-- KOLOM KIRI: STICKY SIDEBAR (Profil & Menu) -->
        <!-- ========================================== -->
        <header class="lg:sticky lg:top-0 lg:h-screen lg:w-5/12 flex flex-col justify-between py-12 px-6 md:px-12 lg:py-24 z-20">
            <div data-aos="fade-right">
                
                <!-- LIVE STATUS & JAM WITA -->
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 w-max">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-red-700 dark:text-red-300">Not Available for work</span>
                    </div>

                    <div x-data="{
                            time: '',
                            init() { this.updateTime(); setInterval(() => this.updateTime(), 1000); },
                            updateTime() {
                                let options = { timeZone: 'Asia/Makassar', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                                this.time = new Intl.DateTimeFormat('id-ID', options).format(new Date()) + ' WITA';
                            }
                         }"
                         class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-gray-800 w-max text-gray-600 dark:text-gray-400 shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-[10px] font-bold tracking-widest font-mono" x-text="time"></span>
                    </div>
                </div>
                
                <!-- EASTER EGG #3: TITIK LOGO MISTERIUS JADI SMILEY -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6 leading-[1.1]">
                    {{ $profile->nama_lengkap ?? 'Richard Valentino' }}<span x-data="{ happy: false }" @click="happy = true; confetti({particleCount: 50, origin: {x: $event.clientX/window.innerWidth, y: $event.clientY/window.innerHeight}, zIndex: 999999}); setTimeout(() => happy=false, 2000)" class="cursor-pointer hover:text-gray-400 transition-colors inline-block" x-text="happy ? ':)' : '.'">.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-800 dark:text-gray-200 font-medium mb-4">{{ $profile->peran ?? 'System Information Student' }}</p>
                <p class="text-sm md:text-base text-gray-500 dark:text-gray-400 max-w-md leading-relaxed mb-10">{{ $profile->biodata_singkat ?? 'Membangun sistem yang efisien dan merancang antarmuka yang fungsional.' }}</p>

                <!-- TOMBOL COMMAND PALETTE -->
                <button @click="cmdOpen = true" class="hidden lg:flex items-center justify-between w-full max-w-xs px-4 py-3 bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800 rounded-2xl text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 transition-all shadow-sm mb-10 group outline-none cursor-pointer">
                    <span class="text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari menu rahasia...
                    </span>
                    <kbd class="hidden sm:inline-block font-sans text-[10px] font-bold px-2 py-1 bg-gray-100 dark:bg-white/10 rounded-md text-gray-500 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">Ctrl K</kbd>
                </button>

                <!-- SCROLLSPY NAVIGASI -->
                <nav class="hidden lg:flex flex-col gap-5 text-xs font-bold uppercase tracking-widest transition-colors">
                    <a href="#profil" :class="activeSection === 'profil' ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-600 hover:text-gray-600 dark:hover:text-gray-400'" class="w-max group flex items-center gap-4 transition-all duration-300">
                        <span :class="activeSection === 'profil' ? 'w-16 bg-gray-900 dark:bg-white' : 'w-8 bg-gray-300 dark:bg-gray-800 group-hover:w-12'" class="h-[2px] transition-all duration-300 ease-out"></span> Pengalaman
                    </a>
                    <a href="#galeri" :class="activeSection === 'galeri' ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-600 hover:text-gray-600 dark:hover:text-gray-400'" class="w-max group flex items-center gap-4 transition-all duration-300">
                        <span :class="activeSection === 'galeri' ? 'w-16 bg-gray-900 dark:bg-white' : 'w-8 bg-gray-300 dark:bg-gray-800 group-hover:w-12'" class="h-[2px] transition-all duration-300 ease-out"></span> Galeri
                    </a>
                    <a href="#blog" :class="activeSection === 'blog' ? 'text-gray-900 dark:text-white' : 'text-gray-400 dark:text-gray-600 hover:text-gray-600 dark:hover:text-gray-400'" class="w-max group flex items-center gap-4 transition-all duration-300">
                        <span :class="activeSection === 'blog' ? 'w-16 bg-gray-900 dark:bg-white' : 'w-8 bg-gray-300 dark:bg-gray-800 group-hover:w-12'" class="h-[2px] transition-all duration-300 ease-out"></span> Blog
                    </a>
                </nav>
            </div>

            <!-- MAGNET BUTTONS & THEME TOGGLE -->
            <div class="hidden lg:flex items-center gap-6 mt-12" data-aos="fade-up" data-aos-delay="200">
                <button @click="toggleTheme()" class="p-2.5 rounded-full bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-all shadow-sm outline-none cursor-pointer">
                    <svg x-show="isDark" style="display: none;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg x-show="!isDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                
                @if(!empty($profile->instagram))
                    <div x-data="{ x: 0, y: 0, move(e) { const r = $el.getBoundingClientRect(); this.x = (e.clientX - (r.left + r.width/2)) * 0.35; this.y = (e.clientY - (r.top + r.height/2)) * 0.35; }, reset() { this.x = 0; this.y = 0; } }" @mousemove="move($event)" @mouseleave="reset()" class="relative p-3 -m-3 cursor-pointer">
                        <a href="{{ $profile->instagram }}" target="_blank" :style="`transform: translate(${x}px, ${y}px)`" class="inline-block text-sm font-bold text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-transform duration-100 ease-out">Instagram</a>
                    </div>
                @endif
                @if(!empty($profile->github))
                    <div x-data="{ x: 0, y: 0, move(e) { const r = $el.getBoundingClientRect(); this.x = (e.clientX - (r.left + r.width/2)) * 0.35; this.y = (e.clientY - (r.top + r.height/2)) * 0.35; }, reset() { this.x = 0; this.y = 0; } }" @mousemove="move($event)" @mouseleave="reset()" class="relative p-3 -m-3 cursor-pointer">
                        <a href="{{ $profile->github }}" target="_blank" :style="`transform: translate(${x}px, ${y}px)`" class="inline-block text-sm font-bold text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-transform duration-100 ease-out">GitHub</a>
                    </div>
                @endif
            </div>
        </header>

        <!-- ========================================== -->
        <!-- KOLOM KANAN: KONTEN SCROLL (Bento Boxes) -->
        <!-- ========================================== -->
        <main class="lg:w-7/12 py-12 px-6 md:px-12 lg:py-24 space-y-24 z-10 overflow-x-hidden">
            
            <!-- EASTER EGG #5: 3D TILT FOTO PROFIL PUSING -->
            <section data-aos="fade-up">
                <div x-data="{ 
                        tiltX: 0, tiltY: 0, clickCount: 0, isDizzy: false,
                        handleMouseMove(e) { if(this.isDizzy) return; const r = $el.getBoundingClientRect(); const x = e.clientX - r.left; const y = e.clientY - r.top; this.tiltX = ((y / r.height) - 0.5) * -15; this.tiltY = ((x / r.width) - 0.5) * 15; },
                        handleMouseLeave() { if(this.isDizzy) return; this.tiltX = 0; this.tiltY = 0; },
                        handleClick() {
                            this.clickCount++;
                            if(this.clickCount >= 5) {
                                this.isDizzy = true; this.tiltX = 0; this.tiltY = 0;
                                setTimeout(() => { this.isDizzy = false; this.clickCount = 0; }, 4000);
                            }
                        }
                     }"
                     @mousemove="handleMouseMove($event)" @mouseleave="handleMouseLeave()" @click="handleClick()"
                     class="relative w-full max-w-md mx-auto lg:mx-0 aspect-[4/5] rounded-[2.5rem] bg-gray-100 dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 shadow-lg overflow-hidden cursor-pointer"
                     style="perspective: 1000px;">
                    
                    <div x-show="isDizzy" style="display:none;" class="absolute top-6 left-1/2 -translate-x-1/2 bg-red-500 text-white text-xs font-bold px-4 py-1.5 rounded-full z-50 whitespace-nowrap shadow-xl animate-bounce">😵 Ampun bang, pusing!</div>

                    <div class="w-full h-full transition-all duration-200 ease-out" 
                         :class="isDizzy ? 'animate-[spin_0.3s_linear_infinite] scale-75 rounded-full' : ''"
                         :style="!isDizzy ? `transform: rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale3d(1.02, 1.02, 1.02); transform-style: preserve-3d;` : ''">
                        @if(!empty($profile->foto_profil))
                            <img src="{{ asset('storage/' . $profile->foto_profil) }}" class="w-full h-full object-cover shadow-inner pointer-events-none">
                        @endif
                        <div class="absolute inset-0 pointer-events-none transition-opacity duration-200" style="background: radial-gradient(circle at center, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 60%);" :style="`opacity: ${(Math.abs(tiltX) + Math.abs(tiltY)) / 15}`"></div>
                    </div>
                </div>
            </section>

            <!-- PENDIDIKAN & ORGANISASI -->
            <section id="profil" class="scroll-mt-24">
                <div class="mb-8"><h3 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Perjalanan Karir</h3></div>
                
                <div class="grid grid-cols-1 gap-6">
                    
                    <!-- 1. KOTAK PENDIDIKAN -->
                    <div x-data="{ mouseX: 0, mouseY: 0, handleMouseMove(e) { const r = $el.getBoundingClientRect(); this.mouseX = e.clientX - r.left; this.mouseY = e.clientY - r.top; } }" @mousemove="handleMouseMove($event)" :style="`--mouseX: ${mouseX}px; --mouseY: ${mouseY}px;`" class="relative bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-8 shadow-sm group overflow-hidden" data-aos="fade-up">
                        <div class="dark:hidden pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100" style="background: radial-gradient(600px circle at var(--mouseX) var(--mouseY), rgba(0,0,0,0.03), transparent 40%);"></div>
                        <div class="hidden dark:block pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100" style="background: radial-gradient(600px circle at var(--mouseX) var(--mouseY), rgba(255,255,255,0.06), transparent 40%);"></div>
                        <div class="relative z-10 flex items-center gap-3 mb-8 pointer-events-none">
                            <div class="p-2 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5"><svg class="w-5 h-5 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg></div>
                            <h4 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Riwayat Pendidikan</h4>
                        </div>
                        <div class="relative z-10 space-y-6">
                            @if(!empty($profile->riwayat_pendidikan) && is_array($profile->riwayat_pendidikan))
                                @foreach($profile->riwayat_pendidikan as $edu)
                                    <div class="relative pl-6 border-l border-gray-200 dark:border-gray-700"><span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 ring-4 ring-white dark:ring-[#18181b]"></span><h5 class="text-base font-bold text-gray-900 dark:text-white">{{ $edu['institusi'] ?? '' }}</h5><p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 mt-1">{{ $edu['tahun'] ?? '' }}</p><p class="text-sm text-gray-600 dark:text-gray-400">{{ $edu['jurusan'] ?? '' }}</p></div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- 2. KOTAK ORGANISASI (INI YANG SEMPAT HILANG!) -->
                    <div x-data="{ mouseX: 0, mouseY: 0, handleMouseMove(e) { const r = $el.getBoundingClientRect(); this.mouseX = e.clientX - r.left; this.mouseY = e.clientY - r.top; } }" @mousemove="handleMouseMove($event)" :style="`--mouseX: ${mouseX}px; --mouseY: ${mouseY}px;`" class="relative bg-gray-900 dark:bg-[#121214] border border-gray-800 dark:border-gray-800/60 rounded-3xl p-8 shadow-sm text-white group overflow-hidden" data-aos="fade-up">
                        <div class="pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100" style="background: radial-gradient(600px circle at var(--mouseX) var(--mouseY), rgba(255,255,255,0.08), transparent 40%);"></div>
                        <div class="relative z-10 flex items-center gap-3 mb-8 pointer-events-none">
                            <div class="p-2 bg-gray-800 dark:bg-white/10 rounded-xl border border-gray-700 dark:border-white/5"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                            <h4 class="text-xl font-bold tracking-tight">Pengalaman Organisasi</h4>
                        </div>
                        <div class="relative z-10 space-y-6">
                            @if(!empty($profile->pengalaman_organisasi) && is_array($profile->pengalaman_organisasi))
                                @foreach($profile->pengalaman_organisasi as $org)
                                    <div class="relative pl-6 border-l border-gray-700"><span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gray-500 ring-4 ring-gray-900 dark:ring-[#121214]"></span><h5 class="text-base font-bold">{{ $org['jabatan'] ?? '' }}</h5><p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1 mt-1">{{ $org['tahun'] ?? '' }}</p><p class="text-sm text-gray-300">{{ $org['nama_organisasi'] ?? '' }}</p></div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </section>

            <!-- GALERI FOTO (FIX X-DATA KUTIP TUNGGAL) -->
            <section id="galeri" class="scroll-mt-24">
                <div class="flex items-end justify-between mb-8" data-aos="fade-up">
                    <h3 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Galeri</h3>
                    <a href="/galeri" class="text-sm font-semibold text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors cursor-pointer">Lihat Semua &rarr;</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($portfolios->take(4) as $item)
                        <div x-data='{ photos: @json($item->galeri_foto ?? []), mouseX: 0, mouseY: 0, handleMouseMove(e) { const r = $el.getBoundingClientRect(); this.mouseX = e.clientX - r.left; this.mouseY = e.clientY - r.top; } }' 
                             @mousemove="handleMouseMove($event)" :style="`--mouseX: ${mouseX}px; --mouseY: ${mouseY}px;`" 
                             class="relative bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-3 shadow-sm group flex flex-col overflow-hidden" data-aos="fade-up">
                            
                            <div class="dark:hidden pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(400px circle at var(--mouseX) var(--mouseY), rgba(0,0,0,0.04), transparent 40%);"></div>
                            <div class="hidden dark:block pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(400px circle at var(--mouseX) var(--mouseY), rgba(255,255,255,0.06), transparent 40%);"></div>

                            <div @click="$dispatch('open-lightbox', { images: photos })" class="relative z-10 h-48 rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 cursor-pointer mb-4 shrink-0">
                                @php $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 ? $item->galeri_foto[0] : null; @endphp
                                @if($coverImage)
                                    <img src="{{ asset('storage/' . $coverImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @if(count($item->galeri_foto) > 1)
                                        <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded-lg">+{{ count($item->galeri_foto) - 1 }}</div>
                                    @endif
                                @endif
                            </div>
                            <div class="relative z-10 px-2 pb-2 pointer-events-none">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1 line-clamp-1">{{ $item->judul }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">{{ $item->deskripsi_singkat ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- ARTIKEL -->
            <section id="blog" class="scroll-mt-24">
                <div class="flex items-end justify-between mb-8" data-aos="fade-up">
                    <h3 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Blog</h3>
                    <a href="/blog" class="text-sm font-semibold text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors cursor-pointer">Lihat Semua &rarr;</a>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    @foreach($articles->take(3) as $article)
                        <div x-data="{ mouseX: 0, mouseY: 0, handleMouseMove(e) { const r = $el.getBoundingClientRect(); this.mouseX = e.clientX - r.left; this.mouseY = e.clientY - r.top; } }" @mousemove="handleMouseMove($event)" :style="`--mouseX: ${mouseX}px; --mouseY: ${mouseY}px;`" class="relative bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-4 shadow-sm group overflow-hidden" data-aos="fade-up">
                            <div class="dark:hidden pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(500px circle at var(--mouseX) var(--mouseY), rgba(0,0,0,0.03), transparent 40%);"></div>
                            <div class="hidden dark:block pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(500px circle at var(--mouseX) var(--mouseY), rgba(255,255,255,0.05), transparent 40%);"></div>

                            <article class="relative z-10 flex flex-col sm:flex-row gap-5 h-full">
                                <a href="{{ url('/blog/' . $article->slug) }}" class="relative h-40 sm:h-auto sm:w-40 rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 shrink-0 cursor-pointer">
                                    @if($article->thumbnail) <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"> @endif
                                </a>
                                <div class="flex flex-col justify-center flex-1">
                                    <div class="flex items-center gap-2 mb-2 pointer-events-none"><span class="text-[10px] font-bold uppercase tracking-wider bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/5 px-2 py-1 rounded text-gray-900 dark:text-white">{{ $article->kategori }}</span></div>
                                    <a href="{{ url('/blog/' . $article->slug) }}" class="cursor-pointer"><h4 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors mb-2">{{ $article->judul }}</h4></a>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 pointer-events-none">{{ Str::limit(strip_tags($article->konten), 90) }}</p>
                                    <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider pointer-events-none">{{ $article->created_at->translatedFormat('d M Y') }} &bull; {{ $article->estimasi_waktu_baca ?? 5 }} min read</div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- EASTER EGG #4: FOOTER TOMBOL KABUR -->
            <footer class="pt-12 border-t border-gray-200 dark:border-gray-800/60 flex flex-col sm:flex-row items-center justify-between gap-4 pb-12 lg:pb-0">
                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">&copy; {{ date('Y') }} RVPS. All rights reserved.</p>
                <div x-data="{ x: 0, y: 0, moveBtn() { this.x = (Math.random() - 0.5) * 250; this.y = (Math.random() - 0.5) * 100; } }" class="relative z-50">
                    <button @mouseover="moveBtn()" @click="alert('Walawe, kok iso ke klik?, ampun puhh :v')" :style="`transform: translate(${x}px, ${y}px)`" class="text-[10px] font-bold uppercase tracking-wider text-gray-300 dark:text-gray-700 transition-transform duration-200 ease-out px-3 py-1 rounded-full cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 outline-none">
                        Jangan Diklik
                    </button>
                </div>
            </footer>
        </main>
    </div>
</x-layout>