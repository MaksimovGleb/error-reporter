<?php

namespace App\Services;

use App\Actions\CreateErrorMessageAction;
use App\Actions\GetErrorMessagesAction;
use App\DTOs\ErrorMessageData;
use App\Models\ErrorMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class ErrorMessageService
{
    public function __construct(
        protected GetErrorMessagesAction $getErrorMessagesAction,
        protected CreateErrorMessageAction $createErrorMessageAction
    ) {}

    public function getAllErrorMessages(): LengthAwarePaginator
    {
        return $this->getErrorMessagesAction->execute();
    }

    public function createErrorMessage(ErrorMessageData $data): ErrorMessage
    {
        return $this->createErrorMessageAction->execute($data);
    }
}
