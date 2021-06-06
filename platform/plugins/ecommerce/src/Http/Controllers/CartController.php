<?php
namespace Platform\Ecommerce\Http\Controllers;
use Platform\Base\Http\Controllers\BaseController;
use Theme;

class CartController extends BaseController
{
    public function index()
    {
        return Theme::scope('pages.cart')->render();
    }
}
