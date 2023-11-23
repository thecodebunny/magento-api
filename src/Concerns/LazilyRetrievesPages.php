<?php

namespace Thecodebunny\MagentoApi\Concerns;

use Illuminate\Support\LazyCollection;
use Thecodebunny\MagentoApi\Client\Magento;
use Thecodebunny\MagentoApi\Query\SearchCriteria;

/**
 * @property Magento $magento
 *
 * @deprecated
 */
trait LazilyRetrievesPages
{
    /** @return LazyCollection<int, array> */
    public function retrieveLazily(string $endpoint, int $pageSize, SearchCriteria $searchCriteria = null): LazyCollection
    {
        /** @phpstan-ignore-next-line */
        return LazyCollection::make(function () use ($endpoint, $pageSize, $searchCriteria) {
            $currentPage = 1;

            $search = ($searchCriteria ?? SearchCriteria::make());

            $hasNextPage = true;

            while ($hasNextPage) {
                $response = $this->magento
                    ->get($endpoint, $search->paginate($currentPage, $pageSize)->get())
                    ->throw();

                $items = $response->json('items', []);

                yield from $items;

                $hasNextPage = count($items) >= $pageSize;
                $currentPage++;
            }
        });
    }
}
