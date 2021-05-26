<?php

namespace Theme\Main\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Blog\Models\Post;
use Platform\Blog\Repositories\Interfaces\PostInterface;
use Platform\Contact\Models\Contact;
use Platform\Ecommerce\Models\Product;
use Platform\Ecommerce\Models\ProductCategory;
use Platform\Ecommerce\Repositories\Interfaces\ProductInterface;
use Platform\Page\Repositories\Interfaces\PageInterface;
use Platform\Slug\Repositories\Interfaces\SlugInterface;
use Platform\Theme\Http\Controllers\PublicController;
use Platform\Page\Models\Page;
use SlugHelper;
use Theme;
use Theme\Main\Http\Requests\ContactRequest;

class MainController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function index(PageInterface $pageRepository, SlugInterface $slugRepository, Request $request )
    {
        $slug = $slugRepository->getFirstBy(['key' => 'trang-chu', 'reference_type' => Page::class]);
        $data['page'] = $pageRepository->getFirstBy(['id' => $slug->reference_id, 'status' => BaseStatusEnum::PUBLISHED]);
        $data[]= '';
        $data['productFeature'] = get_product_featured();

        $slugCategorySkincare = $slugRepository->getFirstBy(['key' => 'cham-soc-da', 'reference_type' => ProductCategory::class]);
        $categorySkincare = get_category_product_by_id($slugCategorySkincare->reference_id);
        $data['producSkincare'] = get_products_by_category($categorySkincare->id, 8, 8);

        $slugCategoryBody = $slugRepository->getFirstBy(['key' => 'cham-soc-co-the', 'reference_type' => ProductCategory::class]);
        $categoryBody = get_category_product_by_id($slugCategoryBody->reference_id);
        $data['producBody'] = get_products_by_category($categoryBody->id, 8, 8);

        $slugCategoryMakeup = $slugRepository->getFirstBy(['key' => 'trang-diem', 'reference_type' => ProductCategory::class]);
        $categoryMakeup = get_category_product_by_id($slugCategoryMakeup->reference_id);
        $data['producMakeup'] = get_products_by_category($categoryMakeup->id, 8, 8);

        $slugCategoryAccessories = $slugRepository->getFirstBy(['key' => 'phu-kien', 'reference_type' => ProductCategory::class]);
        $categoryAccessories = get_category_product_by_id($slugCategoryAccessories->reference_id);
        $data['producAccessories'] = get_products_by_category($categoryAccessories->id, 8, 8);

        //lấy ra 2 bài viết mới nhất thuộc tin tức
         $data['newPosts'] = get_popular_posts(2);

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
    public function getAbout(PageInterface $pageRepository, SlugInterface $slugRepository)
    {
        $slug = $slugRepository->getFirstBy(['key' => 'trang-chu', 'reference_type' => Page::class]);
        $data['page'] = $pageRepository->getFirstBy(['id' => $slug->reference_id, 'status' => BaseStatusEnum::PUBLISHED]);
        return Theme::scope('pages.about-us', $data)->render();
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

    public function contact(ContactRequest $request)
    {
       try {
            $input = $request->all();
            $saveContact = Contact::saveContact($input);
            if (!$saveContact) {
                return response()->json([ 'error'=> 'Gửi thông tin liên hệ thất bại.']);
            }
            return response()->json([ 'success'=> 'Cảm ơn bạn đã gửi thông tin liên hệ cho chúng tôi.']);
       } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
       }
    }
    //Get product:
    public function getProduct( Request $request)
    {

        $data['product']=Product::query()
        ->get();


        return Theme::scope('pages.product',$data)->render();
    }

    //Get product-detail:
    public function getProductDetail($slug,$slugProduct,
                                    SlugInterface $slugRepository,
                                    ProductInterface $productRepository)
    {
        //get Slug category
        $slugCategory = $slugRepository->getFirstBy(['key' => $slug, 'reference_type' => ProductCategory::class]);
        $slugProduct = $slugRepository->getFirstBy(['key' => $slugProduct, 'reference_type' => Product::class]);
        $data['product'] = $productRepository->getFirstBy(['id' => $slugProduct->reference_id]);
        return Theme::scope('pages.product-detail', $data)->render();
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
