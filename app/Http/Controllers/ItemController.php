<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryInterface;
use App\Http\Requests\ItemPostRequest;
use App\Http\Services\ItemService;
use Illuminate\Http\Request;

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
        $items = $this->itemRepository->getOwnedByUser($this->getUserId())->sortByDesc('created_date');
        $calculateTotalAmounts = $this->itemService->calculateTotalAmount($this->getUserId());
        return view('items.index', compact('items', 'calculateTotalAmounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  $request
     */
    public function store(ItemPostRequest $request)
    {
        $request->merge(['user_id' => $this->getUserId()]);
        $this->itemRepository->store($request->validated());

        return redirect()
            ->route('items.index')
            ->with('message', '項目を登録しました');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $itemId)
    {
        $item = $this->itemRepository->findById($itemId);
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemPostRequest $request, int $itemId)
    {
        $this->itemRepository->update($request->validated(), $itemId);

        return redirect()
            ->route('items.index')
            ->with('message', '項目を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $itemId)
    {
        $this->itemRepository->destroy($itemId);

        return redirect()
            ->route('items.index')
            ->with('alert', '項目を削除しました');
    }
}
