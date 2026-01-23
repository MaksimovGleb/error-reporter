<?php

namespace App\Actions;

use App\DTOs\ErrorData;
use App\Models\Error;

class CreateErrorAction
{
    public function execute(ErrorData $data): Error
    {
        return Error::create($data->toArray());
    }
}
