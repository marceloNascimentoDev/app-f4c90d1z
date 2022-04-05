<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\JsonResponse;
use App\Enums\StatusCode;

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
            return Response()->json(['data' => 'SKU has already been registered', 'success' => false], StatusCode::UNPROCESSABLE_CONTENT);
        }

        try {
            $product = $this->ProductService->store($request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Exception $th) {
            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }

    public function operation(Request $request)
    {
        if(!$product = $this->ProductService->findBySku($request->get('sku'))) {
            return Response()->json(['data' => 'SKU not find', 'success' => false], StatusCode::UNPROCESSABLE_CONTENT);
        }

        if(!$product->canUpdateAmount($request['amount'])) {
            return Response()->json(['data' => 'invalid operation', 'success' => false], StatusCode::UNPROCESSABLE_CONTENT);
        }

        DB::beginTransaction();

        try {
            $product = $this->ProductService->operation($request->all());

            DB::commit();

            return Response()->json([
                'data'    => ProductResource::make($product),
                'success' => true
            ], StatusCode::SUCCESS);
        } catch (\Throwable $th) {
            return Response()->json(['data' => '', 'success' => false], StatusCode::ERROR);
        }
    }
}