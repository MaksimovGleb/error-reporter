<?php

namespace App\Actions;

use App\Models\ErrorMessage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class GetErrorMessagesAction
{
    public function execute(int $perPage = 10): LengthAwarePaginator
    {
        return Auth::user()
            ->errorMessages()
            ->with('user')
            ->latest()
            ->paginate($perPage);
    }
}
