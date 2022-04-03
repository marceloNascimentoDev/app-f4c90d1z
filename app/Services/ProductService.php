<?php

namespace app\Services;

use App\Repositories\ProductRepository;

class ProductService {
    protected $ProductRepository;

    public function __construct(
        ProductRepository $ProductRepository
    ) {
        $this->ProductRepository = $ProductRepository;
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