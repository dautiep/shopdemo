<?php

namespace Platform\Ecommerce\Repositories\Eloquent;

use Platform\Ecommerce\Repositories\Interfaces\OrderInterface;
use Platform\Payment\Enums\PaymentStatusEnum;
use Platform\Support\Repositories\Eloquent\RepositoriesAbstract;
use DB;

class OrderRepository extends RepositoriesAbstract implements OrderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRevenueData($startDate, $endDate, $select = [])
    {
        if (empty($select)) {
            $select = [
                // DB::raw('DATE(payments.created_at) AS date'),
                DB::raw('DATE(ec_orders.created_at) AS date'),
                DB::raw('SUM(ec_orders.sub_total) as revenue'),
            ];
        }
        $data = $this->model
            ->whereDate('ec_orders.created_at', '>=', $startDate)
            ->whereDate('ec_orders.created_at', '<=', $endDate)
            ->where('ec_orders.is_finished', 1)
            // ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
            // ->whereDate('payments.created_at', '>=', $startDate)
            // ->whereDate('payments.created_at', '<=', $endDate)
            // ->where('payments.status', PaymentStatusEnum::COMPLETED)
            ->groupBy('date')
            ->select($select);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function countRevenueByDateRange($startDate, $endDate)
    {
        $data = $this->model
            // ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
            // ->where('payments.created_at', '>=', $startDate)
            // ->where('payments.created_at', '<=', $endDate)
            // ->where('payments.status', PaymentStatusEnum::COMPLETED);
            ->where('ec_orders.created_at', '>=', $startDate)
            ->where('ec_orders.created_at', '<=', $endDate)
            ->where('ec_orders.is_finished', 1);

        return $this
            ->applyBeforeExecuteQuery($data)
            ->sum(DB::raw('ec_orders.sub_total'));
    }
}
