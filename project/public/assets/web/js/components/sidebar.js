if ($('.sidebar-video .swiper').length) {
    let sidebarVideoSwiper = new Swiper('.sidebar-video .swiper', {
        speed: 400,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
        },
        loop: true,
        navigation: {
            nextEl: '.sidebar-video .custom-pagination .custom-swiper-button-next',
            prevEl: '.sidebar-video .custom-pagination .custom-swiper-button-prev'
        },
    });
}
if ($('.sidebar-authors .swiper').length) {
    let sidebarAuthorSwiper = new Swiper('.sidebar-authors .swiper', {
        speed: 400,
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
        },
        loop: true,
        navigation: {
            nextEl: '.sidebar-authors .custom-pagination .custom-swiper-button-next',
            prevEl: '.sidebar-authors .custom-pagination .custom-swiper-button-prev'
        },
    });
}
