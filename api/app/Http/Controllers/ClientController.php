<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Application\UseCases\Client\ClientUpdateUseCase;

use App\Http\Requests\ClientStoreRequest;
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

    public function update(Request $request, int $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'nullable|string',
                'mobile' => 'nullable|string',
                'address' => 'nullable|string',
                'state' => 'nullable|string',
                'district' => 'nullable|string',
            ]);
    
            $client = $this->update->execute($id, $data);

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
