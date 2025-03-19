<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\Client\RegisterClientUseCase;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private RegisterClientUseCase $register,
    ) {}

    public function store(Request $request)
    {
        try {
            $client = $this->register->execute($request->all());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Cliente criado com sucesso',
                'data' => [
                    'id' => $client->id,
                    'name' => $client->name,
                    'email' => $client->email,
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
