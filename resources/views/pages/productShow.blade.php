@extends('index2')

@section('content')

    <div class="container py-5">

        <div class="row pt-5 mb-3">

            <div class="col-md-6 mb-3 justify-content-center align-items-start">
                <div class="product-gallery">

                    {{-- Gambar Besar --}}
                    <div class="main-image-wrapper">

                        <button type="button" class="gallery-btn gallery-prev" onclick="previousImage()">
                            <i class="bi bi-caret-left"></i>
                        </button>

                        <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}">

                        <button type="button" class="gallery-btn gallery-next" onclick="nextImage()">
                            <i class="bi bi-caret-right"></i>
                        </button>

                    </div>


                    {{-- Thumbnail --}}
                    <div class="thumbnail-container">

                        {{-- Cover --}}
                        <div class="thumbnail active" data-index="0" onclick="changeProductImage(0)">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Cover">
                        </div>


                        {{-- Gallery --}}
                        @foreach($product->images as $index => $image)

                            <div class="thumbnail" data-index="{{ $index + 1 }}" onclick="changeProductImage({{ $index + 1 }})">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery {{ $index + 1 }}">
                            </div>

                        @endforeach

                    </div>

                </div>
            </div>

            <div class="col-md-6">

                <h2 style="font-family: 'Bellefair', serif;">
                    {{ $product->name }}
                </h2>

                <p class="fs-5" style="font-family: Lato, sans-serif;
                                                                                    font-weight: 300;
                                                                                    font-style: normal;">
                    {{ $product->description }}
                </p>

                <div class="container">

                    <div class="row note-item">
                        <div class="col-3 note-title">
                            <h5>TOP<br>NOTES</h5>
                        </div>
                        <div class="col-9 note-content">
                            <h5>{{ $product->top_notes }}</h5>
                        </div>
                    </div>

                    <div class="row note-item">
                        <div class="col-3 note-title">
                            <h5>MIDDLE<br>NOTES</h5>
                        </div>
                        <div class="col-9 note-content">
                            <h5>{{ $product->middle_notes }}</h5>
                        </div>
                    </div>

                    <div class="row note-item-last">
                        <div class="col-3 note-title">
                            <h5>BASE<br>NOTES</h5>
                        </div>
                        <div class="col-9 note-content">
                            <h5>{{ $product->base_notes }}</h5>
                        </div>
                    </div>

                </div>

                <div class="row align-items-center my-3">

                    <div class="col-12 col-md-5">
                        <p class="text-start" style="font-family: Lato, sans-serif; font-size: 1.5rem; font-weight:300;">
                            Price <b>Rp {{ number_format($product->price, 0, ',', '.') }}</b>
                        </p>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="row">
                            <p class="text-end"
                                style="font-family: Lato, sans-serif; font-size: 1.2rem; font-weight:400; font-style: italic;">
                                Available on</b>
                            </p>
                        </div>
                        <div class="d-flex justify-content-end">
                            @php
                                $message = urlencode(
                                    "Halo Admin ArraShine,\n\n" .
                                    "Saya ingin membeli produk:\n\n" .
                                    "Nama Produk : {$product->name}\n" .
                                    "Harga : Rp " . number_format($product->price, 0, ',', '.') . "\n\n" .
                                    "Mohon informasi mengenai stok dan cara pembelian.\n\n" .
                                    "Terima kasih."
                                );
                            @endphp
                            <div class="col-2">
                                <a href="https://wa.me/{{ $admin->phone }}?text={{ $message }}" target="_blank">
                                    <img src="{{ asset('assets/images/logo-whatsapp.png') }}" width="40" alt="">
                                </a>
                            </div>

                            @if($product->shopee_link)
                                <div class="col-2">
                                    <a href="{{ $product->shopee_link }}" target="_blank">
                                        <img src="{{ asset('assets/images/logo-shopee.png') }}" width="40" alt="">
                                    </a>
                                </div>
                            @endif


                            @if($product->tokopedia_link)
                                <div class="col-2">
                                    <a href="{{ $product->tokopedia_link }}" target="_blank">
                                        <img src="{{ asset('assets/images/logo-tokopedia.png') }}" width="40" alt="">
                                    </a>
                                </div>
                            @endif



                            @if($product->tiktokshop_link)
                                <div class="col-2">
                                    <a href="{{ $product->tiktokshop_link }}" target="_blank">
                                        <img src="{{ asset('assets/images/logo-tiktok.png') }}" width="80" alt="">
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>
                <!-- 
                                            <a href="/product" class="btn btn-outline-dark">
                                                <i class="bi bi-arrow-left"></i> Back
                                            </a> -->

            </div>

        </div>

        <div class="row">
            @include('pages.productComponents.reviewDetail')
        </div>

    </div>

    <style>
        .note-item-last {
            border-bottom: 1px solid #8a8a8a;
        }

        .note-title {
            border-right: 1px solid #8a8a8a;
            padding: 25px 20px;
            font-family: 'Lato', sans-serif;
            font-weight: 300;

            display: flex;
            align-items: center;
        }

        .note-content {
            padding: 25px 30px;
            font-family: 'Lato', sans-serif;

            display: flex;
            align-items: center;
        }
    </style>

    <style>
        .product-gallery {
            width: 100%;
        }

        /* =========================
           GAMBAR BESAR
        ========================= */

        .main-image-wrapper {
            position: relative;

            width: 100%;
            height: 500px;

            background: #f8f8f8;
            border: 1px solid #1a1c26;
            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .main-image-wrapper img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            transition: opacity 0.2s ease;
        }


        /* =========================
           BUTTON KIRI KANAN
        ========================= */

        .gallery-btn {
            position: absolute;

            top: 50%;
            transform: translateY(-50%);

            width: 45px;
            height: 45px;

            border: 1px;
            border-radius: 50%;

            background: rgba(0, 0, 0, 0.55);
            opacity: 0.3;

            color: white;

            font-size: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            z-index: 5;
        }

        .gallery-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .gallery-prev {
            left: 15px;
        }

        .gallery-next {
            right: 15px;
        }


        /* =========================
           THUMBNAIL
        ========================= */

        .thumbnail-container {
            display: flex;

            gap: 12px;

            margin-top: 15px;

            overflow-x: auto;

            padding-bottom: 5px;
        }


        .thumbnail {
            flex: 0 0 90px;

            width: 90px;
            height: 90px;

            border: 1px solid #ddd;

            border-radius: 8px;

            overflow: hidden;

            cursor: pointer;

            background: white;

            transition: 0.2s;
        }


        .thumbnail img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }


        /* Thumbnail aktif */

        .thumbnail.active {
            border: 2px solid #000;
        }

        /* Hover */

        .thumbnail:hover {
            border-color: #1a1c26;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 768px) {

            .main-image-wrapper {
                height: 350px;
            }

            .thumbnail {
                flex: 0 0 75px;

                width: 75px;
                height: 75px;
            }

        }
    </style>

    <script>

        // Semua gambar
        const productImages = [

            // Gambar utama / cover
            "{{ asset('storage/' . $product->image) }}",

            // Gambar galeri
            @foreach($product->images as $image)
                "{{ asset('storage/' . $image->image) }}",
            @endforeach

    ];


        // Index gambar yang sedang aktif
        let currentImage = 0;


        // Ganti gambar
        function changeProductImage(index) {

            currentImage = index;

            const mainImage =
                document.getElementById('mainProductImage');


            // Efek fade
            mainImage.style.opacity = 0;


            setTimeout(() => {

                mainImage.src =
                    productImages[index];

                mainImage.style.opacity = 1;

            }, 100);


            // Hapus active dari semua thumbnail
            document
                .querySelectorAll('.thumbnail')
                .forEach(thumbnail => {

                    thumbnail.classList.remove('active');

                });


            // Tambahkan active ke thumbnail yang dipilih
            const activeThumbnail =
                document.querySelector(
                    `.thumbnail[data-index="${index}"]`
                );


            if (activeThumbnail) {
                activeThumbnail.classList.add('active');
            }

        }


        // Gambar sebelumnya
        function previousImage() {

            currentImage--;

            if (currentImage < 0) {

                currentImage =
                    productImages.length - 1;

            }

            changeProductImage(currentImage);

        }


        // Gambar berikutnya
        function nextImage() {

            currentImage++;

            if (currentImage >= productImages.length) {

                currentImage = 0;

            }

            changeProductImage(currentImage);

        }

    </script>
@endsection