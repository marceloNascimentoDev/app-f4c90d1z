<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $ProductService;

    public function __construct(
        ProductService $ProductService
    )
    {   
        $this->ProductService = $ProductService;
    }

    public function store(ProductStoreRequest $request): JsonResponse {
        DB::beginTransaction();

        if($this->ProductService->findBySku($request->get('sku'))) {
            return Response()->json(['data' => 'SKU has already been registered', 'success' => false], 422);
        }

        try {
            $product = $this->ProductService->store($request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], 200);
        } catch (\Exception $th) {
            return Response()->json(['data' => '', 'success' => false], 500);
        }
    }
}