$(document).ready(function () {

    // slide detail mobile by 1 img at page detail(mobile)
    var swiperDetail = new Swiper(".galerry-mobile", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // Swiper JS - banner-child:
    var swiperBannerRight = new Swiper(".swiperRight", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiperBannerTop = new Swiper(".swiperTop", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        // pagination: {
        //   el: ".swiper-pagination",
        //   clickable: true,
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiperBannerBot = new Swiper(".swiperBot", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        // pagination: {
        //   el: ".swiper-pagination",
        //   clickable: true,
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // header scroll
    $(window).scroll(function () {
        var sticky = $(".header__desktop"),
            scroll = $(window).scrollTop();

        if (scroll >= 150) sticky.addClass("header__desktop-sticky--active").removeClass("header__desktop-sticky");
        else sticky.removeClass("header__desktop-sticky--active").addClass("header__desktop-sticky");
    });
    // header mobile
    $(window).scroll(function () {
        var sticky = $(".header_mobile"),
            scroll = $(window).scrollTop();

        if (scroll >= 150) sticky.addClass("header__mobile-sticky--active").removeClass("header__mobile-sticky");
        else sticky.removeClass("header__mobile-sticky--active").addClass("header__mobile-sticky");
    });

    // slide product near footer at detail.
    var swiper_prodcuct = new Swiper('.slide_product', {
        spaceBetween: 30,
        slidesPerView: 3,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    var swiper_prodcuct = new Swiper('.slide_product_mobile', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    //slide detail
    var galleryThumbs = new Swiper('#gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 2,
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,

    });
    // slide detail header
    var galleryTop = new Swiper('#gallery-top', {
        spaceBetween: 10,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // thumbs: {
        //   swiper: galleryThumbs
        // }
    });
    // var galleryTop = new Swiper('#gallery-top', {
    //    thumbs: {
    //     swiper: galleryThumbs,
    //   },
    //   spaceBetween: 10,
    //   slidesPerView: 3,
    //   loop: true,
    //   loopedSlides: 5,
    //   autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    //   },
    //   navigation: {
    //     nextEl: ".swiper-button-next",
    //     prevEl: ".swiper-button-prev",
    //   },


    // });

    // slide feedback
    const slider = document.querySelector(".items");
    const slides = document.querySelectorAll(".item_temlapte");
    const button = document.querySelectorAll(".button");

    let current = Math.floor(Math.random() * slides.length);
    let prev = current > 0 ? current - 1 : slides.length - 1;
    let next = current < slides.length - 1 ? current + 1 : 0;

    const update = () => {
        slides.forEach(it => {
            it.classList.remove("active");
            it.classList.remove("prev");
            it.classList.remove("next");
        });

        slides[current].classList.add("active");
        slides[prev].classList.add("prev");
        slides[next].classList.add("next");
    }

    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener("click", () => i == 0 ? gotoPrev() : gotoNext());
    }

    const gotoPrev = () => current > 0 ? gotoNum(current - 1) : gotoNum(slides.length - 1);
    const gotoNext = () => current < slides.length - 1 ? gotoNum(current + 1) : gotoNum(0);

    const gotoNum = number => {
        current = number;
        prev = current > 0 ? current - 1 : slides.length - 1;
        next = current < slides.length - 1 ? current + 1 : 0;

        update();
    }

    update();

    //end JS
});

// cách code js gọi tên 

let App = {
    // start contact
    submitFormRegister: function () {
        $('#btn-register').click(function (e) {
            e.preventDefault()
            $('#name-err').text('');
            $('#email-err').text('');
            $('#phone-err').text('');
            $('#address-err').text('');
            $('#messenger-err').text('');
            var _token = $("input[name='_token']").val();
            var name = $("input[name='name']").val();
            var phone = $("input[name='phone']").val();
            var address = $("input[name='address']").val();
            var email = $("input[name='email']").val();
            var content = $("textarea[name='content']").val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: contact,
                method: "POST",
                data: {
                    _token,
                    name,
                    email,
                    address,
                    email,
                    phone,
                    content
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        if (response.success) {
                            $('.success-mess').css('display', 'block');
                            $('#success-alert').text(response.success);
                            $('input[type="text"],input[type="number"],textarea,input[type="email"]').val('');
                        } else {
                            if (response.error) {
                                $('.err-mess').css('display', 'block');
                                $('#err-alert').html('Gửi thông tin thất bại! Vui lòng thử lại sau');
                            }
                        }

                    }
                },
                error: function (response) {
                    console.log(response);
                    if (response.responseJSON.errors.name) {
                        $('#name-err').text(response.responseJSON.errors.name[0]);
                    }
                    if (response.responseJSON.errors.phone) {
                        $('#phone-err').text(response.responseJSON.errors.phone[0]);
                    }
                    if (response.responseJSON.errors.email) {
                        $('#email-err').text(response.responseJSON.errors.email[0]);
                    }
                    if (response.responseJSON.errors.address) {
                        $('#address-err').text(response.responseJSON.errors.address[0]);
                    }
                    if (response.responseJSON.errors.content) {
                        $('#messenger-err').text(response.responseJSON.errors.content[0]);
                    }
                }
            });
        })
    },
    // end contact

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


$(document).ready(function () {
    App.submitFormRegister()
    App.swiperFeedbackCustomer()
})