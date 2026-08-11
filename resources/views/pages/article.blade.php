@extends('index2')

@section('content')

    <section class="article pb-4">
        <div class="container" style="padding-top: 100px; font-family: 'Lato', sans-serif;
                    font-weight: 400;
                    font-style: normal;">
            <div class="row justify-content-between">
                <!-- Artikel -->
                <div class="col-lg-7">

                    @foreach($articles as $article)

                        <!-- Artikel -->
                        <div class="row article-item mb-3 pb-3 border-bottom">

                            <!-- Gambar -->
                            <div class="col-md-4">
                                <a href="article/{{ $article->slug }}">
                                    <img src="{{ asset('storage/' . $article->image) }}"
                                        class="img-fluid rounded article-image" alt="{{ $article->title }}">
                                </a>
                            </div>

                            <!-- Isi -->
                            <div class="col-md-8">

                                <small class="text-muted">
                                    {{ $article->created_at->diffForHumans() }}
                                </small>

                                <h3 class="mt-2 mb-3">
                                    <a href="article/{{ $article->slug }}" class="text-dark text-decoration-none">
                                        {{ $article->title }}
                                    </a>
                                </h3>

                                <p class="text-secondary">
                                    {{ Str::limit(strip_tags($article->body), 180) }}
                                </p>

                            </div>
                            
                        </div>


                    @endforeach

                    <div class="text-center">
                        {{ $articles->links() }}
                    </div>
                </div>



                <!-- Sidebar -->
                <div class="col-lg-4">

                    <!-- Latest -->
                    @include('pages.articleComponents.latest')

                    <!-- Most Visited -->
                    @include('pages.articleComponents.visited')

                </div>

            </div>

        </div>

    </section>

@endsection