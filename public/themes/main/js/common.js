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
                        $('#name-err').text(err.errors.name[0]);
                    }
                    if(err.errors.phone){
                        $('#phone-err').text(err.errors.phone[0]);
                    }
                    if(err.errors.email){
                        $('#email-err').text(err.errors.email[0]);
                    }
                    if(err.errors.subject){
                        $('#subject-err').text(err.errors.subject[0]);
                    }
                    if(err.errors.message){
                        $('#message-err').text(err.errors.message[0]);
                    }
                }
            });

        });

    }
}


$(document).ready(function() {
    App.swiperFeedbackCustomer()
    App.submitFormContact()
})
