<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Http\Requests\ClientStoreRequest;
use Illuminate\Http\Request;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private ClientRegisterUseCase $register,
    ) {}

    public function store(ClientStoreRequest $request)
    {
        try {
            $client = $this->register->execute($request->validated());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente criado com sucesso',
                'data' => [
                    'id' => $client->getId(),
                    'name' => $client->getName(),
                    'email' => $client->getEmail(),
                ]
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
