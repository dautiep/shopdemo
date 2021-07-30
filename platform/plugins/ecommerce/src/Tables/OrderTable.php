<?php

namespace Platform\Ecommerce\Tables;

use BaseHelper;
use Platform\Ecommerce\Enums\OrderStatusEnum;
use Platform\Ecommerce\Models\Order;
use Platform\Ecommerce\Repositories\Interfaces\OrderInterface;
use Platform\Table\Abstracts\TableAbstract;
use EcommerceHelper;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderTable extends TableAbstract
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
     * OrderTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param OrderInterface $orderRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, OrderInterface $orderRepository)
    {
        $this->repository = $orderRepository;
        $this->setOption('id', 'table-orders');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasPermission('orders.edit')) {
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
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('status', function ($item) {
                return $item->status;
            })
            ->editColumn('type_payment', function ($item) {
                if ($item->type_payment == 1) {
                    return 'Thanh toán online';
                } else {
                    return 'Thanh toán sau';
                }
            })
            ->editColumn('is_purchased', function ($item) {
                if (!empty($item->is_purchased)) {
                    return $item->is_purchased;
                }
            })

            ->editColumn('amount', function ($item) {
                return format_price($item->sub_total, $item->currency_id);
            })

            // ->editColumn('shipping_amount', function ($item) {
            //     return format_price($item->shipping_amount, $item->currency_id);
            // })
            ->editColumn('user_id', function ($item) {
                return $item->user->name ?? $item->address->name;
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('purchased_at', function ($item) {
                return BaseHelper::formatDate($item->purchased_at);
            });

        if (EcommerceHelper::isTaxEnabled()) {
            $data = $data->editColumn('tax_amount', function ($item) {
                return format_price($item->tax_amount, $item->currency_id);
            });
        }
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('orders.edit', 'orders.destroy', $item);
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
            'ec_orders.id',
            'ec_orders.status',
            'ec_orders.user_id',
            'ec_orders.created_at',
            'ec_orders.amount',
            'ec_orders.tax_amount',
            'ec_orders.sub_total',
            'ec_orders.currency_id',
            'ec_orders.shipping_amount',
            'ec_orders.payment_id',
            'ec_orders.purchased_at',
            'ec_orders.type_payment',
            'ec_orders.is_purchased',
        ];

        $query = $model
            ->select($select)
            ->with(['user', 'payment'])
            ->where('ec_orders.is_finished', 1);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, $select));
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        $columns = [
            'id'              => [
                'name'  => 'ec_orders.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
                'class' => 'text-left',
            ],
            'user_id'         => [
                'name'  => 'ec_orders.user_id',
                'title' => trans('Tên Khách Hàng'),
                'class' => 'text-left',
            ],
            'amount'          => [
                'name'  => 'ec_orders.sub_total',
                'title' => trans('Tổng Tiền'),
                'class' => 'text-center',
            ],
        ];

        $columns += [
            'type_payment'  => [
                'name'  => 'ec_orders.type_payment',
                'title' => 'Hình thức thanh toán',
                'class' => 'text-center',
            ],
            'is_purchased'  => [
                'name'  => 'ec_orders.is_purchased',
                'title' => 'Trạng thái thanh toán',
                'class' => 'text-center',
            ],

            'status'          => [
                'name'  => 'ec_orders.status',
                'title' => 'Trạng thái đơn hàng',
                'width' => '200px',
                'class' => 'text-center',
            ],
            'created_at'      => [
                'name'  => 'ec_orders.created_at',
                'title' => 'Ngày tạo',
                'width' => '150px',
                'class' => 'text-center',
            ],
            'purchased_at'      => [
                'name'  => 'ec_orders.purchased_at',
                'title' => 'Ngày thanh toán',
                'width' => '150px',
                'class' => 'text-left',
'type' => 'date_time'
            ],
        ];

        return $columns;
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('orders.create'), 'orders.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Order::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('orders.deletes'), 'orders.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'ec_orders.status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => OrderStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', OrderStatusEnum::values()),
            ],
            'ec_orders.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function renderTable($data = [], $mergeData = [])
    {
        if ($this->query()->count() === 0 &&
            !$this->request()->wantsJson() &&
            $this->request()->input('filter_table_id') !== $this->getOption('id')
        ) {
            return view('plugins/ecommerce::orders.intro');
        }

        return parent::renderTable($data, $mergeData);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
