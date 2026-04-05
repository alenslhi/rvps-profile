<x-layout>
    <x-navbar />

    <section class="py-20 bg-gray-50 dark:bg-darkbg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            
            <a href="/#blog" class="inline-flex items-center gap-2 text-brand hover:text-brand-dark mb-8 font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Semua <span class="text-brand">Artikel Blog</span></h1>
                <p class="text-gray-600 dark:text-gray-400">Seluruh Artikel Blog Saya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="flex flex-col bg-white dark:bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:border-brand/30 transition-all duration-300 group">
                        <a href="{{ url('/blog/' . $article->slug) }}" class="relative h-48 overflow-hidden block">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </a>
                        <div class="flex-1 flex flex-col p-6">
                            <div class="flex items-center gap-3 text-xs font-medium text-gray-500 dark:text-gray-400 mb-3">
                                <span class="px-2.5 py-1 bg-gray-50 dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-700 text-brand">{{ $article->kategori }}</span>
                            </div>
                            <a href="{{ url('/blog/' . $article->slug) }}" class="block mt-2">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-brand transition-colors">{{ $article->judul }}</h3>
                            </a>
                            <p class="mt-3 text-gray-600 dark:text-gray-400 text-sm line-clamp-3 flex-1">{{ Str::limit(strip_tags($article->konten), 120) }}</p>
                            <div class="mt-6 flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4">
                                <span class="text-xs text-gray-500">{{ $article->created_at->translatedFormat('d F Y') }}</span>
                                <a href="{{ url('/blog/' . $article->slug) }}" class="text-sm font-semibold text-brand hover:text-brand-dark transition-colors flex items-center gap-1">Baca Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-12"><p class="text-gray-500">Belum ada artikel.</p></div>
                @endforelse
            </div>

        </div>
    </section>
</x-layout>