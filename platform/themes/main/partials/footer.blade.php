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
									<li><a href="">Contact Us</a></li>
									<li><a href="">Faqs</a></li>
									<li><a href="">Shipping</a></li>
									<li><a href="">Return Policy</a></li>
									<li><a href="">Order Tracking</a></li>
								</ul>
								<p>Cpyright &copy; 2016, Lovely Cosmetics Responsive HTML Template, Designed by <a href="https://themeforest.net/user/axactidea" target="_blank">Axact Idea</a></p>
							</div>
							<!-- right -->
							<div class="s-12 m-12 l-4 payment-methods">
								<i class="fa fa-cc-visa fa-2x"></i>
								<i class="fa fa-cc-mastercard fa-2x"></i>
								<i class="fa fa-cc-paypal fa-2x"></i>
								<i class="fa fa-credit-card fa-2x"></i>
							</div>
						</div>
					</div>
				</div>
			</footer>
		<!-- FOOTER END -->
        {!! Theme::footer() !!}
	</div>
    </body>
</html>
