<x-frontend.shell
    title="Categorie: {{ $category->name }}"
    meta-description="{{ $category->description ?? 'Bekijk alle artikels in ' . $category->name }}"
>
    <x-frontend.breadcrumb
        :title="'Categorie: ' . $category->name"
        :parentUrl="route('frontend.posts.index')"
        parentText="Artikels"
    />

    {{-- Post Overzicht --}}
    <section class="gazatte-blog-area section_padding_100_50">
        <div class="container">
            <div class="row">

                @forelse($posts as $post)
                    <div class="col-12 col-md-4">
                        <div class="gazette-single-todays-post mb-50">

                            {{-- Afbeelding --}}
                            @if($post->media)
                                <div class="todays-post-thumb mb-3">
                                    <a href="{{ route('frontend.posts.show', $post) }}">
                                        <img src="{{ $post->media->url() }}" alt="{{ $post->title }}" class="img-fluid">
                                    </a>
                                </div>
                            @endif

                            <div class="todays-post-content">
                                {{-- Tags --}}
                                <div class="gazette-post-tag">
                                    @foreach($post->categories->take(2) as $cat)
                                        <a href="{{ route('frontend.categories.show', $cat) }}"
                                           class="{{ $cat->id === $category->id ? 'font-weight-bold' : '' }}">
                                            {{ $cat->name }}
                                        </a>
                                    @endforeach
                                </div>

                                {{-- Titel (Link naar detail) --}}
                                <h3>
                                    <a href="{{ route('frontend.posts.show', $post) }}" class="font-pt">{{ $post->title }}</a>
                                </h3>

                                <span class="gazette-post-date mb-2 d-block">
                                    {{ optional($post->published_at)->format('d M Y') }}
                                </span>

                                <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Er zijn momenteel nog geen gepubliceerde artikels in de categorie <strong>{{ $category->name }}</strong>.
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
