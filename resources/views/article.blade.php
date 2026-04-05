<x-layout 
    title="{{ $article->judul }} | RVPS Blog" 
    description="{{ Str::limit(strip_tags($article->konten), 150) }}" 
    image="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('default-og.png') }}"
>
    <!-- Wrapper dengan AlpineJS untuk Progress Bar & Toast -->
    <div x-data="{
            scrollProgress: 0,
            showToast: false,
            updateScroll() {
                let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                this.scrollProgress = (winScroll / height) * 100;
            },
            copyLink() {
                navigator.clipboard.writeText(window.location.href);
                this.showToast = true;
                // Panggil konfeti dari library global yang sudah ditanam di layout
                confetti({ particleCount: 150, spread: 80, origin: { y: 0.6 }, zIndex: 999999 });
                setTimeout(() => { this.showToast = false; }, 3000);
            }
         }"
         @scroll.window="updateScroll()"
         class="bg-white dark:bg-[#09090b] min-h-screen text-gray-900 dark:text-gray-100 font-sans pb-24 transition-colors duration-500 relative selection:bg-gray-900 selection:text-white dark:selection:bg-white dark:selection:text-gray-900">
        
        <!-- READING PROGRESS BAR -->
        <div class="fixed top-0 left-0 h-1 bg-gray-900 dark:bg-white z-[100] transition-all duration-150 ease-out" :style="`width: ${scrollProgress}%`"></div>

        <x-navbar />

        <article class="max-w-3xl mx-auto px-6 pt-28 md:pt-36" data-aos="fade-up">
            
            <a href="/blog" class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mb-10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>

            <header class="mb-12">
                <div class="flex flex-wrap items-center gap-3 text-[11px] uppercase tracking-widest font-bold text-gray-500 dark:text-gray-400 mb-6">
                    <span class="px-3 py-1.5 bg-gray-50 dark:bg-[#18181b] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-md shadow-sm">
                        {{ $article->kategori }}
                    </span>
                    <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
                    <span class="hidden sm:inline">&bull;</span>
                    <span>{{ $article->estimasi_waktu_baca ?? 5 }} min read</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-[1.1] mb-10">
                    {{ $article->judul }}
                </h1>

                @if($article->thumbnail)
                    <div class="w-full aspect-video md:aspect-[2/1] rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800/60 bg-gray-50 dark:bg-white/5 shadow-sm">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </header>

            <!-- KONTEN ARTIKEL (Prose) -->
            <div class="prose prose-lg max-w-none 
                        prose-headings:font-extrabold prose-headings:tracking-tight prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-p:leading-relaxed 
                        prose-a:text-gray-900 dark:prose-a:text-white prose-a:font-semibold prose-a:underline prose-a:decoration-gray-300 dark:prose-a:decoration-gray-700 hover:prose-a:decoration-gray-900 dark:hover:prose-a:decoration-white 
                        prose-img:rounded-2xl prose-img:border prose-img:border-gray-200 dark:prose-img:border-gray-800 prose-img:shadow-sm prose-img:mx-auto
                        prose-blockquote:border-l-4 prose-blockquote:border-gray-900 dark:prose-blockquote:border-white prose-blockquote:bg-gray-50 dark:prose-blockquote:bg-[#18181b] prose-blockquote:py-2 prose-blockquote:px-5 prose-blockquote:rounded-r-2xl prose-blockquote:not-italic prose-blockquote:text-gray-700 dark:prose-blockquote:text-gray-300
                        prose-code:text-gray-900 dark:prose-code:text-white prose-code:bg-gray-100 dark:prose-code:bg-[#18181b] prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded-md prose-code:font-semibold prose-code:before:content-none prose-code:after:content-none
                        prose-pre:bg-gray-900 dark:prose-pre:bg-black prose-pre:text-gray-100 prose-pre:rounded-2xl prose-pre:border prose-pre:border-gray-800 dark:prose-pre:border-gray-800/60
                        prose-ul:list-disc prose-ol:list-decimal prose-li:text-gray-600 dark:prose-li:text-gray-400">
                {!! $article->konten !!}
            </div>

            <!-- FOOTER & TOMBOL SHARE KONFETI -->
            <footer class="mt-16 pt-8 border-t border-gray-200 dark:border-gray-800/60 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div>
                    <h4 class="text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 mb-1">Ditulis Oleh</h4>
                    <p class="text-base font-extrabold text-gray-900 dark:text-white">{{ $profile->nama_lengkap ?? 'Admin RVPS' }}</p>
                </div>

                <button @click="copyLink()" class="flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gray-50 dark:bg-[#18181b] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white font-bold text-xs uppercase tracking-wider hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Salin Tautan
                </button>
            </footer>
        </article>

        <!-- TOAST NOTIFICATION -->
        <div x-show="showToast" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[110]" style="display: none;">
            <div class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-gray-800 dark:border-gray-200">
                <svg class="w-5 h-5 text-green-400 dark:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-xs uppercase tracking-wider font-bold">Tautan berhasil disalin!</span>
            </div>
        </div>
    </div>
</x-layout>