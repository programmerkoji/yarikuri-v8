<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemMonthService;
use App\Http\Services\ItemService;
use App\Http\Services\MonthService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * @var MonthService
     */
    protected $monthService;

    /**
     * @var ItemMonthService
     */
    protected $itemMonthService;

    /**
     * @param ItemService
     * @param MonthService
     * @param ItemMonthService
     */
    public function __construct(ItemService $itemService, MonthService $monthService, ItemMonthService $itemMonthService)
    {
        $this->itemService = $itemService;
        $this->monthService = $monthService;
        $this->itemMonthService = $itemMonthService;
    }

    /**
     * @return void
     */
    public function index()
    {
        $items = $this->itemService->index();
        $months = $this->monthService->sortByMultipleColumns();

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
