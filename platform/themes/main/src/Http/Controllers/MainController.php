<?php

namespace Theme\Main\Http\Controllers;

use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Theme\Http\Controllers\PublicController;
use Theme;

class MainController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function index(BaseHttpResponse $response)
    {
        return Theme::scope('index')->render();
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
