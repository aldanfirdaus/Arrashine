@extends('index2')

@section('content')

    <div class="container mt-5 py-5" style="font-family: 'Lato', sans-serif;">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="fw-bold">{{ $article->title }}</h3>
                <p class="text-muted">
                    {{ $article->created_at->format('d F Y') }}
                </p>

                <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded mb-4 d-block mx-auto"
                    width="400">

                <div class="article-content">
                    {!! $article->body !!}
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Latest -->
                @include('pages.articleComponents.latest')

                <!-- Most Visited -->
                @include('pages.articleComponents.visited')
            </div>
        </div>

    </div>

@endsection