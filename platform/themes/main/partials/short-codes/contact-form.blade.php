<form class="customform" name="contact-us-form" method="post">
    @csrf
    <div class="margin">
        <div class="s-12 m-6 l-6 input-contact">
            <input type="text" name="name" placeholder="Họ tên của bạn"/>
            @if ($errors->has('name'))
                <span class="text-err-contact">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="s-12 m-6 l-6 input-contact">
            <input type="text" name="email" placeholder="Địa chỉ email" />
            @if ($errors->has('email'))
                <span class="text-err-contact">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="margin">
        <div class="s-12 m-6 l-6 input-contact">
            <input type="text" name="phone" placeholder="Số điện thoại"/>
            @if ($errors->has('phone'))
                <span class="text-err-contact">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="s-12 m-6 l-6 input-contact">
            <input type="text" name="subject" placeholder="Chủ đề"/>
            @if ($errors->has('subject'))
                <span class="text-err-contact">{{ $errors->first('subject') }}</span>
            @endif
        </div>
    </div>
    <div class="fullwidth input-contact">
        <textarea name="message" placeholder="Nội dung tin nhắn" rows="3"></textarea>
        @if ($errors->has('message'))
                <span class="text-err-contact">{{ $errors->first('message') }}</span>
            @endif
    </div>
    <div class="fullwidth">
        <input type="submit" value="Gửi">
    </div>
</form>
