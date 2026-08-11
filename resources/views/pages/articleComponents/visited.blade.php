<h4 class="mb-4 mt-5 fw-bold">
    Most Visited
</h4>


@foreach($mostVisited as $article)

    <div class="d-flex pb-2 mb-2 border-bottom">

        <a href="{{ url('/article/' . $article->slug) }}">
            <img src="{{ asset('storage/' . $article->image) }}" width="50" class="rounded me-3"
                style="object-fit:cover; aspect-ratio: 1 / 1;">
        </a>

        <div>

            <a href="{{ url('/article/' . $article->slug) }}" class="text-dark text-decoration-none">

                {{ Str::limit($article->title, 50) }}

            </a>

            <br>

            <small class="text-muted">

                {{ $article->created_at->format('d M Y') }}

            </small>

        </div>

    </div>

@endforeach