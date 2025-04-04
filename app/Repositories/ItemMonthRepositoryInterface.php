<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ItemMonthRepositoryInterface
{
    public function index();
    public function getItemMonth(int $itemId, int $monthId);
    public function createOrUpdateItemMonth(int $id, array $data);
    public function createOrUpdateItemMonthApi(array $data);
}
