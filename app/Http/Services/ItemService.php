<?php

namespace App\Http\Services;

use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ItemService
{
    /**
     * @var ItemRepositoryInterface
     */
    protected $itemRepository;

    /**
     * @param ItemRepositoryInterface $itemRepository
     */
    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function calculateTotalAmount(int $userId)
    {
        $items = $this->itemRepository->getOwnedByUser($userId)->get();
        $prices = [];
        foreach ($items as $value) {
            $prices[] = $value->price;
        }
        $calculateTotalAmounts = array_sum($prices);
        return $calculateTotalAmounts;
    }

    /**
     * 入力されたmonth_idがログインユーザーのものでない場合には、403エラーを返す
     *
     * @param integer $userId
     * @param integer $monthId
     * @return Illuminate\Database\Eloquent\Builder;
     */
    public function getTopItems(int $userId, int $monthId): Builder
    {
        if (!$this->isMonthOwnedByUser($userId, $monthId)) {
            abort(403, 'Unauthorized access to this month.');
        }
        return $this->itemRepository->getItemsWithCheckStatus($userId, $monthId);
    }

    /**
     * 入力されたmonth_idがログインユーザーのものかチェック
     *
     * @param integer $userId
     * @param integer $monthId
     * @return boolean
     */
    private function isMonthOwnedByUser(int $userId, int $monthId)
    {
        return DB::table('months')->where('id', $monthId)->where('user_id', $userId)->exists();
    }
}
