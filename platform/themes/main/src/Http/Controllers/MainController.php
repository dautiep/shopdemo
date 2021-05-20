<?php

namespace Theme\Main\Http\Controllers;

use Illuminate\Http\Request;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Blog\Models\Post;
use Platform\Blog\Repositories\Interfaces\PostInterface;
use Platform\Ecommerce\Models\Product;
use Platform\Ecommerce\Models\ProductCategory;
use Platform\Page\Repositories\Interfaces\PageInterface;
use Platform\Slug\Repositories\Interfaces\SlugInterface;
use Platform\Theme\Http\Controllers\PublicController;
use Platform\Page\Models\Page;
use SlugHelper;
use Theme;
class MainController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function index(PageInterface $pageRepository, SlugInterface $slugRepository, Request $request )
    {
        $slug = $slugRepository->getFirstBy(['key' => 'trang-chu', 'reference_type' => Page::class]);
        $data['page'] = $pageRepository->getFirstBy(['id' => $slug->reference_id, 'status' => BaseStatusEnum::PUBLISHED]);
        $data[]='';
        $data['product']=Product::query()
        ->orWhere('is_featured','>',0)
        ->get();
        
        //lấy ra 2 bài viết mới nhất thuộc tin tức
         $data['newPosts'] = get_posts_by_category(5); 
   
        return Theme::scope('index',$data)->render();
    }

    // /**
    //  * {@inheritDoc}
    //  */
    // public function getView(BaseHttpResponse $response, $key = null)
    // {
    //     return parent::getView($response, $key);
    // }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }
    /**
     * {@inheritDoc}
     */
    //Get About:
    public function getAbout(BaseHttpResponse $response)
    {
        return Theme::scope('pages.about-us')->render();
    }
    //Get Blog:
    public function getBlog(BaseHttpResponse $response)
    {
        return Theme::scope('pages.blog')->render();
    }

    //Get Cart:
    public function getCart(BaseHttpResponse $response)
    {
        return Theme::scope('pages.cart')->render();
    }
    //Get Contact:
    public function getContact(BaseHttpResponse $response)
    {
        
        return Theme::scope('pages.contact-us')->render();
    }
    //Get product:
    public function getProduct( Request $request)
    {
       
        $data['product']=Product::query()
        ->get();
    
       
        return Theme::scope('pages.product',$data)->render();
    }
    //Get product-detail:
    public function getProductDetail($slug,$slugPost, ProductInterface $productRepository, SlugInterface $slugRepository)
    {
        
     
        return Theme::scope('pages.product-detail')->render();
    }
     /**
     * @return \Illuminate\Http\Response|Response
     */
    public function getBlogDetail($slug, $slugPost, PostInterface $postRepository, SlugInterface $slugRepository)
    {
        if (!$slugPost) { 
            abort('404');
        }
        $slugPost = $slugRepository->getFirstBy(['key' => $slugPost, 'reference_type' => Post::class]);
        $data['contentPost'] = $postRepository->getFirstBy(['id' => $slugPost->reference_id]);
        return Theme::scope('pages.blog-post', $data)->render();
    }
}
