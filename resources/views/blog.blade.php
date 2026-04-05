<x-layout>
    <div class="min-h-screen text-gray-900 font-sans pb-20">
        <x-navbar />

        <section class="max-w-6xl mx-auto px-6 pt-28 md:pt-36">
            
            <a href="/#blog" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mb-8 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>

            <div class="mb-12 max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4">Jurnal & Artikel</h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">Berisi tulisan, pemikiran, tutorial, dan wawasan seputar teknologi serta pengembangan sistem.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <article class="bg-white dark:bg-[#18181b] border border-gray-200 dark:border-gray-800/60 rounded-3xl p-4 shadow-sm hover:border-gray-300 dark:hover:border-gray-700 transition-colors flex flex-col group h-full">
                        
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
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                                    {{ $article->judul }}
                               </h3>
                            </a>

                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 mb-6 flex-1">
                                {{ Str::limit(strip_tags($article->konten), 120) }}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4 mt-auto">
                                <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">
                                    {{ $article->created_at->translatedFormat('d M Y') }}
                                </span>
                                <a href="{{ url('/blog/' . $article->slug) }}" class="text-[11px] uppercase tracking-wider font-bold text-gray-900 dark:text-white hover:text-gray-500 transition-colors flex items-center gap-1">
                                    Baca <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <!-- FOOTER (Gunakan desain footer yang sama dengan welcome) -->
    </div>
</x-layout>