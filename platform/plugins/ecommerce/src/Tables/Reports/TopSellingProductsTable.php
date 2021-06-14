<?php

namespace Platform\Ecommerce\Tables\Reports;

use Platform\Ecommerce\Repositories\Interfaces\ProductInterface;
use Platform\Payment\Enums\PaymentStatusEnum;
use Platform\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Platform\Ecommerce\Enums\OrderStatusEnum;
use Yajra\DataTables\DataTables;

class TopSellingProductsTable extends TableAbstract
{

    /**
     * @var string
     */
    protected $type = self::TABLE_TYPE_SIMPLE;

    /**
     * @var string
     */
    protected $view = 'core/table::simple-table';

    /**
     * TopSellingProductsTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ProductInterface $productRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        ProductInterface $productRepository
    ) {
        parent::__construct($table, $urlGenerator);
        $this->repository = $productRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        return $this->table
            ->eloquent($this->query())
            ->editColumn('product_id', function ($item) {
                return $item->product_id;
            })
            ->editColumn('qty', function ($item) {
                return $item->total;
            })
            // ->editColumn('name', function ($item) {
            //     if (!$item->is_variation) {
            //         return Html::link($item->url, $item->name, ['target' => '_blank']);
            //     }

            //     $attributeText = '';
            //     $attributes = get_product_attributes($item->id);
            //     if (!empty($attributes)) {
            //         $attributeText .= ' (';
            //         foreach ($attributes as $index => $attribute) {
            //             $attributeText .= $attribute->attribute_set_title . ': ' . $attribute->title;
            //             if ($index < count($attributes) - 1) {
            //                 $attributeText .= ', ';
            //             }
            //         }
            //         $attributeText .= ')';
            //     }

            //     return Html::link($item->original_product->url, $item->original_product->name, ['target' => '_blank'])->toHtml() . Html::tag('small', $attributeText);
            // })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        $query = $this->repository
            ->getModel()
            ->join('ec_order_product', 'ec_products.id', '=', 'ec_order_product.product_id')
            ->join('ec_orders', 'ec_orders.id', '=', 'ec_order_product.order_id')
            ->where('ec_orders.status', OrderStatusEnum::COMPLETED)
            ->whereDate('ec_orders.created_at', '>=', now()->startOfMonth()->toDateString())
            ->whereDate('ec_orders.created_at', '<=', now()->endOfMonth()->toDateString())
            ->select([
                'ec_order_product.product_id',
                'ec_order_product.product_name',
                \DB::raw("SUM(ec_order_product.qty) as total"),
            ])
            ->groupBy(['ec_order_product.product_id', 'ec_order_product.product_name']);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'product_id'   => [
                'name'      => 'ec_order_product.product_id',
                'title'     => 'Mã sản phẩm',
                'width'     => '80px',
                'orderable' => false,
                'class'     => 'no-sort text-center',
            ],

            'product_name'          => [
                'name'      => 'ec_order_product.product_name',
                'title'     => 'Tên sản phẩm',
                'orderable' => false,
                'class'     => 'text-left',
                'width'     => '250px',
            ],

            'qty' => [
                'name'      => 'ec_order_product.qty',
                'title'     => 'Số lượng',
                'orderable' => false,
                'class'     => 'text-center',
                'width'     => '80px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function renderTable($data = [], $mergeData = [])
    {
        if ($this->query()->count() == 0) {
            return view('core/dashboard::partials.no-data')->render();
        }
        return parent::renderTable($data, $mergeData);
    }
}
