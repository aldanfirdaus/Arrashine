@extends('index2')

@section('content')
    <div class="container" style="padding-top: 100px; font-family: 'Bellefair', serif;">
        <h1 class="text-end">PROFILE</h1>

        <p class="mt-5" style="text-align: justify; font-size: 1.4rem; font-family: Lato, sans-serif;
            font-weight: 300;">Arrashine by Rose presents a premium eau de parfum crafted from a carefully balanced
            composition of high-quality ingredients, designed to deliver a refined and long-lasting scent. Each fragrance is
            made to stay on the skin for hours, evolving softly over time while maintaining its elegant character. Created
            to blend seamlessly with your daily life, Arrashine by Rose accompanies every moment from formal occasions to
            casual days, with a subtle yet memorable presence that feels effortlessly sophisticated.</p>
    </div>

    <!-- Teks Running -->
    @include('layouts.marquee')
@endsection