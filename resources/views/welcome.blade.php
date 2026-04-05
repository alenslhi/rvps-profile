<x-layout>
    <div x-data="{
        lightboxOpen: false,
        images: [],
        currentIndex: 0,
        openLightbox(imgArray) {
            if(!imgArray || imgArray.length === 0) return;
            this.images = imgArray;
            this.currentIndex = 0;
            this.lightboxOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeLightbox() {
            this.lightboxOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        next() {
            if(this.currentIndex < this.images.length - 1) {
                this.currentIndex++;
            } else {
                this.currentIndex = 0;
            }
        },
        prev() {
            if(this.currentIndex > 0) {
                this.currentIndex--;
            } else {
                this.currentIndex = this.images.length - 1;
            }
        }
    }">

        <x-navbar />

        <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 lg:pt-32 flex flex-col-reverse lg:flex-row items-center gap-12">
            
            <div class="flex-1 text-center lg:text-left z-10" data-aos="fade-right">
                <h2 class="text-brand dark:text-brand-light font-semibold tracking-wide uppercase text-sm md:text-base mb-3">
                    {{ $setting->hero_judul ?? 'Creative & Tech Enthusiast' }}
                </h2>
                
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                    Halo, saya <br class="hidden lg:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand to-brand-light">
                        {{ $profile->nama_lengkap ?? 'Richard' }}
                    </span>
                </h1>
                
                <p class="text-xl text-gray-600 dark:text-gray-300 font-medium mb-6">
                    {{ $profile->peran ?? 'System Information Student' }}
                </p>
                
                <p class="text-base text-gray-500 dark:text-gray-400 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    {{ $profile->biodata_singkat ?? 'Selamat datang di website profil saya. Silakan jelajahi portofolio dan tulisan saya.' }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="/galeri" class="px-8 py-3 rounded-full bg-brand hover:bg-brand-dark text-white font-semibold transition-all shadow-lg shadow-brand/30">
                        Lihat Karya
                    </a>
                    
                    @if(!empty($profile->file_cv))
                    <a href="{{ asset('storage/' . $profile->file_cv) }}" target="_blank" class="px-8 py-3 rounded-full border border-gray-300 dark:border-gray-700 hover:border-brand dark:hover:border-brand text-gray-700 dark:text-gray-200 hover:text-brand dark:hover:text-brand transition-all">
                        Download CV
                    </a>
                    @endif
                </div>
            </div>

            <div class="flex-1 relative flex justify-center lg:justify-end w-full max-w-md lg:max-w-full" data-aos="fade-left" data-aos-delay="200">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-brand/20 dark:bg-brand/30 rounded-full blur-3xl z-0"></div>
                
                <div class="relative z-10 w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-4 border-white dark:border-darkbg shadow-2xl ring-4 ring-gray-100 dark:ring-gray-800">
                    @if(!empty($profile->foto_profil))
                        <img src="{{ asset('storage/' . $profile->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                </div>
            </div>

        </section>

        <section id="profil" class="py-20 bg-gray-50 dark:bg-darkbg/50 border-t border-gray-100 dark:border-gray-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Pendidikan <span class="text-brand"> & Organisasi</span></h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Riwayat Pendidikan dan Riwayat Organisasi Saya.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-24">
                    
                    <div data-aos="fade-right">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                            Pendidikan
                        </h3>
                        
                        <div class="border-l-2 border-brand/20 dark:border-brand/30 ml-3 space-y-8">
                            @if(!empty($profile->riwayat_pendidikan) && is_array($profile->riwayat_pendidikan))
                                @foreach($profile->riwayat_pendidikan as $edu)
                                    <div class="relative pl-8 hover:-translate-y-1 transition-transform duration-300">
                                        <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand ring-4 ring-gray-50 dark:ring-darkbg shadow-sm"></span>
                                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $edu['institusi'] ?? '' }}</h4>
                                        <p class="text-sm text-brand font-semibold mb-1">{{ $edu['tahun'] ?? '' }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $edu['jurusan'] ?? '' }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="pl-8 text-gray-500">Belum ada data riwayat pendidikan.</p>
                            @endif
                        </div>
                    </div>

                    <div data-aos="fade-left">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Pengalaman Organisasi
                        </h3>
                        
                        <div class="border-l-2 border-brand/20 dark:border-brand/30 ml-3 space-y-8">
                            @if(!empty($profile->pengalaman_organisasi) && is_array($profile->pengalaman_organisasi))
                                @foreach($profile->pengalaman_organisasi as $org)
                                    <div class="relative pl-8 hover:-translate-y-1 transition-transform duration-300">
                                        <span class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand ring-4 ring-gray-50 dark:ring-darkbg shadow-sm"></span>
                                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $org['jabatan'] ?? '' }}</h4>
                                        <p class="text-sm text-brand font-semibold mb-1">{{ $org['tahun'] ?? '' }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $org['nama_organisasi'] ?? '' }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="pl-8 text-gray-500">Belum ada data pengalaman organisasi.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="galeri" class="py-20 bg-white dark:bg-darkbg border-t border-gray-100 dark:border-gray-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div data-aos="fade-right">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Galeri <span class="text-brand">Foto</span></h2>
                        <p class="text-gray-600 dark:text-gray-400 max-w-2xl">
                            Kumpulan Dokumentasi Kegiatan Saya.
                        </p>
                    </div>
                    <a href="/galeri" class="hidden md:inline-flex items-center gap-2 text-brand font-semibold hover:text-brand-dark transition-colors" data-aos="fade-left">
                        Lihat Semua Galeri
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @forelse($portfolios as $item)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="group bg-gray-50 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-none hover:ring-1 hover:ring-brand/50 transition-all duration-300">
                            
                            <div class="relative h-56 overflow-hidden bg-gray-200 dark:bg-gray-700 cursor-pointer group/img"
                                 @click='openLightbox(@json($item->galeri_foto))'>
                                
                                @php
                                    $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 
                                                  ? $item->galeri_foto[0] 
                                                  : null;
                                @endphp

                                @if($coverImage)
                                    <img src="{{ asset('storage/' . $coverImage) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4 bg-brand text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">
                                    {{ $item->kategori }}
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-brand transition-colors">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                    {{ $item->deskripsi_singkat ?? 'Tidak ada deskripsi.' }}
                                </p>
                                
                                @if(is_array($item->tools_digunakan) && count($item->tools_digunakan) > 0)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(array_slice($item->tools_digunakan, 0, 3) as $tool)
                                            <span class="text-xs px-2 py-1 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-md">
                                                {{ $tool }}
                                            </span>
                                        @endforeach
                                        @if(count($item->tools_digunakan) > 3)
                                            <span class="text-xs px-2 py-1 text-gray-500">+...+</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12" data-aos="fade-in">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada galeri yang ditambahkan.</p>
                        </div>
                    @endforelse

                </div>
                
                @if($portfolios->count() > 0)
                <div class="mt-8 text-center md:hidden" data-aos="fade-up">
                    <a href="/galeri" class="inline-flex items-center gap-2 text-brand font-semibold hover:text-brand-dark transition-colors">
                        Lihat Semua Galeri
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                @endif

            </div>
        </section>

        <section id="blog" class="py-20 bg-gray-50 dark:bg-darkbg/50 border-t border-gray-100 dark:border-gray-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div data-aos="fade-right">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">RVPS <span class="text-brand">Blog</span></h2>
                        <p class="text-gray-600 dark:text-gray-400 max-w-2xl">
                            Artikel Blog Berisi Informasi dan Tutorial.
                        </p>
                    </div>
                    <a href="/blog" class="hidden md:inline-flex items-center gap-2 text-brand font-semibold hover:text-brand-dark transition-colors" data-aos="fade-left">
                        Lihat Semua Artikel 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @forelse($articles as $article)
                        <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}" class="flex flex-col bg-white dark:bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:border-brand/30 dark:hover:border-brand/30 hover:shadow-xl dark:shadow-none transition-all duration-300 group">
                            
                            <a href="{{ url('/blog/' . $article->slug) }}" class="relative h-48 overflow-hidden block">
                                @if($article->thumbnail)
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-brand/10 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-brand/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>

                            <div class="flex-1 flex flex-col p-6">
                                <div class="flex items-center gap-3 text-xs font-medium text-gray-500 dark:text-gray-400 mb-3">
                                    <span class="px-2.5 py-1 bg-gray-50 dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700 text-brand">
                                        {{ $article->kategori }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $article->estimasi_waktu_baca ?? 5 }} mnt baca
                                    </span>
                                </div>

                                <a href="{{ url('/blog/' . $article->slug) }}" class="block mt-2">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand transition-colors">
                                        {{ $article->judul }}
                                    </h3>
                                </a>

                                <p class="mt-3 text-gray-600 dark:text-gray-400 text-sm line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($article->konten), 120) }}
                                </p>

                                <div class="mt-6 flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4">
                                    <span class="text-xs text-gray-500 dark:text-gray-500">
                                        {{ $article->created_at->translatedFormat('d F Y') }}
                                    </span>
                                    <a href="{{ url('/blog/' . $article->slug) }}" class="text-sm font-semibold text-brand hover:text-brand-dark transition-colors flex items-center gap-1">
                                        Baca Selengkapnya <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-12" data-aos="fade-in">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
                        </div>
                    @endforelse

                </div>
                
                <div class="mt-8 text-center md:hidden" data-aos="fade-up">
                    <a href="/blog" class="inline-flex items-center gap-2 text-brand font-semibold hover:text-brand-dark transition-colors">
                        Lihat Semua Artikel 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

            </div>
        </section>

        <footer class="bg-white dark:bg-darkbg border-t border-gray-200 dark:border-gray-800 transition-colors pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    
                    <div class="text-center md:text-left" data-aos="fade-right">
                        <a href="/" class="text-2xl font-bold text-brand dark:text-brand-light tracking-tighter block mb-2">
                            RVPS<span class="text-gray-900 dark:text-white">.</span>
                        </a>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            &copy; {{ date('Y') }} {{ $profile->nama_lengkap ?? 'Richard' }}. Dibuat dengan cinta, Laravel, & Tailwind CSS.
                        </p>
                    </div>

                    <div class="flex gap-4" data-aos="fade-left">
                        @if(!empty($profile->instagram))
                            <a href="{{ $profile->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-brand dark:hover:text-brand hover:bg-brand/10 dark:hover:bg-brand/20 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        @endif

                        @if(!empty($profile->github))
                            <a href="{{ $profile->github }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-brand dark:hover:text-brand hover:bg-brand/10 dark:hover:bg-brand/20 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </footer>

        <div x-show="lightboxOpen" 
             style="display: none;" 
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-md"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="closeLightbox()"
             @keydown.right.window="next()"
             @keydown.left.window="prev()"
             @click="closeLightbox()"> 

            <button @click.stop="closeLightbox()" class="absolute top-6 right-6 text-white/50 hover:text-brand transition-colors z-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <button @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 md:left-10 text-white/50 hover:text-brand bg-white/5 hover:bg-white/10 p-3 rounded-full transition-all z-50 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <button @click.stop="next()" x-show="images.length > 1" class="absolute right-4 md:right-10 text-white/50 hover:text-brand bg-white/5 hover:bg-white/10 p-3 rounded-full transition-all z-50 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <div class="relative w-full max-w-6xl max-h-[90vh] flex flex-col items-center justify-center p-4" @click.stop>
                
                <img :src="images.length > 0 ? '/storage/' + images[currentIndex] : ''" 
                     class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl ring-1 ring-white/10 transition-all duration-300" 
                     alt="Preview Galeri">

                <div x-show="images.length > 1" class="mt-6 text-white/70 text-sm tracking-widest font-semibold bg-white/10 px-4 py-1.5 rounded-full">
                    <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>

    </div> 
</x-layout>