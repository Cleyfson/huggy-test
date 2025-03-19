<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Application\UseCases\Client\ClientUpdateUseCase;
use App\Application\UseCases\Client\ClientDeleteUseCase;
use App\Application\UseCases\Client\ClientShowUseCase;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private ClientRegisterUseCase $register,
        private ClientUpdateUseCase $update,
        private ClientDeleteUseCase $delete,
        private ClientShowUseCase $show,
    ) {}

    public function store(ClientStoreRequest $request): JsonResponse
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

    public function show($id)
    {
        try {
            $client = $this->show->execute($id);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'name' => $client->getName(),
                    'email' => $client->getEmail(),
                    'phone' => $client->getPhone(),
                    'mobile' => $client->getMobile(),
                    'address' => $client->getAddress(),
                    'state' => $client->getState(),
                    'district' => $client->getDistrict(),
                    'photo' => $client->getPhoto(),
                ], 
            ], 200); 
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(ClientUpdateRequest $request, int $id): JsonResponse
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

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->delete->execute($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Cliente deletado com sucesso'
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
