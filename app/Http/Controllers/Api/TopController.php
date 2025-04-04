<?php

namespace App\Http\Controllers\Api;

use App\Helpers\PaginationHelper;
use App\Http\Services\ItemMonthService;
use App\Http\Services\ItemService;
use App\Repositories\ItemMonthRepositoryInterface;
use App\Repositories\ItemRepositoryInterface;
use App\Repositories\MonthRepositoryInterface;
use Illuminate\Http\Request;

class TopController extends Controller
{
    /**
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * @var MonthRepositoryInterface
     */
    protected $monthRepository;

    /**
     * @var ItemMonthService
     */
    protected $itemMonthService;

    /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * @var ItemMonthRepositoryInterface
     */
    protected $itemMonthRepository;

    /**
     * @param ItemRepositoryInterface
     * @param MonthRepositoryInterface
     * @param ItemMonthService
     * @param ItemService
     * @param ItemMonthRepositoryInterface
     */
    public function __construct(
        ItemRepositoryInterface $itemRepository,
        MonthRepositoryInterface $monthRepository,
        ItemMonthService $itemMonthService,
        ItemService $itemService,
        ItemMonthRepositoryInterface $itemMonthRepository
    )
    {
        $this->itemRepository = $itemRepository;
        $this->monthRepository = $monthRepository;
        $this->itemMonthService = $itemMonthService;
        $this->itemService = $itemService;
        $this->itemMonthRepository = $itemMonthRepository;
    }

    public function getUserId()
    {
        return auth()->id();
    }

    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function topMonths()
    {
        $months = $this->monthRepository->getOwnedByUser($this->getUserId())
            ->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(config('const.top_pagination'));
        $customLinks = PaginationHelper::generatePaginationLinks($months);

        return response()->json([
            'months' => array_merge($months->toArray(), ['custom_links' => $customLinks]),
        ], 200);
    }

    /**
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function topItems(int $month_id)
    {
        $items = $this->itemService->getTopItems($this->getUserId(), $month_id)->get();
        $calculateTotalAmounts = $this->itemService->calculateTotalAmount($this->getUserId());
        return response()->json([
            'items' => $items,
            'calculateTotalAmounts' => $calculateTotalAmounts,
        ], 200);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $this->itemMonthRepository->createOrUpdateItemMonthApi($request->all());

            return response()->json([
                'message' => 'チェックを更新しました'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }
}
