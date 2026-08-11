<nav class="navbar navbar-expand-lg sticky-top py-0" style="background-color: #ffffff;">
    <div class="container position-relative">
        
        <a class="navbar-brand m-0 p-0" href="">
            <!-- 1. Tambahkan id="navbar-logo" -->
            <!-- 2. data-default-logo: Menyimpan path logo saat di paling atas -->
            <!-- 3. data-scrolled-logo: Menyimpan path logo baru saat di-scroll -->
            <img id="navbar-logo"
                 src="{{ asset('assets/images/logo-arrashine-white.png') }}" 
                 data-default-logo="{{ asset('assets/images/logo-arrashine-white.png') }}"
                 data-scrolled-logo="{{ asset('assets/images/logo-arrashine-scrolled.png') }}" 
                 alt="Logo ArraShine" 
                 class="position-absolute start-0 top-0 d-inline-block m-0 p-0" 
                 style="height: 160px; width: auto; z-index : 2010; transition: all 0.2s linier;">
        </a>
        
        <button class="navbar-toggler ms-auto my-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse py-4" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-4">
                <li class="nav-item"><a class="nav-link text-dark active" href="/">HOME</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/profile">PROFIL</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/product">OUR PRODUCTS</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/article">NEWS & ARTICLE</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/contact">CONTACT</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logo = document.getElementById("navbar-logo");
        
        // Mengambil path gambar dari atribut data-
        const defaultLogo = logo.getAttribute("data-default-logo");
        const scrolledLogo = logo.getAttribute("data-scrolled-logo");

        window.addEventListener("scroll", function () {
            // Jika posisi scroll lebih dari 50 piksel dari atas
            if (window.scrollY > 50) {
                if (logo.src !== scrolledLogo) {
                    logo.src = scrolledLogo;
                    // Opsional: Anda juga bisa memperkecil ukuran logo sedikit saat di-scroll agar lebih rapi
                    logo.style.height = "50px";
                    logo.classList.add("logo-scroll");
                }
            } else {
                // Jika posisi kembali paling atas (mentok)
                if (logo.src !== defaultLogo) {
                    logo.src = defaultLogo;
                    logo.classList.remove("logo-scroll");
                    logo.style.height = "160px"; // Kembalikan ke ukuran semula
                }
            }
        });
    });
</script>