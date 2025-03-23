<?php

namespace App\Repositories;

use App\Models\Month;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;

class MonthRepository implements MonthRepositoryInterface
{
    const PAGINATE = 12;

    /**
     * @var Month
     */
    protected $month;

    /**
     * @param Month
     */
    public function __construct(Month $month)
    {
        $this->month = $month;
    }

    /**
     * @params int $userId
     */
    public function getOwnedByUser(int $userId): EloquentBuilder
    {
        return $this->month->where('user_id', $userId);
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        try {
            FacadesDB::beginTransaction();
            $month = new Month;
            $month->fill($data)->save();
            FacadesDB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            FacadesDB::rollback();
            throw $e;
        }
    }

    /**
     * @param int $monthId
     */
    public function findById(int $monthId)
    {
        return $this->month->findOrFail($monthId);
    }

    /**
     * @param int $monthId
     */
    public function update(array $data, int $monthId)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($monthId)->fill($data)->save();
            FacadesDB::commit();
        } catch (\Exception $e) {
            FacadesDB::rollback();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * @param int $monthId
     */
    public function destroy(int $monthId)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($monthId)->delete();
            FacadesDB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            FacadesDB::rollback();
            throw $e;
        }
    }
}
