<x-layout 
    title="{{ $article->judul }} | RVPS Blog" 
    description="{{ Str::limit(strip_tags($article->konten), 150) }}" 
    image="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('default-og.png') }}"
>
    <div class="bg-white min-h-screen text-gray-900 font-sans pb-24 selection:bg-gray-900 selection:text-white">
        <x-navbar />

        <!-- Container Artikel -->
        <article class="max-w-3xl mx-auto px-6 pt-28 md:pt-36" data-aos="fade-up">
            
            <a href="/blog" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-gray-500 hover:text-gray-900 mb-10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>

            <!-- Header Artikel -->
            <header class="mb-12">
                <div class="flex flex-wrap items-center gap-3 text-[11px] uppercase tracking-widest font-bold text-gray-500 mb-6">
                    <span class="px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-900 rounded-md">
                        {{ $article->kategori }}
                    </span>
                    <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
                    <span class="hidden sm:inline">&bull;</span>
                    <span>{{ $article->estimasi_waktu_baca ?? 5 }} min read</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 leading-[1.1] mb-10">
                    {{ $article->judul }}
                </h1>

                @if($article->thumbnail)
                    <div class="w-full aspect-video md:aspect-[2/1] rounded-3xl overflow-hidden border border-gray-200 bg-gray-50 shadow-sm">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </header>

            <!-- Konten Artikel (Rich Text / Markdown area) -->
            <div class="prose prose-lg max-w-none 
                        prose-headings:font-extrabold prose-headings:tracking-tight prose-headings:text-gray-900 
                        prose-p:text-gray-600 prose-p:leading-relaxed 
                        prose-a:text-gray-900 prose-a:font-semibold prose-a:underline prose-a:decoration-gray-300 hover:prose-a:decoration-gray-900 
                        prose-img:rounded-2xl prose-img:border prose-img:border-gray-200 prose-img:shadow-sm prose-img:mx-auto
                        prose-blockquote:border-l-4 prose-blockquote:border-gray-900 prose-blockquote:bg-gray-50 prose-blockquote:py-2 prose-blockquote:px-5 prose-blockquote:rounded-r-2xl prose-blockquote:not-italic prose-blockquote:text-gray-700
                        prose-code:text-gray-900 prose-code:bg-gray-100 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded-md prose-code:font-semibold prose-code:before:content-none prose-code:after:content-none
                        prose-pre:bg-gray-900 prose-pre:text-gray-100 prose-pre:rounded-2xl prose-pre:border prose-pre:border-gray-800
                        prose-ul:list-disc prose-ol:list-decimal prose-li:text-gray-600">
                
                {!! $article->konten !!}
                
            </div>

            <!-- Footer Penulis -->
            <footer class="mt-16 pt-8 border-t border-gray-200 flex items-center justify-between">
                <div>
                    <h4 class="text-xs uppercase tracking-wider font-semibold text-gray-500 mb-1">Ditulis Oleh</h4>
                    <p class="text-base font-bold text-gray-900">{{ $profile->nama_lengkap ?? 'Admin RVPS' }}</p>
                </div>
            </footer>

        </article>
    </div>
</x-layout>