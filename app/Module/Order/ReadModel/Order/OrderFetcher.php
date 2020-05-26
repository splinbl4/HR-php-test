<?php

declare(strict_types=1);

namespace App\Module\Order\ReadModel\Order;

use App\Module\Order\Entity\Order;

/**
 * Class OrderService
 * @package App\Module\Order\Service
 */
class OrderFetcher
{
    public function all(Filter $filter,  string $sort, string $direction, int $limit = null)
    {
        $query = Order::query()
            ->with(['partner', 'products']);

        if ($filter->type) {
            $scope = $filter->type;
            $query->$scope();
        }

        $query->orderBy($sort, $direction === 'desc' ? 'desc' : 'asc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }
}
