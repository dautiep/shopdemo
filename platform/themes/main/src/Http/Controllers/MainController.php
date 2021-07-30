<?php

namespace Theme\Main\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Blog\Models\Category;
use Platform\Blog\Models\Post;
use Platform\Blog\Models\Tag;
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
use SeoHelper;
use MetaBox;
use RvMedia;
use Theme;
use Theme\Main\Http\Requests\ContactRequest;

class MainController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function index(PageInterface $pageRepository, SlugInterface $slugRepository)
    {
        $slug = $slugRepository->getFirstBy(['key' => 'trang-chu', 'reference_type' => Page::class]);
        $data['page'] = $pageRepository->getFirstBy(['id' => $slug->reference_id, 'status' => BaseStatusEnum::PUBLISHED]);

        $meta = MetaBox::getMetaData($data['page'], 'seo_meta', true);
        //start SEO
        SeoHelper::setTitle(Str::upper($meta['seo_title'] ?: @$data['page']->name), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data[] = '';
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
        $meta = MetaBox::getMetaData($data['page'], 'seo_meta', true);
        //start SEO
        SeoHelper::setTitle(Str::upper('về chúng tôi'), theme_option('seo_title', ''), '|')
            ->setDescription($meta['seo_description'] ?: @$data['page']->description ?: theme_option('site_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        return Theme::scope('pages.about-us', $data)->render();
    }

    //Get Cart:
    public function getCart(BaseHttpResponse $response)
    {
        return Theme::scope('pages.cart')->render();
    }

    //Get Contact:
    public function getContact(BaseHttpResponse $response)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Liên Hệ'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        return Theme::scope('pages.contact-us')->render();
    }

    public function contact(ContactRequest $request)
    {
       try {
            $input = $request->all();
            $saveContact = Contact::saveContact($input);
            if (!$saveContact) {
                return response()->json([ 'error' => 'Gửi thông tin liên hệ thất bại.']);
            }
            return response()->json([ 'success' => 'Cảm ơn bạn đã gửi thông tin liên hệ cho chúng tôi.']);
       } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
       }
    }

    //Get product:
    public function getProduct( Request $request)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Sản Phẩm'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data['products'] = get_all_products(true, 9);
        $data['categories'] = get_product_categories();
        return Theme::scope('pages.product',$data)->render();
    }

    //Get product-detail:
    public function getProductDetail($slug,$slugProduct,
                                    SlugInterface $slugRepository,
                                    ProductInterface $productRepository)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Chi tiết sản phẩm'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        //get Slug category
        $slugCategory = $slugRepository->getFirstBy(['key' => $slug, 'reference_type' => ProductCategory::class]);
        $slugProduct = $slugRepository->getFirstBy(['key' => $slugProduct, 'reference_type' => Product::class]);
        $data['product'] = $productRepository->getFirstBy(['id' => $slugProduct->reference_id]);
        $categoryId = get_category_product_by_id(get_category_by_product_id($data['product']->id)->category_id)->id;
        $data['relatedProduct'] = get_related_products_with_current_product(4, $categoryId);
        return Theme::scope('pages.product-detail', $data)->render();
    }

    //Get Blog:
    public function getBlog()
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Tin tức'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO
        $data['posts'] = get_all_posts(true, 2);
        return Theme::scope('pages.blog', $data)->render();
    }

    /**
     * @return \Illuminate\Http\Response|Response
     */
    public function getBlogCategory($slug, SlugInterface $slugRepository)
    {
        $slug = $slugRepository->getFirstBy([
            'key' => $slug,
            'reference_type' => Category::class,
            'prefix' => SlugHelper::getPrefix(Category::class),
        ]);
        if (!$slug) {
            abort('404');
        }
        $data['category'] = get_category_by_id($slug->reference_id);

        //start SEO
        SeoHelper::setTitle(Str::upper($data['category']->name), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data['posts'] = get_posts_by_category($data['category']->id, 4);
        return Theme::scope('pages.blog', $data)->render();
    }

    public function getBlogTag($slug, SlugInterface $slugRepository)
    {
        $slug = $slugRepository->getFirstBy([
            'key' => $slug,
            'reference_type' => Tag::class,
            'prefix' => SlugHelper::getPrefix(Tag::class),
        ]);
        if (!$slug) {
            abort('404');
        }
        $data['tag'] = get_tag_by_id($slug->reference_id);

        //start SEO
        SeoHelper::setTitle(Str::upper($data['tag']->name), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO
        $data['posts'] = get_posts_by_tag($data['tag']->id);
        return Theme::scope('pages.blog', $data)->render();
    }

    /**
     * @return \Illuminate\Http\Response|Response
     */
    public function getProductCategory($slug, SlugInterface $slugRepository)
    {
        $slug = $slugRepository->getFirstBy([
            'key' => $slug,
            'reference_type' => ProductCategory::class,
            'prefix' => SlugHelper::getPrefix(ProductCategory::class),
        ]);
        if (!$slug) {
            abort('404');
        }
        $data['category'] = get_category_product_by_id($slug->reference_id);

        //start SEO
        SeoHelper::setTitle(Str::upper($data['category']->name), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data['products'] = get_products_by_category($data['category']->id, 9, 0);
        $data['categories'] = get_product_categories();
        return Theme::scope('pages.product',$data)->render();
    }

     /**
     * @return \Illuminate\Http\Response|Response
     */
    public function getBlogDetail($slug, $slugPost, PostInterface $postRepository, SlugInterface $slugRepository)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Chi tiết bài viết'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        if (!$slugPost) {
            abort('404');
        }
        $slugPost = $slugRepository->getFirstBy(['key' => $slugPost, 'reference_type' => Post::class]);
        $data['contentPost'] = $postRepository->getFirstBy(['id' => $slugPost->reference_id]);
        $data['tags'] = get_all_tags();
        return Theme::scope('pages.blog-post', $data)->render();
    }

    public function searchBlog(Request $request)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Tìm kiếm bài viết'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data['key'] = $request['q'];
        $starttime = microtime(true);
        $data['result'] = Post::search($data['key']);
        $endtime = microtime(true);
        $data['time'] = round($endtime - $starttime, 5);
        return Theme::scope('pages.search', $data)->render();
    }

    public function searchProduct(Request $request)
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Tìm kiếm Sản Phẩm'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        $data['key'] = $request['q'];
        $starttime = microtime(true);
        $data['result'] = Product::search($data['key']);
        $endtime = microtime(true);
        $data['time'] = round($endtime - $starttime, 5);
        $data['categories'] = get_product_categories();
        return Theme::scope('pages.product', $data)->render();
    }

    public function postContact(ContactRequest $request)
    {
        $input = $request->all();
        $saveContact = Contact::saveContact($input);
        if (!$saveContact) {
            $notification = array(
                'message' => 'Gửi thông tin thất bại',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'Cảm ơn bạn đã liên hệ với chúng tôi',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
