<?php

namespace App\Http\Requests;

use App\DTOs\ErrorData;
use Illuminate\Foundation\Http\FormRequest;

class ErrorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'level' => ['required', 'string', 'in:info,warning,error,critical'],
        ];
    }

    public function toDto(): ErrorData
    {
        return ErrorData::fromArray(array_merge($this->validated(), [
            'user_id' => auth()->id(),
        ]));
    }
}
