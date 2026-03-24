@props(['post'])

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

    {{-- Inleiding (Excerpt) --}}
    @if($post->excerpt)
        <div class="post-excerpt mb-4">
            <p class="lead" style="font-style: italic; color: #555;">{{ $post->excerpt }}</p>
        </div>
    @endif

    {{-- 6. De volledige inhoud van de post --}}
    <div class="post-content mt-4" style="line-height: 1.8; font-size: 1.1rem;">
        <p>{!! nl2br(e($post->body)) !!}</p>
    </div>

</div>
