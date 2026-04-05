<x-layout 
    title="{{ $article->judul }} | RVPS Blog" 
    description="{{ Str::limit(strip_tags($article->konten), 150) }}" 
    image="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('default-og.png') }}"
>
    <x-navbar />

    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        
        <a href="/#blog" class="inline-flex items-center gap-2 text-brand hover:text-brand-dark mb-8 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <header class="mb-12">
            <div class="flex items-center gap-3 text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">
                <span class="px-3 py-1 bg-brand/10 dark:bg-brand/20 text-brand rounded-full">
                    {{ $article->kategori }}
                </span>
                <span>•</span>
                <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                <span>•</span>
                <span>{{ $article->estimasi_waktu_baca ?? 5 }} min read</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-tight mb-8">
                {{ $article->judul }}
            </h1>

            @if($article->thumbnail)
                <div class="w-full h-[400px] rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                </div>
            @endif
        </header>

        <div class="prose prose-lg dark:prose-invert max-w-none 
                    prose-a:text-brand hover:prose-a:text-brand-dark
                    prose-img:rounded-xl prose-img:shadow-md
                    text-gray-700 dark:text-gray-300 leading-relaxed">
            
            {{-- syntax {!! !!} digunakan untuk merender HTML dari Rich Editor Filament --}}
            {!! $article->konten !!}
            
        </div>

    </article>

    <footer class="bg-gray-50 dark:bg-darkbg/50 border-t border-gray-200 dark:border-gray-800 py-8 text-center mt-12">
        <p class="text-gray-500 dark:text-gray-400 text-sm">
            &copy; {{ date('Y') }} RVPS Blog.
        </p>
    </footer>
</x-layout>