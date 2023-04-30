<?php

namespace App\Http\Repositories;

use App\Models\Month;
use Illuminate\Suppoort\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;

class MonthRepository
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
     *
     */
    public function getAllMonthsPaginate()
    {
        return $this->month->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(self::PAGINATE);
    }

    /**
     *
     */
    public function getAllMonths()
    {
        return $this->month->all();
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
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }

    /**
     * @param int $id
     */
    public function findById(int $id)
    {
        return $this->month->findOrFail($id);
    }

    /**
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($id)->fill($data)->save();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            FacadesDB::beginTransaction();
            $this->findById($id)->delete();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            FacadesDB::rollback();
        }
    }
}
