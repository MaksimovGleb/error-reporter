<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\ErrorRequest;
use App\Http\Resources\ErrorResource;
use App\Services\ErrorService;
use Illuminate\Http\JsonResponse;

class ErrorController extends Controller
{
    public function __construct(
        protected ErrorService $errorService
    ) {}

    public function index(): JsonResponse
    {
        $errors = $this->errorService->getAllErrors();

        return ErrorResource::collection($errors)->response();
    }

    public function store(ErrorRequest $request): JsonResponse
    {
        $error = $this->errorService->createError($request->toDto());

        return (new ErrorResource($error))
            ->response()
            ->setStatusCode(201);
    }
}
