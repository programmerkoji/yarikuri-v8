<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Suppoort\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;

class ItemRepository implements ItemRepositoryInterface
{
    /**
     * @var Item
     */
    protected $item;

    /**
     * @param Item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @params $useId
     */
    public function getOwnedByUser(int $userId): Collection
    {
        return $this->item->where('user_id', $userId)->get();
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        try {
            FacadesDB::beginTransaction();
            $item = new Item;
            $item->fill($data)->save();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }

    /**
     * @param int $itemId
     */
    public function findById(int $itemId)
    {
        return $this->item->findOrFail($itemId);
    }

    /**
     * @param array $data
     * @param int $itemId
     */
    public function update(array $data, int $itemId)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($itemId)->fill($data)->save();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }

    /**
     * @param int $itemId
     */
    public function destroy(int $itemId)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($itemId)->delete();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }
}
