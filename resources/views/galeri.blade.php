<x-layout>
    <!-- TIDAK ADA LAGI x-data RAKSASA DI SINI -->
    <div class="min-h-screen text-gray-900 font-sans pb-20">

        <x-navbar />

        <section class="max-w-6xl mx-auto px-6 pt-28 pb-20 lg:pt-36 min-h-screen">
            
            <a href="/#galeri" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mb-8 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>

            <div class="mb-12 max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4">
                    Semua <span class="text-gray-400 dark:text-gray-600">Galeri</span>
                </h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                    Seluruh dokumentasi, portofolio, dan momen kegiatan yang diabadikan secara visual.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolios as $item)
                    <!-- BUNGKUS DATA GAMBAR DI SINI SECARA LOKAL -->
                    <div x-data="{ photos: {{ json_encode($item->galeri_foto ?? []) }} }" 
                         class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-3 shadow-sm hover:border-gray-300 dark:hover:border-gray-700 transition-colors flex flex-col group" 
                         data-aos="fade-up">
                        
                        <!-- SAAT DIKLIK, KIRIM SINYAL (DISPATCH) KE LIGHTBOX -->
                        <div @click="$dispatch('open-lightbox', { images: photos })" 
                             class="relative h-60 rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 cursor-pointer mb-4 shrink-0">
                            
                            @php $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 ? $item->galeri_foto[0] : null; @endphp
                            
                            @if($coverImage)
                                <img src="{{ asset('storage/' . $coverImage) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                
                                <!-- Indikator bahwa ini album (jika gambar lebih dari 1) -->
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
                            <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-2 line-clamp-1">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 flex-1">{{ $item->deskripsi_singkat ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="border-t border-gray-200 dark:border-gray-800/60 bg-white dark:bg-[#09090b] pt-12 pb-8 transition-colors">
            <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                <div>
                    <a href="/" class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white block mb-1">RVPS.</a>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">&copy; {{ date('Y') }} RVPS. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- ============================================== -->
        <!-- KOMPONEN LIGHTBOX GLOBAL YANG TAHAN BANTING -->
        <!-- ============================================== -->
        <div x-data="{
                isOpen: false,
                images: [],
                currentIndex: 0,
                init() {
                    // Mendengarkan event dari kartu galeri
                    window.addEventListener('open-lightbox', (e) => {
                        let incoming = e.detail.images;
                        // Konversi aman jika Filament menyimpan JSON sebagai string
                        if (typeof incoming === 'string') {
                            try { incoming = JSON.parse(incoming); } catch(err) { incoming = [incoming]; }
                        }
                        if (!incoming) return;
                        
                        // Ekstrak jadi Array (berjaga-jaga kalau bentuknya Object)
                        this.images = Array.isArray(incoming) ? incoming : Object.values(incoming);
                        
                        if (this.images.length > 0) {
                            this.currentIndex = 0;
                            this.isOpen = true;
                            document.body.style.overflow = 'hidden';
                        }
                    });
                },
                close() {
                    this.isOpen = false;
                    document.body.style.overflow = '';
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
            <button @click.stop="close()" class="absolute top-6 right-6 p-2 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Tombol Prev -->
            <button @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 md:left-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <!-- Tombol Next -->
            <button @click.stop="next()" x-show="images.length > 1" class="absolute right-4 md:right-8 p-4 text-white/50 hover:text-white bg-white/5 hover:bg-white/20 rounded-full transition-all z-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Kontainer Gambar -->
            <div class="relative w-full max-w-5xl h-full max-h-screen flex flex-col items-center justify-center p-4 md:p-12" @click.self="close()">
                
                <!-- Gambar Utama -->
                <img :src="images.length > 0 ? '/storage/' + images[currentIndex] : ''" 
                     class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-transform duration-300"
                     alt="Gallery Image">
                     
                <!-- Indikator Angka (1 / 5) -->
                <div x-show="images.length > 1" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/80 text-xs font-bold tracking-widest bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                    <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>

    </div> 
</x-layout>