<x-frontend.shell
    title="Alle Artikels"
    meta-description="Een overzicht van al onze gepubliceerde posts."
>
    {{-- Een mooie hoofding (Breadcrumb area) in de stijl van Gazette --}}
    <div class="breadcumb-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breacumb-content d-flex align-items-center justify-content-between">
                        <h3 class="font-pt mb-0">Alle Artikels</h3>
                        <p class="mb-0">Ontdek ons nieuwsoverzicht</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Het raster met de posts --}}
    <section class="gazatte-blog-area section_padding_100_50">
        <div class="container">
            <div class="row">

                @forelse($posts as $post)
                    {{-- col-md-4 zorgt ervoor dat er 3 posts naast elkaar staan op grotere schermen --}}
                    <div class="col-12 col-md-4">
                        <div class="gazette-single-todays-post mb-50">

                            {{-- 1. Afbeelding --}}
                            @if($post->media)
                                <div class="todays-post-thumb mb-3">
                                    <a href="{{ route('frontend.posts.show', $post) }}">
                                        <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid">
                                    </a>
                                </div>
                            @endif

                            <div class="todays-post-content">
                                {{-- 2. Categorieën --}}
                                <div class="gazette-post-tag">
                                    @foreach($post->categories->take(2) as $category)
                                        <a href="{{ route('frontend.categories.show', $category) }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>

                                {{-- 3. Titel --}}
                                <h3>
                                    <a href="{{ route('frontend.posts.show', $post) }}" class="font-pt">{{ $post->title }}</a>
                                </h3>

                                {{-- 4. Datum --}}
                                <span class="gazette-post-date mb-2 d-block">
                                    {{ optional($post->published_at)->format('d M Y') }}
                                </span>

                                {{-- 5. Korte inleiding (Excerpt) --}}
                                <p>
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 120) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Er zijn momenteel geen gepubliceerde artikels beschikbaar.
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Paginatie (de 'Volgende' en 'Vorige' knoppen) --}}
            <div class="row">
                <div class="col-12">
                    <div class="gazette-pagination-area mb-50 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-frontend.shell>
