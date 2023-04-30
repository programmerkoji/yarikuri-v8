<?php

namespace App\Http\Services;

use App\Http\Repositories\ItemRepository;

class ItemService
{
    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * @param ItemRepository $itemRepository
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return object
     */
    public function index()
    {
        return $this->itemRepository->getAllItems();
    }

    public function sortByItem()
    {
        return $this->index()->sortByDesc('created_at');
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        $item = $this->itemRepository->store($data);
        return $item;
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        $item = $this->itemRepository->update($data, $id);
        return $item;
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $item = $this->itemRepository->destroy($id);
        return $item;
    }
}
