<?php

namespace App\Http\Requests;

use App\DTOs\ErrorMessageData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ErrorMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|in:info,warning,error,critical',
        ];
    }

    public function toDto(): ErrorMessageData
    {
        return ErrorMessageData::fromArray(array_merge($this->validated(), [
        'user_id' => auth()->id(),
    ]));
    }
}
