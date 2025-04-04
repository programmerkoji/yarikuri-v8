<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
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
    public function getOwnedByUser(int $userId): Builder
    {
        return $this->item->where('user_id', $userId);
    }

    /**
     * itemsテーブルとitem_monthsテーブルをjoinして、is_checkedカラムを取得する
     * @param integer $userId
     * @param integer $monthId
     * @return void Illuminate\Database\Eloquent\Builder;
     */
    public function getItemsWithCheckStatus(int $userId, int $monthId): Builder
    {
        return $this->item->leftJoin('item_months', function ($join) use ($monthId) {
                $join->on('items.id', '=', 'item_months.item_id')
                    ->where('item_months.month_id', '=', $monthId);
            })
            ->select('items.*', 'item_months.is_checked')
            ->where('items.user_id', $userId)
            ->orderBy('items.updated_at', 'desc');
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
