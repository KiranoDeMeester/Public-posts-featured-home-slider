<x-frontend.shell
    title="{{ $post->title }}"
    meta-description="{{ $post->excerpt }}"
>
    <x-frontend.breadcrumb
        title="Artikel Details"
        :parentUrl="route('frontend.posts.index')"
        parentText="Artikels"
    />

    {{-- Detail Sectie --}}
    <section class="gazatte-post-details-area section_padding_100_50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">

                    {{-- COMPONENT 1: De inhoud van de post --}}
                    {{-- We geven de $post variabele door naar het component --}}
                    <x-frontend.posts.single-content :post="$post" />

                    {{-- COMPONENT 2: De discussie placeholder --}}
                    <x-frontend.posts.discussion-area />

                </div>
            </div>
        </div>
    </section>
</x-frontend.shell>
