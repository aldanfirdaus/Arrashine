<section class="review-section mt-3">

    <h3 class="text-start mb-4" style="font-family: Bellefair, serif;">
        Customer Reviews
    </h3>

    @if($product->reviews->count() > 0)
        <div class="review-slider">

            <div class="review-track">

                @foreach($reviews as $review)

                    <div class="review-card border border-2">

                        <img src="{{ asset('storage/' . $review->photo) }}">

                        <div class="rating">

                            @for($i = 1; $i <= 5; $i++)
                                {!! $i <= $review->rating ? '⭐' : '' !!}
                            @endfor

                        </div>

                        <p>{{ $review->comment }}</p>

                        <span>- {{ $review->name }}</span>

                    </div>

                @endforeach

                {{-- Duplicate agar looping mulus --}}

                @foreach($product->reviews as $review)

                    <div class="review-card border border-2">

                        <img src="{{ asset('storage/' . $review->photo) }}">

                        <div class="rating">

                            @for($i = 1; $i <= 5; $i++)
                                {!! $i <= $review->rating ? '⭐' : '' !!}
                            @endfor

                        </div>

                        <p>{{ $review->comment }}</p>

                        <span>- {{ $review->name }}</span>

                    </div>

                @endforeach

            </div>

        </div>
    @else

        <div class="text-center mt-3">
            <p class="text-secondary">
                There are no reviews yet for this product
            </p>
        </div>
    @endif
</section>