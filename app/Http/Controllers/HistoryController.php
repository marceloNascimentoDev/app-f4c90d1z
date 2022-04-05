<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductHistoryService;
use App\Http\Resources\HistoryResource;
use App\Enums\StatusCode;

class HistoryController extends Controller
{
    protected $ProductHistoryService;

    public function __construct(
        ProductHistoryService $ProductHistoryService
    )
    {   
        $this->ProductHistoryService = $ProductHistoryService;
    }

    public function index(Request $request)
    {
        try {
            $history = $this->ProductHistoryService->getFilteredList($request->all());

            return Response()->json([
                'data'    => HistoryResource::collection($history),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }
}
