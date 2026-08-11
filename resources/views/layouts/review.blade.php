<section class="review-section container mb-5">

    <h3 class="text-start mb-4" style="font-family: Bellefair, serif;">
        REVIEWS
    </h3>

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

        </div>

    </div>
</section>