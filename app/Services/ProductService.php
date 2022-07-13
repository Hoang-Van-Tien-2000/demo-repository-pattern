<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Models\Product;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductService
{
    protected $productRepository;

    public function __construct(productRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProduct()
    {
        return $this->productRepository->getAllProduct();
    }

    public function saveProductData($data)
    {    
        $result = $this->productRepository->save($data);
        return $result;
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function updateProduct($data, $id)
    {
        DB::beginTransaction();
        
        try {
            $product = $this->productRepository->update($data, $id);   

        } catch(Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            
            throw new InvalidArgumentException('Unable to update product data');
        } 

        DB::commit();

        return $product;
        
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
       
        try {
        $product = $this->productRepository->delete($id);
       
        } catch(Exception $e) {
        DB::rollBack();
        Log::info($e->getMessage());
        
        throw new InvalidArgumentException('Unable to delete product data');
    } 
        DB::commit();
        
        return $product;

    }
}