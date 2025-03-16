<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ItemRepositoryInterface;
use App\Http\Requests\ItemPostRequest;
use App\Http\Services\ItemService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    /**
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * @var ItemService
     */
    protected $itemService;


    /**
     * @param ItemRepositoryInterface $itemRepository
     * @param ItemService $itemService
     */
    public function __construct(ItemRepositoryInterface $itemRepository, ItemService $itemService)
    {
        $this->itemRepository = $itemRepository;
        $this->itemService = $itemService;
    }

    public function getUserId()
    {
        return auth()->id();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->getOwnedByUser($this->getUserId())->orderBy('created_at', 'desc')->paginate(config('const.pagination'));
        $calculateTotalAmounts = $this->itemService->calculateTotalAmount($this->getUserId());
        return response()->json([
            'items' => $items,
            'calculateTotalAmounts' => $calculateTotalAmounts,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(int $itemId)
    {
        $item = $this->itemRepository->findById($itemId);
        $this->authorize('view', $item);
        return response()->json([
            'item' => $item,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  $request
     */
    public function store(ItemPostRequest $request)
    {
        try {
            $request->merge(['user_id' => $this->getUserId()]);
            $this->itemRepository->store($request->validated());
            return response()->json([
                'message' => '項目を登録しました'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'バリデーションに失敗しました',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemPostRequest $request, int $itemId)
    {
        try {
            $item = $this->itemRepository->findById($itemId);
            $this->authorize('update', $item);
            $this->itemRepository->update($request->validated(), $itemId);
            return response()->json([
                'message' => '項目を更新しました'
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
     * Remove the specified resource from storage.
     */
    public function destroy(int $itemId)
    {
        try {
            $item = $this->itemRepository->findById($itemId);
            $this->authorize('delete', $item);
            $this->itemRepository->destroy($itemId);
            return response()->json([
                'message' => '項目を削除しました'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '問題が発生しました',
                'errors' => $e->errors(),
            ], 500);
        }
    }
}
