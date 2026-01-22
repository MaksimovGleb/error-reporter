<?php

namespace App\Services;

use App\Models\Error;
use Illuminate\Pagination\LengthAwarePaginator;

class ErrorService
{
    public function getAllErrors(int $perPage = 10): LengthAwarePaginator
    {
        return Error::with('user')
            ->latest()
            ->paginate($perPage);
    }

    public function createError(array $data, int $userId): Error
    {
        return Error::create(array_merge($data, [
            'user_id' => $userId,
        ]));
    }
}
