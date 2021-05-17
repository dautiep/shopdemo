// cách code js gọi tên 

let App = {

    swiperFeedbackCustomer: function() {
        var swiperFeedbackCustomer = new Swiper('.customer-feedback__swiper', {
            slidesPerView: 3,
            spaceBetween: 25,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
}


$(document).ready(function() {

    App.swiperFeedbackCustomer()
})