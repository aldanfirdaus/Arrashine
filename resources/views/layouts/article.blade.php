<section class="news-section py-3">
    <div class="container">

    <h2 class="mb-5" style="font-family: 'Bellefair', serif;">NEWS & ARTICLE</h2>

        @foreach($articles as $article)

        <div class="row article-item mb-5 align-items-start">

            <div class="col-4 col-md-4 overflow-hidden">
                <img src="{{ asset('storage/'.$article->image) }}"
                    class="img-fluid article-image"
                    alt="{{ $article->title }}">
            </div>

            <div class="col-8 col-md-8">

                <h5 class="article-title  fw-bold" style="font-family: 'Lato';">
                    {{ $article->title }}
                </h5>

                <small class="text-muted" style="font-family: 'Lato';">
                    {{ $article->created_at->format('d F Y') }}
                </small>

                <p class="mt-3" style="font-family: 'Lato';">
                    {{ Str::limit(strip_tags($article->body),150) }}
                </p>

                <a href="/article/{{ $article -> slug }}"
                    class="read-more" style="text-decoration:underline; color: black; font-family: 'Lato';">
                    READ MORE
                </a>

            </div>

        </div>

        @endforeach

    </div>
</section>