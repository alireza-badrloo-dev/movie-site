<div class="container ">
    <div class="gallery-wrapper">
        <div class="gallery" id="auto-gallery">
            @foreach ($movies as $movie)
                <article class="post-slide ">
                    <a href="{{ route('movie', $movie->id) }}" class="image-link-wrapper">
                        <figure class="image-figure">
                            <img src="/image/{{ $movie->poster }}" class="image-custom" alt="{{ $movie->title_fa }}">
                            <span class="image-title">{{ $movie->title_fa }}</span>
                        </figure>
                    </a>
                </article>
            @endforeach




        </div>
    </div>
</div>
