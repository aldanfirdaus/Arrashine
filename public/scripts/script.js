const swiper = new Swiper(".productSwiper", {

    slidesPerView: 3,

    spaceBetween: 30,

    loop: false,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },

    breakpoints: {

        0: {
            slidesPerView: 3
        },

        768: {
            slidesPerView: 3
        },

        992: {
            slidesPerView: 3
        }

    }

});

// Ajax Filter Gender
document.querySelectorAll(".gender-btn").forEach(button => {

    button.addEventListener("click", function () {

        let gender = this.dataset.gender;

        document.querySelectorAll(".gender-btn").forEach(btn => {

            btn.classList.remove("btn-dark");
            btn.classList.add("btn-light");

        });

        this.classList.remove("btn-light");
        this.classList.add("btn-dark");

        fetch(`/filterProduct?gender=${gender}`)

            .then(res => res.json())

            .then(products => {

                swiper.removeAllSlides();

                products.forEach(product => {
                    let bgClass = '';

                    if (product.gender == 'Man') {
                        bgClass = 'bg-man';
                    } else if (product.gender == 'Women') {
                        bgClass = 'bg-woman';
                    } else {
                        bgClass = 'bg-unisex';
                    }

                    swiper.appendSlide(`

                    <div class="swiper-slide">

                        <div class="product-card">

                        <div class="product-title ${bgClass}">
                        ${product.name.toUpperCase()}
                        </div>

                            <div class="img-wrapper">
                                <a href="/product/${product.id}">
                                    <img src="/storage/${product.image}">
                                </a>
                            </div>

                            <div class="text-center mb-3">

                                <a href="/product/${product.id}" class="more-info">MORE INFO >></a>

                            </div>

                        </div>

                    </div>

                `);

                });

                swiper.update();

            });

    });

});