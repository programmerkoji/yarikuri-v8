<?php

namespace App\Http\Services;

use App\Repositories\ItemMonthRepositoryInterface;
use Illuminate\Http\Request;

class ItemMonthService
{
    /**
     * @var ItemMonthRepositoryInterface
     */
    protected $itemMonthRepository;

    /**
     * @param ItemMonthRepositoryInterface $itemMonthRepository
     */
    public function __construct(ItemMonthRepositoryInterface $itemMonthRepository)
    {
        $this->itemMonthRepository = $itemMonthRepository;
    }

    public function store(Request $request)
    {
        $itemId = $request->item_id;
        $monthId = $request->month_id;
        $matchItem = $this->itemMonthRepository->getItemMonth($itemId, $monthId);
        $itemMonthId = $matchItem->id ?? '';

        $item_month_data = [
            'item_id' => $request->item_id,
            'month_id' => $request->month_id,
            'is_checked' => $request->has('is_checked') ? 1 : 0
        ];

        $this->itemMonthRepository->createOrUpdateItemMonth($itemMonthId, $item_month_data);
    }
}
