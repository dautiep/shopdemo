        <!-- FOOTER START -->
			<footer>
				<div class="section background-dark">
					<!-- email and phone numbers -->
					<div class="line">
						<div class="margin">
							<div class="fullwidth text-center margin-bottom-40">
								<h5>lovelycomestic@gmail.com</h5>
							</div>
							<div class="fullwidth phone-number margin-bottom-60">
                                <div class="s-12 m-6 l-6 margin-s-bottom-60">
                                        <span>Liên Hệ</span><br />
                                        <a href="">+971 123 456 789</a>
                                </div>
							</div>
						</div>
					</div>
					<!-- contact form -->
					<div class="line">
						<form action="javascript:void(0)" class="footer-form">
                            @csrf
							<div class="fullwidth">
								<div class="margin">
									<div class="s-12 m-6 l-6">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Họ Tên" title="Full Name" />
                                            <div class="alert-err" role="alert" id="name-err">
                                            </div>
                                        </div>
									</div>
									<div class="s-12 m-6 l-6">
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Email" title="Email"/>
                                            <div class="alert-err" role="alert" id="email-err">
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="margin">
									<div class="s-12 m-6 l-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" placeholder="Số Điện Thoại" title="Mobile Number"/>
                                            <div class="alert-err" role="alert" id="phone-err">
                                            </div>
                                        </div>
									</div>
									<div class="s-12 m-6 l-6">
                                        <div class="form-group">
                                            <input type="text" name="subject" placeholder="Chủ Đề" title="Subject" />
                                            <div class="alert-err" role="alert" id="subject-err">
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="s-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Lời Nhắn" rows="3"></textarea>
                                        <div class="alert-err" role="alert" id="message-err">
                                        </div>
                                    </div>
								</div>
								<div class="s-12 m-12 l-3 button-contact">
									<input id="btn-contact" type="submit" class="button" value="Gửi">
								</div>
                                <div class="s-12 m-12 l-8">
                                    <div class="alert-errors" role="alert" id="err-alert">
                                    </div>
                                    <div class="alert-success-info" role="alert" id="success-alert">
                                    </div>
                                </div>
							</div>
						</form>
					</div>
				</div>

				<!-- footer bottom bar -->
				<div class="copyright">
					<div class="line">
						<div class="margin">
							<!-- left -->
							<div class="s-12 m-12 l-8 footer-links">
								<ul class="footer-bar-links">
									<li><a href="{{ route('public.index') }}">Trang Chủ</a></li>
									<li><a href="{{ route('public.about-us') }}">Về Chúng Tôi</a></li>
									<li><a href="{{ route('get_reset') }}">Tin Tức</a></li>
									<li><a href="{{ route('product.index') }}">Sản Phẩm</a></li>
									<li><a href="{{ route('public.get-contact') }}">Liên Hệ</a></li>
								</ul>
								<p>Copyright &copy; 2021, Lovely Cosmetic</p>
							</div>
							<!-- right -->
							<div class="s-12 m-12 l-4 payment-methods">
                                {{-- <div class="footer_item " > --}}
                                    <div class="footer_SocialNetwork" >
                                        <div class="fb-page" data-href="https://www.facebook.com/Blog-Everyday-325198725591021/" data-tabs="timeline" data-width="" data-height="70px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/Blog-Everyday-325198725591021/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Blog-Everyday-325198725591021/">Blog Everyday</a></blockquote></div>
                                    </div>
                                 {{-- </div> --}}
							</div>
						</div>
					</div>
				</div>
			</footer>
		<!-- FOOTER END -->
        {!! Theme::footer() !!}
	</div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "325198725591021");
  chatbox.setAttribute("attribution", "biz_inbox");
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v11.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
    </body>
</html>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "timeOut": "3000",
    "extendedTimeOut": "3000"
    }

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="NQ14dUiC"></script>

