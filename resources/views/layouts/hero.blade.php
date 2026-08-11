<header id="home" class="hero-section d-flex align-items-center position-relative text-center">

    <!-- OBJEK FAVORITE: Sekarang berupa gambar statis (tidak bisa diklik) -->
    <!-- Menggunakan kelas utilitas Bootstrap untuk posisi -->
    <!-- <img src="{{ asset('assets/images/favorite-hero.svg') }}" 
         alt="Label Favorite" 
         class="img-favorite position-absolute start-0 top-50 translate-middle-y"> -->

    <!-- KONTEN TEKS: REVEAL YOUR EVERYDAY SCENT, dst -->
    <div class="container text-dark mt-5">
        <h1 class="display-9 text-uppercase mb-1" style="font-family: 'Bellefair', serif;">
            REVEAL YOUR EVERYDAY SCENT
        </h1>
        <p class="lead" style="font-family: 'Bellefair', serif; color: #3B3F53;">
            Long Lasting <span class="fst-italic" style="font-family: 'Playfair Display', serif;">eau de parfume</span>
        </p>

        <!-- Baris Gambar Produk Anda -->
        <div class="row justify-content-center">

            <!-- Produk Kiri: MOMENT OF NIGHT -->
            <div class="col-4">
                <div class="product-wrapper">
                    <img src="{{ asset('assets/images/hero/produk-1.png') }}" alt="Moment of Night"
                        class="img-fluid product-side product-left">
                </div>
            </div>

            <!-- Produk Tengah: SOUL & SPIRIT (Diberi col lebih besar agar dominan) -->
            <div class="col-4">
                <div class="product-wrapper">
                    <img src="{{ asset('assets/images/hero/produk-2.png') }}" alt="Soul & Spirit"
                        class="img-fluid product-center">
                </div>
            </div>

            <!-- Produk Kanan: MY PERFECT LIFE -->
            <div class="col-4">
                <div class="product-wrapper">
                    <img src="{{ asset('assets/images/hero/produk-3.png') }}" alt="My Perfect Life"
                        class="img-fluid product-side product-right">
                </div>
            </div>

        </div>
    </div>
</header>