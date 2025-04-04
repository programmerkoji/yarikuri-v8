<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

interface ItemRepositoryInterface
{
    public function getOwnedByUser(int $userId): Builder;
    public function getItemsWithCheckStatus(int $userId, int $monthId);
    public function findById(int $itemId);
    public function store(array $data);
    public function update(array $data, int $itemId);
    public function destroy(int $itemId);
}
