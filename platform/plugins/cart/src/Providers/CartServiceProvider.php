<?php

namespace Platform\Cart\Providers;

use Platform\Cart\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Platform\Cart\Repositories\Caches\CartCacheDecorator;
use Platform\Cart\Repositories\Eloquent\CartRepository;
use Platform\Cart\Repositories\Interfaces\CartInterface;
use Platform\Base\Supports\Helper;
use Event;
use Platform\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class CartServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(CartInterface::class, function () {
            return new CartCacheDecorator(new CartRepository(new Cart));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/cart')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Cart::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-cart',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'Giỏ hàng',
                'icon'        => 'fas fa-cart-plus',
                'url'         => route('cart.index'),
                'permissions' => ['cart.index'],
            ]);
        });
    }
}
