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

    public function operation(Request $request)
    {
        if(!$product = $this->ProductService->findBySku($request->get('sku'))) {
            return Response()->json(['data' => 'SKU not find', 'success' => false], 422);
        }

        if(!$product->canUpdateAmount($request['amount'])) {
            return Response()->json(['data' => 'invalid operation', 'success' => false], 422);
        }

        DB::beginTransaction();

        try {
            $product = $this->ProductService->operation($request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], 500);
        }
    }
}