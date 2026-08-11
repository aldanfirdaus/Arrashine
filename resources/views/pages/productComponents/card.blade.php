<div class="row">

    @foreach($products as $product)

        <div class="col-6 col-md-4">

            <div class="product-card mb-4 mx-1">

                <div class="product-title">
                    {{ $product->name }}
                </div>

                <div class="img-wrapper">
                    <a href="/product/{{ $product->id }}">
                        <img src="{{ asset('storage/' . $product->image) }}">
                    </a>
                </div>

                <div class="text-center mb-2">
                    <a href="/product/{{ $product->id }}" class="more-info">MORE INFO >></a>
                </div>

            </div>

        </div>

    @endforeach

</div>