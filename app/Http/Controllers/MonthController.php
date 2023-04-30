<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MonthRepository;
use App\Http\Requests\MonthPostRequest;
use App\Http\Services\MonthService;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    /**
     * @var MonthRepository
     */
    protected $monthRepository;

     /**
     * @var MonthService
     */
    protected $monthService;

    /**
     * @param MonthRepository
     * @param MonthService
     */
    public function __construct(MonthRepository $monthRepository, MonthService $monthService)
    {
        $this->monthRepository = $monthRepository;
        $this->monthService = $monthService;
    }

    /**
     *
     */
    public function index()
    {
        $months = $this->monthService->sortByMultipleColumns();
        return view('months.index', compact('months'));
    }

    /**
     *
     */
    public function create()
    {
        return view('months.create');
    }

    /**
     * @param MonthPostRequest $request
     */
    public function store(MonthPostRequest $request)
    {
        $this->monthService->store($request->validated());

        return redirect()
            ->route('months.index')
            ->with('message', '年月を登録しました');
    }

    /**
     * @param int $id
     */
    public function edit(int $id)
    {
        $month = $this->monthRepository->findById($id);
        return view('months.edit', compact('month'));
    }

    /**
     * @param MonthPostRequest $request
     * @param int $id
     */
    public function update(MonthPostRequest $request, int $id)
    {
        $this->monthService->update($request->validated(), $id);

        return redirect()
            ->route('months.index')
            ->with('message', '年月を更新しました');
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        $this->monthService->destroy($id);

        return redirect()
            ->route('months.index')
            ->with('alert', '項目を削除しました');
    }
}
