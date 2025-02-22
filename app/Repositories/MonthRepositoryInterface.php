<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

interface MonthRepositoryInterface
{
    public function getOwnedByUser(int $userId): EloquentBuilder;
    public function findById(int $monthId);
    public function store(array $data);
    public function update(array $data, int $monthId);
    public function destroy(int $monthId);
}
