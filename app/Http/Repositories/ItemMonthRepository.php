<?php

namespace App\Http\Repositories;

use App\Models\ItemMonth;
use Illuminate\Suppoort\Facades\DB;

class ItemMonthRepository
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
     *
     */
    public function createOrUpdateItemMonth($id, $data)
    {
        $this->itemMonth->updateOrCreate(['id' => $id], $data);
    }
}
