<?php

namespace app\Services;

use App\Enums\OperationType;
use App\Repositories\ProductHistoryRepository;

class ProductHistoryService {
    protected $ProductHistoryRepository;

    public function __construct(
        ProductHistoryRepository $ProductHistoryRepository
    )
    {
        $this->ProductHistoryRepository = $ProductHistoryRepository;
    }

    public function register(Object $product, Array $inputs): Object
    {
        $operationType = $inputs['amount'] >= 0 ? OperationType::ADD : OperationType::REMOVE;

        $history = $this->ProductHistoryRepository->store([
            'product_id'     => $product->id,
            'amount'         => $inputs['amount'],
            'operation_type' => $operationType
        ]);

        return $history;
    }

    public function getFilteredList(Array $filters = [])
    {
        $history = $this->ProductHistoryRepository->getAll();

        if(isset($filters['product_id'])) {
            $history = $history->where('product_id', $filters['product_id']);
        } 
        
        return $history;
    }
}