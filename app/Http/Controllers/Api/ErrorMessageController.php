<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ErrorMessageRequest;
use App\Http\Resources\ErrorMessageResource;
use App\Services\ErrorMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ErrorMessageController extends Controller
{
    public function __construct(
        protected ErrorMessageService $errorMessageService
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $errorMessages = $this->errorMessageService->getAllErrorMessages();

        return ErrorMessageResource::collection($errorMessages);
    }

    public function store(ErrorMessageRequest $request): JsonResponse
    {
        $errorMessage = $this->errorMessageService->createErrorMessage($request->toDto());

        return (new ErrorMessageResource($errorMessage))
            ->response()
            ->setStatusCode(201);
    }
}
