<!-- PAGE CONTENT START -->
<div class="section background-white">
    <div class="line">
        <div class="margin">

            <!-- left side start -->
            <div class="s-12 m-12 l-9 padding-l-right-30">

                <!-- post -->
                <div class="fullwidth" id="blog-post">

                    <!-- title & image -->
                    <div class="line">
                        <div class="fullwidth">
                            <h1 class="margin-bottom-30">{{ $contentPost->name }}</h1>
                            <img src="{{ RvMedia::getImageUrl($contentPost->image, 'midle', false, RvMedia::getDefaultImage()) }}" alt="" class="fullwidth">
                        </div>
                    </div>

                    <!-- post text -->
                    <div class="line">
                        <div class="fullwidth border-bottom">
                            <div class="post">
                                <p>
                                    {{ $contentPost->description }}
                                </p>
                                {!! $contentPost->content !!}
                            </div>
                        </div>
                    </div>

                </div>



                <!-- comments heading -->
                <div class="section-padding-top">
                    <div class="line">
                        <div class="fullwidth margin-bottom-10">
                            <h3>Bình luận ( 5 )</h3>
                            <hr class="break-small">
                        </div>
                    </div>
                </div>

                <!-- comments list start -->
                <div class="line">
                    <div class="fullwidth comment-box">
                        <div class="margin">
                            <div class="s-12 m-2 l-2">
                                <img src="img/user.jpg" class="user-photo" alt="">
                            </div>
                            <div class="s-12 m-10 l-10">
                                <b class="text-primary">Waseem Ahmed</b>
                                <span class="comment-time">Wed, Jan, 11 ,2017</span>
                                <p class="heading">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius lacus justo,
                                    sit amet congue lectus mattis sed. Vestibulum finibus diam nec nibh hendrerit
                                    scelerisque. In mi massa, fermentum in fringilla condimentum, porta sed purus.
                                </p>
                                <a class="comment-reply text-primary-hover" href="#">Reply</a> &nbsp;&nbsp; <a
                                    class="remove-item text-primary-hover" href="#">Remove</a> &nbsp;&nbsp; <a
                                    class="edit-item text-primary-hover" href="#">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="fullwidth comment-box">
                        <div class="margin">
                            <div class="s-12 m-2 l-2">
                                <img src="img/user.jpg" class="user-photo" alt="">
                            </div>
                            <div class="s-12 m-10 l-10">
                                <div class="fullwidth">
                                    <b class="text-primary">Waseem Ahmed</b>
                                    <span class="comment-time">Wed, Jan, 11 ,2017</span>
                                    <p class="heading">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius lacus
                                        justo, sit amet congue lectus mattis sed. Vestibulum finibus diam nec nibh
                                        hendrerit scelerisque. In mi massa, fermentum in fringilla condimentum, porta
                                        sed purus.
                                    </p>
                                    <a class="comment-reply text-primary-hover" href="#">Reply</a> &nbsp;&nbsp; <a
                                        class="remove-item text-primary-hover" href="#">Remove</a> &nbsp;&nbsp; <a
                                        class="edit-item text-primary-hover" href="#">Edit</a>
                                </div>
                                <div class="fullwidth comment-reply-box">
                                    <div class="margin">
                                        <div class="s-12 m-2 l-2">
                                            <img src="img/user.jpg" class="user-photo" alt="">
                                        </div>
                                        <div class="s-12 m-10 l-10">
                                            <b class="text-primary">Waseem Ahmed</b>
                                            <span class="comment-time">Wed, Jan, 11 ,2017</span>
                                            <p class="heading">
                                                Lorem ipsum dolor sit amet adipiscing elit. Fusce varius lacus justo,
                                                sit amet congue lectus mattis sed. Vestibulum finibus diam nec nibh
                                                hendrerit scelerisque.
                                            </p>
                                            <a class="comment-reply text-primary-hover" href="#">Reply</a> &nbsp;&nbsp;
                                            <a class="remove-item text-primary-hover" href="#">Remove</a> &nbsp;&nbsp;
                                            <a class="edit-item text-primary-hover" href="#">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fullwidth comment-reply-box">
                                    <div class="margin">
                                        <div class="s-12 m-2 l-2">
                                            <img src="img/user.jpg" class="user-photo" alt="">
                                        </div>
                                        <div class="s-12 m-10 l-10">
                                            <b class="text-primary">Waseem Ahmed</b>
                                            <span class="comment-time">Wed, Jan, 11 ,2017</span>
                                            <p class="heading">
                                                Lorem ipsum dolor sit amet elit. Fusce varius lacus justo, sit amet
                                                congue lectus mattis sed.
                                            </p>
                                            <a class="comment-reply text-primary-hover" href="#">Reply</a> &nbsp;&nbsp;
                                            <a class="remove-item text-primary-hover" href="#">Remove</a> &nbsp;&nbsp;
                                            <a class="edit-item text-primary-hover" href="#">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fullwidth border-bottom comment-box">
                        <div class="margin">
                            <div class="s-12 m-2 l-2">
                                <img src="img/user.jpg" class="user-photo" alt="">
                            </div>
                            <div class="s-12 m-10 l-10">
                                <b class="text-primary">Waseem Ahmed</b>
                                <span class="comment-time">Wed, Jan, 11 ,2017</span>
                                <p class="heading">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius lacus justo,
                                    sit amet congue lectus mattis sed. Vestibulum finibus diam nec nibh hendrerit
                                    scelerisque. In mi massa, fermentum in fringilla condimentum, porta sed purus.
                                </p>
                                <a class="comment-reply text-primary-hover" href="#">Reply</a> &nbsp;&nbsp; <a
                                    class="remove-item text-primary-hover" href="#">Remove</a> &nbsp;&nbsp; <a
                                    class="edit-item text-primary-hover" href="#">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Comment -->
                <div class="section-padding-top ">
                    <div class="line">
                        <h3>Post Comment</h3>
                        <hr class="break-small">
                        <div class="fullwidth">
                            <form class="customform">
                                <div class="margin">
                                    <div class="s-12 m-6 l-6">
                                        <input type="text" name="fullname" placeholder="Full name">
                                    </div>
                                    <div class="s-12 m-6 l-6">
                                        <input type="text" name="email" placeholder="Email address">
                                    </div>
                                </div>
                                <div class="fullwidth">
                                    <textarea placeholder="Comment..." rows="3"></textarea>
                                </div>
                                <div class="s-12 m-6 l-12">
                                    <input type="submit" value="Post Comment">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- left side end -->

            <!-- right side start -->
            <div class="s-12 m-12 l-3">

                <!-- blog search -->
                <div class="hide-s hide-m">
                    <div class="fullwidth margin-bottom-20">
                        <form action="{{ route('blog.search') }}" class="blog-search">
                            <div class="s-9 m-9 l-9">
                                <input name="q" type="search" class="blog-search" placeholder="Tìm kiếm bài viết">
                            </div>
                            <div class="s-3 m-3 l-3">
                                <input type="submit" value="Tìm kiếm">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- recent posts start -->
                <div class="fullwidth margin-m-bottom-60" id="recent-posts">
                    <h4>Tin tức khác</h4>
                    @foreach (get_related_by_category($contentPost->id, get_category_post_by_id(get_category_by_post_id($contentPost->id)->category_id)->id, 6) as $relatePost)
                        <!-- post 1 -->
                        <div class="s-12 m-4 l-12 post">
                            <div class="s-3 m-3 l-3 thumb">
                                <img src="{{ RvMedia::getImageUrl($relatePost->image, 'post-recent', false, RvMedia::getDefaultImage()) }}" alt="" class="fullwidth">
                            </div>
                            <div class="s-9 m-9 l-9 title">
                                <a href="">{{ $relatePost->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- categories -->
                <div class="fullwidth margin-m-bottom-60" id="blog-categories">

                    <h4>Danh mục</h4>
                    @foreach (get_all_categories() as $category)
                    <div class="s-12 m-4 l-12 cat">
                        <a href="{{ route('blog.category', $category->slug)}}">{{ $category->name }} ({{ count(get_posts_by_category($category->id, 4)) }} bài viết)</a>
                    </div>
                    @endforeach
                </div>

                <!-- tags -->
                <div class="fullwidth margin-m-bottom-60" id="recent-tags">

                    <h4 class="margin-bottom-30">Recent Tags</h4>

                    <a href="" class="tag">Beauty</a>
                    <a href="" class="tag">Beauty Care</a>
                    <a href="" class="tag">Natural Beauty Care</a>
                    <a href="" class="tag">Lips</a>
                    <a href="" class="tag">Hair</a>
                    <a href="" class="tag">Hair Care</a>

                </div>

            </div>
            <!-- right side end -->

        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->
