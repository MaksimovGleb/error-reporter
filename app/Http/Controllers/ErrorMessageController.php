<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErrorMessageRequest;
use App\Services\ErrorMessageService;

class ErrorMessageController extends Controller
{
    public function __construct(
        protected ErrorMessageService $errorMessageService
    ) {}

    public function index()
    {
        $errorMessages = $this->errorMessageService->getAllErrorMessages();
        return view('error_messages.index', compact('errorMessages'));
    }

    public function create()
    {
        return view('error_messages.create');
    }

    public function store(ErrorMessageRequest $request)
    {
        $this->errorMessageService->createErrorMessage($request->toDto());

        return redirect()->route('error_messages.index')->with('success', 'Error report created successfully.');
    }
}
