<?php

namespace App\Actions;

use App\Models\ErrorMessage;
use App\DTOs\ErrorMessageData;

class CreateErrorMessageAction
{
    public function execute(ErrorMessageData $data): ErrorMessage
    {
        return ErrorMessage::create($data->toArray());
    }
}
