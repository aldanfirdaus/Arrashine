@extends('index2')

@section('content')

    <section class="products pb-4">

        <div class="container" style="padding-top: 100px; font-family: 'Bellefair', serif;">

            <h1 class="text-end mb-5">OUR PRODUCTS</h1>

            @include('pages.productComponents.filter')

            @include('pages.productComponents.card')

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>

        </div>

    </section>

@endsection