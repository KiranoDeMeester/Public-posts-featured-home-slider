<x-frontend.shell
    title="{{ $post->title }}"
    meta-description="{{ $post->excerpt }}"
>
    {{-- Breadcrumb --}}
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
