<?php

namespace Platform\CartDetail\Providers;

use Platform\CartDetail\Models\CartDetail;
use Illuminate\Support\ServiceProvider;
use Platform\CartDetail\Repositories\Caches\CartDetailCacheDecorator;
use Platform\CartDetail\Repositories\Eloquent\CartDetailRepository;
use Platform\CartDetail\Repositories\Interfaces\CartDetailInterface;
use Platform\Base\Supports\Helper;
use Event;
use Platform\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class CartDetailServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(CartDetailInterface::class, function () {
            return new CartDetailCacheDecorator(new CartDetailRepository(new CartDetail));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/cart-detail')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([CartDetail::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-cart-detail',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'Chi tiết giỏ hàng',
                'icon'        => 'fas fa-luggage-cart',
                'url'         => route('cart-detail.index'),
                'permissions' => ['cart-detail.index'],
            ]);
        });
    }
}
