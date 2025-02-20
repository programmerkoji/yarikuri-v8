<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthPostRequest;
use App\Http\Services\MonthService;
use App\Repositories\MonthRepositoryInterface;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    /**
     * @var MonthRepositoryInterface
     */
    protected $monthRepository;

    /**
     * @param MonthRepositoryInterface
     * @param MonthService
     */
    public function __construct(MonthRepositoryInterface $monthRepository)
    {
        $this->monthRepository = $monthRepository;
    }

    /**
     * ログインユーザーの取得
     * @return int
     */
    public function getUserId()
    {
        return auth()->id();
    }

    /**
     *
     */
    public function index()
    {
        $months = $this->monthRepository->getOwnedByUser($this->getUserId())->sortByDesc('created_at');
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
        $request->merge(['user_id' => $this->getUserId()]);
        $this->monthRepository->store($request->validated());

        return redirect()
            ->route('months.index')
            ->with('message', '年月を登録しました');
    }

    /**
     * @param int $monthId
     */
    public function edit(int $monthId)
    {
        $month = $this->monthRepository->findById($monthId);
        return view('months.edit', compact('month'));
    }

    /**
     * @param MonthPostRequest $request
     * @param int $monthId
     */
    public function update(MonthPostRequest $request, int $monthId)
    {
        $this->monthRepository->update($request->validated(), $monthId);

        return redirect()
            ->route('months.index')
            ->with('message', '年月を更新しました');
    }

    /**
     * @param int $monthId
     * @return void
     */
    public function destroy(int $monthId)
    {
        $this->monthRepository->destroy($monthId);

        return redirect()
            ->route('months.index')
            ->with('alert', '項目を削除しました');
    }
}
