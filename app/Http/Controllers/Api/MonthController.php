<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MonthPostRequest;
use App\Repositories\MonthRepositoryInterface;

class MonthController extends Controller
{
    /**
     * @var MonthRepositoryInterface
     */
    protected $monthRepository;

    /**
     * @param MonthRepositoryInterface
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
        $months = $this->monthRepository->getOwnedByUser($this->getUserId())->orderBy('created_at', 'desc')->paginate(config('const.pagination'));
        return response()->json([
            'months' => $months,
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(int $monthId)
    {
        $month = $this->monthRepository->findById($monthId);
        $this->authorize('view', $month);
        return response()->json([
            'month' => $month,
        ], 201);
    }

    /**
     * @param MonthPostRequest $request
     */
    public function store(MonthPostRequest $request)
    {
        try {
            $request->merge(['user_id' => $this->getUserId()]);
            $this->monthRepository->store($request->validated());
            return response()->json([
                'message' => '年月を登録しました'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'バリデーションに失敗しました',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }

    /**
     * @param MonthPostRequest $request
     * @param int $monthId
     */
    public function update(MonthPostRequest $request, int $monthId)
    {
        try {
            $month = $this->monthRepository->findById($monthId);
            $this->authorize('update', $month);
            $this->monthRepository->update($request->validated(), $monthId);
            return response()->json([
                'message' => '年月を更新しました'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'バリデーションに失敗しました',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }

    /**
     * @param int $monthId
     * @return void
     */
    public function destroy(int $monthId)
    {
        try {
            $month = $this->monthRepository->findById($monthId);
            $this->authorize('delete', $month);
            $this->monthRepository->destroy($monthId);
            return response()->json([
                'message' => '年月を削除しました'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }
}
