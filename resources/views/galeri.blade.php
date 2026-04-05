<x-layout>
    @php
        $categories = collect($portfolios)->pluck('kategori')->unique()->filter()->values()->toArray();
    @endphp

    <div x-data="{ activeCat: 'All' }">

        <x-navbar />

        <section class="max-w-6xl mx-auto px-6 pt-28 pb-20 lg:pt-36 min-h-screen">
            <a href="/#galeri" class="inline-flex items-center gap-2 text-xs uppercase font-semibold text-gray-500 mb-8 hover:text-gray-900 dark:hover:text-white cursor-pointer">Kembali ke Beranda</a>

            <div class="mb-10 max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">Semua Galeri</h1>
            </div>

            <!-- LIVE FILTER BUTTONS -->
            <div class="flex flex-wrap gap-2 mb-10">
                <button @click="activeCat = 'All'" :class="activeCat === 'All' ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-white dark:bg-[#18181b] text-gray-600 dark:text-gray-300'" class="cursor-pointer px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-gray-200 dark:border-gray-800 transition-colors outline-none">Semua</button>
                @foreach($categories as $cat)
                    <button @click="activeCat = '{{ $cat }}'" :class="activeCat === '{{ $cat }}' ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-white dark:bg-[#18181b] text-gray-600 dark:text-gray-300'" class="cursor-pointer px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-gray-200 dark:border-gray-800 transition-colors outline-none">{{ $cat }}</button>
                @endforeach
            </div>

            <!-- GRID GALERI -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($portfolios as $item)
                    <!-- PERBAIKAN KUTIP TUNGGAL UNTUK ARRAY DATA GAMBAR -->
                    <div x-show="activeCat === 'All' || activeCat === '{{ $item->kategori }}'" 
                         x-transition.opacity.duration.400ms
                         x-data='{ photos: @json($item->galeri_foto ?? []), mouseX: 0, mouseY: 0, handleMouseMove(e) { const r = $el.getBoundingClientRect(); this.mouseX = e.clientX - r.left; this.mouseY = e.clientY - r.top; } }' 
                         @mousemove="handleMouseMove($event)" :style="`--mouseX: ${mouseX}px; --mouseY: ${mouseY}px;`"
                         class="relative bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-3 group overflow-hidden">
                        
                        <div class="dark:hidden pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(400px circle at var(--mouseX) var(--mouseY), rgba(0,0,0,0.04), transparent 40%);"></div>
                        <div class="hidden dark:block pointer-events-none absolute -inset-px rounded-3xl opacity-0 transition duration-300 group-hover:opacity-100 z-0" style="background: radial-gradient(400px circle at var(--mouseX) var(--mouseY), rgba(255,255,255,0.06), transparent 40%);"></div>

                        <div @click="$dispatch('open-lightbox', { images: photos })" class="relative z-10 h-60 rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 cursor-pointer mb-4 shrink-0">
                            @php $coverImage = is_array($item->galeri_foto) && count($item->galeri_foto) > 0 ? $item->galeri_foto[0] : null; @endphp
                            @if($coverImage) 
                                <img src="{{ asset('storage/' . $coverImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"> 
                                @if(count($item->galeri_foto) > 1)
                                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded-lg">+{{ count($item->galeri_foto) - 1 }}</div>
                                @endif
                            @endif
                            <div class="absolute top-3 right-3 bg-white/90 dark:bg-black/70 text-gray-900 dark:text-white text-[10px] uppercase font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $item->kategori }}</div>
                        </div>
                        <div class="px-3 pb-3 flex flex-col flex-1 relative z-10 pointer-events-none">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $item->judul }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        
        <!-- (Modal Lightbox dihapus dari file ini karena sekarang menumpang secara Global di layout.blade.php) -->

    </div> 
</x-layout>