<x-layout>
    <!-- Wrapper utama tanpa x-data raksasa -->
    <div class="min-h-screen text-gray-900 font-sans pb-10 transition-colors">
        
        <x-navbar />

        <!-- 1. HERO SECTION -->
        <section class="max-w-6xl mx-auto px-6 pt-28 pb-16 lg:pt-36">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                
                <!-- Main Intro -->
                <div class="lg:col-span-8 bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-8 md:p-12 shadow-sm flex flex-col justify-center transition-colors" data-aos="fade-right">
                    <h2 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-4">
                        {{ $setting->hero_judul ?? 'Creative & Tech Enthusiast' }}
                    </h2>
                    
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6 leading-none">
                        Halo, saya <br class="hidden md:block">
                        {{ $profile->nama_lengkap ?? 'Richard' }}.
                    </h1>
                    
                    <p class="text-xl text-gray-900 dark:text-gray-200 font-medium mb-4">
                        {{ $profile->peran ?? 'System Information Student' }}
                    </p>
                    
                    <p class="text-base text-gray-500 dark:text-gray-400 max-w-xl leading-relaxed mb-10">
                        {{ $profile->biodata_singkat ?? 'Selamat datang di website profil saya. Silakan jelajahi portofolio dan tulisan saya.' }}
                    </p>

                    <div class="flex flex-wrap gap-4 mt-auto">
                        <a href="#galeri" class="px-6 py-3 rounded-2xl bg-gray-900 dark:bg-white hover:bg-black dark:hover:bg-gray-200 text-white dark:text-gray-900 font-bold text-sm transition-colors">
                            Lihat Karya
                        </a>
                        
                        @if(!empty($profile->file_cv))
                        <a href="{{ asset('storage/' . $profile->file_cv) }}" target="_blank" class="px-6 py-3 rounded-2xl bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-500 text-gray-900 dark:text-white font-medium text-sm transition-all shadow-sm">
                            Download CV
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Profile Photo -->
                <div class="lg:col-span-4 bg-gray-100 dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl overflow-hidden relative min-h-[300px] transition-colors" data-aos="fade-left" data-aos-delay="100">
                    @if(!empty($profile->foto_profil))
                        <img src="{{ asset('storage/' . $profile->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                </div>

            </div>
        </section>

        <!-- 2. PENDIDIKAN & ORGANISASI -->
        <section id="profil" class="max-w-6xl mx-auto px-6 py-16">
            <div class="mb-10 text-center md:text-left" data-aos="fade-up">
                <h2 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-2">Riwayat & Pengalaman</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Perjalanan Karir</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pendidikan Card -->
                <div class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-8 shadow-sm transition-colors" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="p-2 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                            <svg class="w-5 h-5 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pendidikan</h4>
                    </div>
                    
                    <div class="space-y-6">
                        @if(!empty($profile->riwayat_pendidikan) && is_array($profile->riwayat_pendidikan))
                            @foreach($profile->riwayat_pendidikan as $edu)
                                <div class="relative pl-6 border-l border-gray-200 dark:border-gray-700 group hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                    <span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 group-hover:bg-gray-900 dark:group-hover:bg-white transition-colors ring-4 ring-white dark:ring-[#18181b]"></span>
                                    <h5 class="text-base font-bold text-gray-900 dark:text-white">{{ $edu['institusi'] ?? '' }}</h5>
                                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 mt-1">{{ $edu['tahun'] ?? '' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $edu['jurusan'] ?? '' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data riwayat pendidikan.</p>
                        @endif
                    </div>
                </div>

                <!-- Organisasi Card -->
                <div class="bg-gray-900 dark:bg-black border border-gray-800 dark:border-gray-800/60 rounded-3xl p-8 shadow-sm text-white transition-colors" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="p-2 bg-gray-800 dark:bg-white/10 rounded-xl border border-gray-700 dark:border-white/5">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold tracking-tight">Pengalaman Organisasi</h4>
                    </div>
                    
                    <div class="space-y-6">
                        @if(!empty($profile->pengalaman_organisasi) && is_array($profile->pengalaman_organisasi))
                            @foreach($profile->pengalaman_organisasi as $org)
                                <div class="relative pl-6 border-l border-gray-700 group hover:border-gray-500 transition-colors">
                                    <span class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-gray-600 group-hover:bg-white transition-colors ring-4 ring-gray-900 dark:ring-black"></span>
                                    <h5 class="text-base font-bold">{{ $org['jabatan'] ?? '' }}</h5>
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1 mt-1">{{ $org['tahun'] ?? '' }}</p>
                                    <p class="text-sm text-gray-300">{{ $org['nama_organisasi'] ?? '' }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">Belum ada data pengalaman organisasi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. GALERI FOTO (DENGAN LIGHTBOX DISPATCH) -->
        <section id="galeri" class="max-w-6xl mx-auto px-6 py-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4" data-aos="fade-up">
                <div>
                    <h2 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-2">Dokumentasi Visual</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Galeri Foto</h3>
                </div>
                <a href="/galeri" class="hidden md:flex text-sm font-semibold text-gray-900 dark:text-white hover:text-gray-500 transition-colors items-center gap-1">
                    Lihat Semua Galeri <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Kita hanya menampilkan 3 galeri terbaru di beranda -->
                @forelse($portfolios->take(3) as $item)
                    <!-- Menyimpan data array gambar lokal di setiap card -->
                    <div x-data="{ photos: {{ json_encode($item->galeri_foto ?? []) }} }" 
                         class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-3 shadow-sm hover:border-gray-300 dark:hover:border-gray-700 transition-colors flex flex-col group" 
                         data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        
                        <!-- Kirim sinyal ke modal lightbox saat diklik -->
                        <div @click="$dispatch('open-lightbox', { images: photos })" 
                             class="relative h-56 rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 cursor-pointer mb-4 shrink-0">
                            
                            @php $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 ? $item->galeri_foto[0] : null; @endphp
                            
                            @if($coverImage)
                                <img src="{{ asset('storage/' . $coverImage) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                
                                <!-- Indikator Album jika gambar lebih dari 1 -->
                                @if(count($item->galeri_foto) > 1)
                                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1.5 rounded-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        +{{ count($item->galeri_foto) - 1 }}
                                    </div>
                                @endif
                            @endif
                            
                            <div class="absolute top-3 right-3 bg-white/90 dark:bg-black/70 backdrop-blur-sm text-gray-900 dark:text-white text-[10px] uppercase tracking-wider font-bold px-3 py-1.5 rounded-full shadow-sm">
                                {{ $item->kategori }}
                            </div>
                        </div>

                        <div class="px-3 pb-3 flex flex-col flex-1">
                            <h4 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-1 line-clamp-1">{{ $item->judul }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 flex-1">{{ $item->deskripsi_singkat ?? 'Tidak ada deskripsi.' }}</p>
                            
                            @if(is_array($item->tools_digunakan) && count($item->tools_digunakan) > 0)
                                <div class="flex flex-wrap gap-1.5 mt-auto pt-2 border-t border-gray-100 dark:border-gray-800">
                                    @foreach(array_slice($item->tools_digunakan, 0, 3) as $tool)
                                        <span class="text-[10px] uppercase tracking-wider px-2 py-1 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 text-gray-600 dark:text-gray-300 rounded-md font-medium">
                                            {{ $tool }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl" data-aos="fade-up">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada galeri yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8 text-center md:hidden" data-aos="fade-up">
                <a href="/galeri" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white">
                    Lihat Semua Galeri <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </section>

        <!-- 4. ARTIKEL & JURNAL -->
        <section id="blog" class="max-w-6xl mx-auto px-6 py-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4" data-aos="fade-up">
                <div>
                    <h2 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold mb-2">Pusat Informasi</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Artikel & Jurnal</h3>
                </div>
                <a href="/blog" class="hidden md:flex text-sm font-semibold text-gray-900 dark:text-white hover:text-gray-500 transition-colors items-center gap-1">
                    Lihat Semua Artikel <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kita tampilkan 3 artikel terbaru di beranda -->
                @forelse($articles->take(3) as $article)
                    <article class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-4 shadow-sm hover:border-gray-300 dark:hover:border-gray-700 transition-colors flex flex-col group h-full" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        
                        <a href="{{ url('/blog/' . $article->slug) }}" class="relative h-48 w-full block rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 mb-5 shrink-0">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </a>

                        <div class="flex flex-col flex-1 px-2">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/5 px-2 py-1 rounded text-gray-900 dark:text-white">
                                    {{ $article->kategori }}
                                </span>
                                <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ $article->estimasi_waktu_baca ?? 5 }} min read
                                </span>
                            </div>

                            <a href="{{ url('/blog/' . $article->slug) }}" class="block mb-2">
                                <h4 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                                    {{ $article->judul }}
                                </h4>
                            </a>

                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 mb-6 flex-1">
                                {{ Str::limit(strip_tags($article->konten), 100) }}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4 mt-auto">
                                <span class="text-xs font-medium text-gray-400 dark:text-gray-500">
                                    {{ $article->created_at->translatedFormat('d M Y') }}
                                </span>
                                <a href="{{ url('/blog/' . $article->slug) }}" class="text-[11px] uppercase tracking-wider font-bold text-gray-900 dark:text-white hover:text-gray-500 transition-colors">
                                    Baca &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl" data-aos="fade-up">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8 text-center md:hidden" data-aos="fade-up">
                <a href="/blog" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white">
                    Lihat Semua Artikel <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </section>

        <!-- 5. FOOTER -->
        <footer class="border-t border-gray-200 dark:border-gray-800/60 bg-white dark:bg-[#09090b] pt-12 pb-8 mt-12 transition-colors">
            <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                <div>
                    <a href="/" class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white block mb-1">
                        RVPS.
                    </a>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">
                        &copy; {{ date('Y') }} {{ $profile->nama_lengkap ?? 'Richard' }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- ============================================== -->
        <!-- KOMPONEN LIGHTBOX GLOBAL (POPUP GAMBAR) -->
        <!-- ============================================== -->
        <div x-data="{
                isOpen: false,
                images: [],
                currentIndex: 0,
                init() {
                    window.addEventListener('open-lightbox', (e) => {
                        let incoming = e.detail.images;
                        // Parsing aman untuk JSON
                        if (typeof incoming === 'string') {
                            try { incoming = JSON.parse(incoming); } catch(err) { incoming = [incoming]; }
                        }
                        if (!incoming) return;
                        
                        this.images = Array.isArray(incoming) ? incoming : Object.values(incoming);
                        
                        if (this.images.length > 0) {
                            this.currentIndex = 0;
                            this.isOpen = true;
                            document.body.style.overflow = 'hidden'; // Kunci scroll layar utama
                        }
                    });
                },
                close() {
                    this.isOpen = false;
                    document.body.style.overflow = ''; // Lepas kunci scroll
                },
                next() {
                    if (this.images.length > 1) {
                        this.currentIndex = (this.currentIndex + 1) % this.images.length;
                    }
                },
                prev() {
                    if (this.images.length > 1) {
                        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    }
                }
            }"
            x-show="isOpen"
            style="display: none;"
            @keydown.escape.window="close()"
            @keydown.right.window="next()"
            @keydown.left.window="prev()"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/95 backdrop-blur-md transition-opacity duration-300"
            x-transition.opacity
        >
            <!-- Tombol Close -->
            <button @click.stop="close()" class="absolute top-6 right-6 p-2 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Tombol Prev -->
            <button @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 md:left-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <!-- Tombol Next -->
            <button @click.stop="next()" x-show="images.length > 1" class="absolute right-4 md:right-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Kontainer Gambar & Klik di luar untuk menutup -->
            <div class="relative w-full max-w-5xl h-full max-h-screen flex flex-col items-center justify-center p-4 md:p-12" @click.self="close()">
                <img :src="images.length > 0 ? '/storage/' + images[currentIndex] : ''" 
                     class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-transform duration-300"
                     alt="Gallery Preview">
                     
                <!-- Indikator Angka -->
                <div x-show="images.length > 1" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/80 text-xs font-bold tracking-widest bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                    <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>

    </div> 
</x-layout>