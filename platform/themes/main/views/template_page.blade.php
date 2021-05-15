<div class="container detail">
    {!! Theme::partial('breadcrumbs') !!}
    <h1 class="title-detail">{{$page->name}}</h1>
    <div class="detail-author">
        <p>Đăng bởi: {{$user->last_name}}, <span>Ngày: {{date_format($page->created_at, 'd/m/Y')}}</span></p>
    </div>
    <div class="detail-noselect">
        {!!$page->content!!}
    </div>
    <div class="detail-button d-flex">

        <div class="zalo-share-button zb-btn-blue--small" data-href="{{$page->url}}" data-oaid="579745863508352884" data-layout="3" data-color="blue" data-customize=false></div>


        <div class="fb-like czb like-btn-blue--small" data-href="https://developers.facebook.com/docs/plugins/" data-width="30" data-layout="button" data-action="like" data-size="small" data-share="false"></div>

        <div class="fb-share-button"
             data-href="{{$page->url}}"
             data-layout="button_count"
             data-size="large">
        </div>

    </div>
</div>

<div id="fb-root"></div>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


 