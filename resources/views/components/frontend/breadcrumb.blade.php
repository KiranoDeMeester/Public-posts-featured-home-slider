@props([
    'title',
    'parentUrl' => null,
    'parentText' => null
])

<div class="breadcumb-area section_padding_50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breacumb-content d-flex align-items-center justify-content-between">
                    {{-- De grote titel links --}}
                    <h3 class="font-pt mb-0">{{ $title }}</h3>

                    {{-- Het pad (links) rechts --}}
                    <p class="mb-0">
                        <a href="{{ route('home') }}">Home</a>

                        {{-- Toon enkel een tussenstap als deze is meegegeven (bijv. naar 'Artikels') --}}
                        @if($parentUrl && $parentText)
                            <i class="fa fa-angle-right mx-2"></i>
                            <a href="{{ $parentUrl }}">{{ $parentText }}</a>
                        @endif

                        <i class="fa fa-angle-right mx-2"></i>
                        <span class="text-muted">{{ \Illuminate\Support\Str::limit($title, 35) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
