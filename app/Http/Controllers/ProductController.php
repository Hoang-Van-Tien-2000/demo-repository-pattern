<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ProductFormRequest;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {  
        $result = ['status' => Response::HTTP_OK];
        
        try {
          
            $result['data'] = $this->productService->getAllProduct();
        
        } catch (\Exception $e) {
            $result = [
                'status' => Product::INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {    
        $result = ['status' => Response::HTTP_OK];
        
        try {

            $result['data'] = $this->productService->saveProductData($request->all());

        } catch (\Exception $e) {
            $result = [
                'status' => Product::INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage(),
            ];
        }
        
        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => Response::HTTP_OK];
       
        try {
           
            $result['data'] = $this->productService->getById($id);
            
        } catch (\Exception $e) {
            
            $result = [
                'status' => Product::INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {

        $data = $request->only([
            'name',
            'price'
        ]);
        
        $result = ['status' => Response::HTTP_OK];
        
        try {
            
            $result['data'] = $this->productService->updateProduct($data, $id);
       
        } catch (\Exception $e) {
            $result = [
                'status' => Product::INTERNAL_SERVER_ERROR,
                'data'   => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => Response::HTTP_OK];

        try {
            $result['data'] = $this->productService->deleteById($id);
            
        } catch (\Exception $e) {
            $result = [
                'status' => Product::INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}