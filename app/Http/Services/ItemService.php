<?php

namespace App\Http\Services;

use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryInterface;

class ItemService
{
    /**
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function calculateTotalAmount(int $userId)
    {
        $prices = [];
        foreach ($this->itemRepository->getOwnedByUser($userId) as $value) {
            $prices[] = $value->price;
        }
        $calculateTotalAmounts = array_sum($prices);
        return $calculateTotalAmounts;
    }
}
