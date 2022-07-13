<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function save($data)
    {
        $product = new $this->product;
        $product['name'] = $data['name'];
        $product['price'] = $data['price'];
        $product->save();

        return $product->fresh();
    }

    public function getAllProduct()
    {
        $products = $this->product->get();
        return $products;
    }

    public function getById($id)
    {
        return $this->product->where('id',$id)->get();
    }

    public function update($data, $id)
    {
        $product = $this->product->find($id);
        $product->name = $data['name'];
        $product->price = $data['price'];
       
        $product->update();
        
        return $product;
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        return $product;
    }
}