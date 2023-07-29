<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ItemRepository;
use App\Http\Requests\ItemPostRequest;
use App\Http\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
        /**
     * @var ItemRepository
     */
    protected $item;

    /**
     * @var ItemService
     */
    protected $itemService;


    /**
     * @param ItemRepository $itemRepository
     * @param ItemService $itemService
     */
    public function __construct(ItemRepository $itemRepository, ItemService $itemService)
    {
        $this->itemRepository = $itemRepository;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemService->sortByItem();
        $calculateTotalAmounts = $this->itemService->calculateTotalAmount();
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
        $this->itemService->store($request->validated());

        return redirect()
            ->route('items.index')
            ->with('message', '項目を登録しました');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $item = $this->itemRepository->findById($id);

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemPostRequest $request, int $id)
    {
        $this->itemService->update($request->validated(), $id);

        return redirect()
            ->route('items.index')
            ->with('message', '項目を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->itemService->destroy($id);

        return redirect()
            ->route('items.index')
            ->with('alert', '項目を削除しました');
    }
}
