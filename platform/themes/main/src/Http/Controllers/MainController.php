<?php

namespace Theme\Main\Http\Controllers;

use Illuminate\Http\Request;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Ecommerce\Models\Product;
use Platform\Ecommerce\Models\ProductCategory;
use Platform\Page\Repositories\Interfaces\PageInterface;
use Platform\Slug\Repositories\Interfaces\SlugInterface;
use Platform\Theme\Http\Controllers\PublicController;
use Platform\Page\Models\Page;
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

        // dd( $data['category']=ProductCategory::query()
        // ->get());
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
    //Get Blog_Post:
    public function getBlogPost(BaseHttpResponse $response)
    {
        return Theme::scope('pages.blog-post')->render();
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
    public function getProduct(BaseHttpResponse $response)
    {
        return Theme::scope('pages.product')->render();
    }
    //Get product-detail:
    public function getProductDetail(BaseHttpResponse $response)
    {
        return Theme::scope('pages.product-detail')->render();
    }
}
