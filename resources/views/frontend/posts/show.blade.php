<x-frontend.shell
    title="{{ $post->title }}"
    meta-description="{{ $post->excerpt }}"
>
    {{-- Breadcrumb (Navigatie bovenaan) --}}
    <div class="breadcumb-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breacumb-content d-flex align-items-center justify-content-between">
                        <h3 class="font-pt mb-0">Artikel Details</h3>
                        <p class="mb-0">
                            <a href="{{ route('home') }}">Home</a>
                            <i class="fa fa-angle-right mx-2"></i>
                            <a href="{{ route('frontend.posts.index') }}">Artikels</a>
                            <i class="fa fa-angle-right mx-2"></i>
                            {{ \Illuminate\Support\Str::limit($post->title, 30) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Het eigenlijke Artikel --}}
    <section class="gazatte-post-details-area section_padding_100_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="post-details-content mb-50">

                        {{-- 1. Categorieën --}}
                        <div class="gazette-post-tag">
                            @forelse($post->categories as $category)
                                <a href="{{ route('frontend.categories.show', $category) }}">{{ $category->name }}</a>
                            @empty
                                <a href="#">Algemeen</a>
                            @endforelse
                        </div>

                        {{-- 2. Titel --}}
                        <h2 class="font-pt mb-3">{{ $post->title }}</h2>

                        {{-- 3. Auteur en 4. Publicatiedatum --}}
                        <div class="post-meta-2 mb-4 text-muted" style="font-size: 0.9rem;">
                            <span>Door <strong>{{ $post->user?->name ?? 'Onbekend' }}</strong></span>
                            <span class="mx-2">|</span>
                            <span><i class="fa fa-calendar me-1"></i> {{ optional($post->published_at)->format('d M Y') }}</span>
                        </div>

                        {{-- 5. Afbeelding van de post --}}
                        @if($post->media)
                            <div class="post-thumbnail mb-5">
                                <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid w-100 rounded">
                            </div>
                        @endif

                        {{-- Inleiding (Excerpt) optioneel maar mooi --}}
                        @if($post->excerpt)
                            <div class="post-excerpt mb-4">
                                <p class="lead" style="font-style: italic; color: #555;">{{ $post->excerpt }}</p>
                            </div>
                        @endif

                        {{-- 6. De volledige inhoud van de post --}}
                        <div class="post-content mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                            {{-- nl2br zorgt ervoor dat enters uit de textarea ook echte enters worden in HTML --}}
                            <p>{!! nl2br(e($post->body)) !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.shell>
