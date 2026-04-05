<x-layout>
    @php
        $categories = collect($articles)->pluck('kategori')->unique()->filter()->values()->toArray();
    @endphp

    <div x-data="{ activeCat: 'All' }" class="min-h-screen pb-20">
        <x-navbar />

        <section class="max-w-6xl mx-auto px-6 pt-28 md:pt-36">
            <a href="/#blog" class="inline-flex items-center gap-2 text-xs uppercase font-semibold text-gray-500 hover:text-gray-900 dark:hover:text-white mb-8">Kembali ke Beranda</a>

            <div class="mb-10 max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">Jurnal & Artikel</h1>
            </div>

            <!-- LIVE FILTER BUTTONS -->
            <div class="flex flex-wrap gap-2 mb-10">
                <button @click="activeCat = 'All'" :class="activeCat === 'All' ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-white dark:bg-[#18181b] text-gray-600 dark:text-gray-300'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-gray-200 dark:border-gray-800 transition-colors">Semua</button>
                @foreach($categories as $cat)
                    <button @click="activeCat = '{{ $cat }}'" :class="activeCat === '{{ $cat }}' ? 'bg-gray-900 text-white dark:bg-white dark:text-gray-900' : 'bg-white dark:bg-[#18181b] text-gray-600 dark:text-gray-300'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-gray-200 dark:border-gray-800 transition-colors">{{ $cat }}</button>
                @endforeach
            </div>

            <!-- GRID ARTIKEL -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <article x-show="activeCat === 'All' || activeCat === '{{ $article->kategori }}'" x-transition.opacity.duration.400ms class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-4 shadow-sm group flex flex-col h-full">
                        <a href="{{ url('/blog/' . $article->slug) }}" class="relative h-48 w-full block rounded-2xl overflow-hidden bg-gray-100 dark:bg-white/5 mb-5 shrink-0">
                            @if($article->thumbnail) <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"> @endif
                        </a>
                        <div class="flex flex-col flex-1 px-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider mb-2 text-gray-500">{{ $article->kategori }}</span>
                            <a href="{{ url('/blog/' . $article->slug) }}" class="block mb-2">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-gray-500 transition-colors">{{ $article->judul }}</h3>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
</x-layout>