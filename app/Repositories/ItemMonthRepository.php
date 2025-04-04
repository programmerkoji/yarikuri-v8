<?php

namespace App\Repositories;

use App\Models\ItemMonth;
use Illuminate\Suppoort\Facades\DB;

class ItemMonthRepository implements ItemMonthRepositoryInterface
{
    /**
     * @var ItemMonth
     */
    protected $itemMonth;

    /**
     * @param ItemMonth
     */
    public function __construct(ItemMonth $itemMonth)
    {
        $this->itemMonth = $itemMonth;
    }

    /**
     * @param $itemMonth
     */
    public function index()
    {
        return $this->itemMonth->get();
    }

    /**
     *
     */
    public function getItemMonth($itemId, $monthId)
    {
        return $this->itemMonth->where('item_id', $itemId)->where('month_id', $monthId)->first();
    }

    /**
     * blade用のチェック登録更新
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    public function createOrUpdateItemMonth($id, $data)
    {
        $this->itemMonth->updateOrCreate(['id' => $id], $data);
    }

    public function createOrUpdateItemMonthApi($data)
    {
        $this->itemMonth->updateOrCreate(
            [
                'item_id' => $data['item_id'],
                'month_id' => $data['month_id']
            ],
            $data
        );
    }
}
