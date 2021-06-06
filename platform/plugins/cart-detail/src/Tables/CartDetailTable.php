<?php

namespace Platform\CartDetail\Tables;

use Auth;
use BaseHelper;
use Platform\Base\Enums\BaseStatusEnum;
use Platform\CartDetail\Repositories\Interfaces\CartDetailInterface;
use Platform\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Platform\CartDetail\Models\CartDetail;
use Html;

class CartDetailTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * CartDetailTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param CartDetailInterface $cartDetailRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, CartDetailInterface $cartDetailRepository)
    {
        $this->repository = $cartDetailRepository;
        $this->setOption('id', 'plugins-cart-detail-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['cart-detail.edit', 'cart-detail.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            // ->editColumn('name', function ($item) {
            //     if (!Auth::user()->hasPermission('cart-detail.edit')) {
            //         return $item->name;
            //     }
            //     return Html::link(route('cart-detail.edit', $item->id), $item->name);
            // })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('product_id', function ($item) {
                return $item->getProduct->name;
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('cart-detail.edit', 'cart-detail.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $select = [
            'cart_details.id',
            'cart_details.cart_id',
            'cart_details.quantity',
            'cart_details.product_id',
            'cart_details.created_at',
            'cart_details.status',
        ];

        $query = $model->select($select);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, $select));
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'name'  => 'cart_details.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'cart_id' => [
                'name'  => 'cart_details.cart_id',
                'title' => 'Giỏ Hàng',
                'class' => 'text-left',
            ],
            'product_id' => [
                'name' => 'cart_details.product_id',
                'title' => 'Sản Phẩm',
                'class' => 'text-left',
            ],
            'quantity' => [
                'name' => 'cart_details.quantity',
                'title' => 'Số Lượng',
                'class' => 'text-left'
            ],
            'created_at' => [
                'name'  => 'cart_details.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'cart_details.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('cart-detail.create'), 'cart-detail.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CartDetail::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('cart-detail.deletes'), 'cart-detail.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'cart_details.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'cart_details.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'cart_details.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
