<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErrorRequest;
use App\Services\ErrorService;

class ErrorController extends Controller
{
    public function __construct(
        protected ErrorService $errorService
    ) {}

    public function index()
    {
        $errors = $this->errorService->getAllErrors();
        return view('errors.index', compact('errors'));
    }

    public function create()
    {
        return view('errors.create');
    }

    public function store(ErrorRequest $request)
    {
        $this->errorService->createError($request->toDto());

        return redirect()->route('errors.index')->with('success', 'Error report created successfully.');
    }
}
