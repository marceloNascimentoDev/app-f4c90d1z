<?php

namespace App\Repositories;

use App\Models\ProductHistory;

class ProductHistoryRepository
{
    public function __construct(ProductHistory $model) {
        $this->model = $model;
    }   

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    
    public function destroy(String $id): Object
    {
        $model = $this->find($id);

        $model->delete();
        
        return $model;
    }

    public function where(Array $condition = [])
    {
        $query = $this->model;

        foreach ($condition as $key => $value) {
            $query = $query->where($value[0], $value[1], $value[2]);
        }

        return $query;
    }

    public function store($data)
    {   
        $model = $this->save($this->model, $data);

        return $model;
    }

    public function update($id, $data)
    {
        $model = $this->find($id);
        
        return $this->save($model, $data);
    }

    public function save(ProductHistory $model, $data)
    {
        if(isset($data['product_id'])) {
            $model->product()->associate($data['product_id']);
        }

        if(isset($data['operation_type'])) {
            $model->operation_type = $data['operation_type'];
        }
        
        if(isset($data['amount'])) {
            $model->amount = $data['amount'];
        }
        

        $model->save();

        return $model;
    }

}