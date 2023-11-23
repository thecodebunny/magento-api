<?php

namespace Thecodebunny\MagentoApi\Requests;

use Illuminate\Support\LazyCollection;
use Thecodebunny\MagentoApi\Client\Magento;
use Thecodebunny\MagentoApi\Concerns\LazilyRetrievesPages;
use Thecodebunny\MagentoApi\Query\SearchCriteria;

/** @deprecated  */
class Orders
{
    use LazilyRetrievesPages;

    public function __construct(protected Magento $magento)
    {
    }

    /** @return LazyCollection<int, array> */
    public function lazy(SearchCriteria $searchCriteria = null, int $pageSize = 100): LazyCollection
    {
        return $this->retrieveLazily('orders', $pageSize, $searchCriteria);
    }

    public function loadByIncrementId(string $incrementId): ?array
    {
        $searchCriteria = SearchCriteria::make()
            ->where('increment_id', $incrementId)
            ->get();

        $orders = $this->magento->get('orders', $searchCriteria)
            ->json('items');

        if (count($orders) !== 1) {
            return null;
        }

        return $orders[0];
    }
}
