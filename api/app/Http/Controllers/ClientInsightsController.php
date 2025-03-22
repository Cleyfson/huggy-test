<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Insights\GetClientDistrictUseCase;
use App\Application\UseCases\Insights\GetClientStateUseCase;
use Illuminate\Http\JsonResponse;

class ClientInsightsController extends Controller
{
    public function __construct(
        private GetClientDistrictUseCase $getClientDistrict,
        private GetClientStateUseCase $getClientState
    ) {}

    public function getClientsByDistrict(): JsonResponse
    {
        try {
            $clients = $this->getClientDistrict->execute();

            return response()->json([
                'status' => 'success',
                'data' => $clients,
            ], 200); 
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getClientsByState(): JsonResponse
    {
        try {
            $clients = $this->getClientState->execute();

            return response()->json([
                'status' => 'success',
                'data' => $clients,
            ], 200); 
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
