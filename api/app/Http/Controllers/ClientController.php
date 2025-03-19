<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Application\UseCases\Client\ClientUpdateUseCase;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Http\Request;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private ClientRegisterUseCase $register,
        private ClientUpdateUseCase $update,
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

    public function update(ClientUpdateRequest $request, int $id)
    {
        try {
      
            $client = $this->update->execute($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Cliente atualizado com sucesso',
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
