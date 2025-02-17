<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ItemRepositoryInterface
{
    public function getOwnedByUser(int $userId): Collection;
    public function findById(int $itemId);
    public function store(array $data);
    public function update(array $data, int $itemId);
    public function destroy(int $itemId);
}
