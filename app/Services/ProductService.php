<?php

namespace app\Services;

use App\Repositories\ProductRepository;
use App\Services\ProductHistoryService;

class ProductService {
    protected $ProductRepository;
    protected $ProductHistoryService;

    public function __construct(
        ProductRepository $ProductRepository,
        ProductHistoryService $ProductHistoryService
    ) {
        $this->ProductRepository = $ProductRepository;
        $this->ProductHistoryService = $ProductHistoryService;
    }

    public function store(Array $data) {
        try {
            return $this->ProductRepository->store($data);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function operation(Array $data) {
        try {
            $product = $this->productMovement($data);

            $this->ProductHistoryService->register($product, $data);

            return $product;
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function findBySku(String $sku) {
        $product =$this->ProductRepository->where([['sku', '=', $sku]]);

        if($product->first()) {
            return $product->first(); 
        }

        return null;
    }

    public function productMovement(Array $data): Object
    {
        $product = $this->findBySku($data['sku']);

        $updates = ['amount' => $product->amount += $data['amount']];

        $product = $this->ProductRepository->update($product->id, $updates);

        return $product;
    }
}