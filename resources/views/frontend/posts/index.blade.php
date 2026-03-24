<x-frontend.shell
    title="Alle Artikels"
    meta-description="Een overzicht van al onze gepubliceerde posts."
>
    <x-frontend.breadcrumb
        :title="request('q') ? 'Zoekresultaten voor: ' . request('q') : 'Alle Artikels'"
    />

    {{-- Het raster met de posts --}}
    <section class="gazatte-blog-area section_padding_100_50">
        <div class="container">

            {{-- EXTRA: Handig zoekveld op de pagina zelf! --}}
            <div class="row mb-5">
                <div class="col-12 col-md-8 offset-md-2">
                    <form action="{{ route('frontend.posts.index') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control" placeholder="Zoek in alle artikels..." value="{{ request('q') }}">
                        <button type="submit" class="btn btn-dark ml-2 ms-2">Zoeken</button>
                    </form>
                </div>
            </div>

            <div class="row">

                @forelse($posts as $post)
                    <div class="col-12 col-md-4">
                        <div class="gazette-single-todays-post mb-50">

                            @if($post->media)
                                <div class="todays-post-thumb mb-3">
                                    <a href="{{ route('frontend.posts.show', $post) }}">
                                        <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid">
                                    </a>
                                </div>
                            @endif

                            <div class="todays-post-content">
                                <div class="gazette-post-tag">
                                    @foreach($post->categories->take(2) as $category)
                                        <a href="{{ route('frontend.categories.show', $category) }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>

                                <h3>
                                    <a href="{{ route('frontend.posts.show', $post) }}" class="font-pt">{{ $post->title }}</a>
                                </h3>

                                <span class="gazette-post-date mb-2 d-block">
                                    {{ optional($post->published_at)->format('d M Y') }}
                                </span>

                                <p>
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 120) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Geen artikels gevonden voor deze zoekopdracht. Probeer een andere term.
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Paginatie --}}
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
