<?php

namespace App\Http\Services;

use App\Http\Repositories\MonthRepository;

class MonthService
{
    /**
     * @var MonthRepository
     */
    protected $monthRepository;

    /**
     * @param MonthRepository $monthRepository
     */
    public function __construct(MonthRepository $monthRepository)
    {
        $this->monthRepository = $monthRepository;
    }

    /**
     * @return object
     */
    public function index()
    {
        return $this->monthRepository->getAllMonths();
    }

    public function sortByMultipleColumns()
    {
        return $this->monthRepository->getAllMonthsPaginate();
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        $item = $this->monthRepository->store($data);
        return $item;
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        $item = $this->monthRepository->update($data, $id);
        return $item;
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $item = $this->monthRepository->destroy($id);
        return $item;
    }
}
