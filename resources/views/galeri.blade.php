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

        <section class="py-20 bg-white dark:bg-darkbg min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
                
                <a href="/#galeri" class="inline-flex items-center gap-2 text-brand hover:text-brand-dark mb-8 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>

                <div class="mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Semua <span class="text-brand">Galeri Kegiatan</span></h1>
                    <p class="text-gray-600 dark:text-gray-400">Seluruh dokumentasi kegiatan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($portfolios as $item)
                        <div class="group bg-gray-50 dark:bg-gray-800/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-none hover:ring-1 hover:ring-brand/50 transition-all duration-300">
                            <div class="relative h-56 overflow-hidden bg-gray-200 dark:bg-gray-700 cursor-pointer group/img" @click='openLightbox(@json($item->galeri_foto))'>
                                @php $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 ? $item->galeri_foto[0] : null; @endphp
                                @if($coverImage)
                                    <img src="{{ asset('storage/' . $coverImage) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700">
                                @endif
                                <div class="absolute top-4 right-4 bg-brand text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">{{ $item->kategori }}</div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $item->judul }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $item->deskripsi_singkat ?? '' }}</p>
                                @if(is_array($item->tools_digunakan) && count($item->tools_digunakan) > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(array_slice($item->tools_digunakan, 0, 3) as $tool)
                                            <span class="text-xs px-2 py-1 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 rounded-md">{{ $tool }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12"><p class="text-gray-500">Belum ada galeri.</p></div>
                    @endforelse
                </div>

            </div>
        </section>

        <div x-show="lightboxOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @keydown.escape.window="closeLightbox()" @keydown.right.window="next()" @keydown.left.window="prev()" @click="closeLightbox()"> 
            <button @click.stop="closeLightbox()" class="absolute top-6 right-6 text-white/50 hover:text-brand transition-colors z-50"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            <button @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 md:left-10 text-white/50 hover:text-brand bg-white/5 hover:bg-white/10 p-3 rounded-full transition-all z-50"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
            <button @click.stop="next()" x-show="images.length > 1" class="absolute right-4 md:right-10 text-white/50 hover:text-brand bg-white/5 hover:bg-white/10 p-3 rounded-full transition-all z-50"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            <div class="relative w-full max-w-6xl max-h-[90vh] flex flex-col items-center justify-center p-4" @click.stop>
                <img :src="images.length > 0 ? '/storage/' + images[currentIndex] : ''" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl ring-1 ring-white/10 transition-all duration-300">
                <div x-show="images.length > 1" class="mt-6 text-white/70 text-sm font-semibold bg-white/10 px-4 py-1.5 rounded-full"><span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span></div>
            </div>
        </div>
    </div> 
</x-layout>