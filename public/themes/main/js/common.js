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
    },

    submitFormContact: function () {
        $("#btn-contact").click(function (e) {
            e.preventDefault()

            $('#name-err').text('');
            $('#email-err').text('');
            $('#phone-err').text('');
            $('#subject-err').text('');
            $('#address-err').text('');
            $('#message-err').text('');

            var _token = $("input[name='_token']").val();
            var fullname = $("input[name='name']").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var subject = $("input[name='subject']").val();
            var message = $("textarea[name='message']").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:contact,
                type: "POST",
                data:{_token:_token, name:fullname, phone:phone, email:email, subject:subject, message:message},
                success: function (response) {
                    console.log(response)
                    if (response) {
                        if(response.success){
                            $('#success-alert').css('display', 'block');
                            $('#success-alert').text(response.success);
                            $('input[type="text"],textarea, input[type="email"]').val('');
                        }
                        else{
                            if(response.error){
                                $('#err-alert').css('display', 'block');
                                $('#err-alert').html('Gửi thông tin thất bại! Vui lòng thử lại sau');
                            }
                        }

                    }
                },
                error: function (response) {
                    var err = JSON.parse(response.responseText)
                    if(err.errors.name){
                        $('#name-err').css('display', 'block');
                        $('#name-err').text(err.errors.name[0]);
                    }
                    if(err.errors.phone){
                        $('#phone-err').css('display', 'block');
                        $('#phone-err').text(err.errors.phone[0]);
                    }
                    if(err.errors.email){
                        $('#email-err').css('display', 'block');
                        $('#email-err').text(err.errors.email[0]);
                    }
                    if(err.errors.subject){
                        $('#subject-err').css('display', 'block');
                        $('#subject-err').text(err.errors.subject[0]);
                    }
                    if(err.errors.message){
                        $('#message-err').css('display', 'block');
                        $('#message-err').text(err.errors.message[0]);
                    }
                }
            });

        });

    },

}


$(document).ready(function() {
    App.swiperFeedbackCustomer()
    App.submitFormContact()
})

function updateCart(cart_detail_id, product_cart_id)
{
    var data = {
        cart_detail_id : cart_detail_id,
        product_cart_id : product_cart_id,
        cart_detail_quantity : $('[data-cart-detail-' + cart_detail_id + '=' + cart_detail_id + ']').val(),
        product_quantity : $('[data-quantity-product-' + cart_detail_id + '=' + cart_detail_id + ']').val()
    };

    if (parseInt(data['cart_detail_quantity']) > parseInt(data['product_quantity'])) {
        Swal.fire({
            icon: 'warning',
            title: 'Chú ý...',
            text: 'Số lượng sản phẩm vượt quá số lượng cho phép!'
        });
    } else {
        $.ajax({
            url: "/cart/update-cart",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                        Swal.fire({
                        title: 'Thành công',
                        text: "Cập nhật thành công",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Xác nhận'
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    })
                } else {
                    toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                }
            },
            error: function(response) {
                toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
            }
        });
    }
}

function removeCart(cart_detail_id)
{
    var data = {
        detail_cart_id : $('.cart-' + cart_detail_id).data('cart-detail-'+ cart_detail_id)
    };
    Swal.fire({
        title: 'Bạn có chắc muốn xóa sản phẩm này không?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Xác nhận',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            $('.loader').show();
            $.ajax({
                url: "cart/remove-detail-cart",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'POST',
                data: data,
                success: function(response) {
                    $('.loader').hide();
                    if (response.success) {
                            Swal.fire({
                            title: 'Thành công',
                            text: "Đã xóa sản phẩm",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Xác nhận'
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        })
                    } else {
                        toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                    }
                    },
                    error: function(response) {
                        toastr.error('Có lỗi xảy ra vui lòng thử lại sau.')
                    }
                });
            }
    })
}


