<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemMonthService;
use App\Repositories\ItemRepositoryInterface;
use App\Repositories\MonthRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * @param ItemRepositoryInterface
     * @param MonthRepositoryInterface
     * @param ItemMonthService
     */
    public function __construct(ItemRepositoryInterface $itemRepository, MonthRepositoryInterface $monthRepository, ItemMonthService $itemMonthService)
    {
        $this->itemRepository = $itemRepository;
        $this->monthRepository = $monthRepository;
        $this->itemMonthService = $itemMonthService;
    }

    public function getUserId()
    {
        return auth()->id();
    }

    /**
     * @return void
     */
    public function index()
    {
        $items = $this->itemRepository->getOwnedByUser($this->getUserId())->get();
        $months = $this->monthRepository->getOwnedByUser($this->getUserId())->paginate(config('const.pagination'));

        return view('dashboard', compact('items', 'months'));
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->itemMonthService->store($request);

        return redirect()
            ->route("dashboard");
    }
}
