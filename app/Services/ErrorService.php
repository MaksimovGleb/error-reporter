<?php

namespace App\Services;

use App\Actions\CreateErrorAction;
use App\Actions\GetErrorsAction;
use App\DTOs\ErrorData;
use App\Models\Error;
use Illuminate\Pagination\LengthAwarePaginator;

class ErrorService
{
    public function __construct(
        protected GetErrorsAction $getErrorsAction,
        protected CreateErrorAction $createErrorAction,
    ) {}

    public function getAllErrors(int $perPage = 10): LengthAwarePaginator
    {
        return $this->getErrorsAction->execute($perPage);
    }

    public function createError(ErrorData $data): Error
    {
        return $this->createErrorAction->execute($data);
    }
}
