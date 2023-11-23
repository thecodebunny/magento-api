<?php

namespace Thecodebunny\MagentoApi\Requests;

use Illuminate\Support\LazyCollection;
use Thecodebunny\MagentoApi\Client\Magento;
use Thecodebunny\MagentoApi\Concerns\LazilyRetrievesPages;
use Thecodebunny\MagentoApi\Query\SearchCriteria;

/** @deprecated  */
class Products
{
    use LazilyRetrievesPages;

    public function __construct(protected Magento $magento)
    {
    }

    public function retrieve(int $page, int $pageSize = 100): array
    {
        $searchCriteria = SearchCriteria::make()
            ->paginate($page, $pageSize)
            ->get();

        return $this->magento
            ->get('products', $searchCriteria)
            ->throw()
            ->json();
    }

    /** @return LazyCollection<int, array> */
    public function lazy(SearchCriteria $searchCriteria = null, int $pageSize = 100): LazyCollection
    {
        return $this->retrieveLazily('products', $pageSize, $searchCriteria);
    }
}
