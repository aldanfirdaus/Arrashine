<section class="container py-5">

    <div class="d-flex justify-content-between mb-5">

        <h2 class="mb-1" style="font-family: 'Bellefair', serif;">OUR PRODUCTS</h2>

        <div class="btn-group">

            <button class="btn btn-dark gender-btn" data-gender="Man">
                Man
            </button>

            <button class="btn btn-light gender-btn" data-gender="Women">
                Woman
            </button>

            <button class="btn btn-light gender-btn" data-gender="Unisex">
                Unisex
            </button>

        </div>

    </div>

    <div class="swiper productSwiper">
        <div class="swiper-wrapper">
            @foreach($products as $product)

                <div class="swiper-slide">

                    <div class="product-card">

                        @php
                            $colors = [
                                'Man' => 'bg-man',
                                'Woman' => 'bg-woman',
                                'Unisex' => 'bg-unisex',
                            ];
                        @endphp

                        <div class="product-title {{ $colors[$product->gender] ?? 'bg-unisex' }}">
                            {{ strtoupper($product->name) }}
                        </div>

                        <div class="img-wrapper">
                            <a href="/product/{{ $product->id }}">
                                <img src="{{ asset('storage/' . $product->image) }}">
                            </a>
                        </div>

                        <div class="text-center mb-3">
                            <a href="/product/{{ $product->id }}" class="more-info">MORE INFO >></a>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <!-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> -->

    </div>

</section>

<!-- harga di JS -->
<!-- <div class="text-center py-3">

    Rp ${Number(product.price).toLocaleString('id-ID')}

</div> -->