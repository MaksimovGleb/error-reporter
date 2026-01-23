<?php

namespace App\Actions;

use App\Models\Error;
use Illuminate\Pagination\LengthAwarePaginator;

class GetErrorsAction
{
    public function execute(int $perPage = 10): LengthAwarePaginator
    {
        return Error::with('user')
            ->latest()
            ->paginate($perPage);
    }
}
