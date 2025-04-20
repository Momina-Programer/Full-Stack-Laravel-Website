<?php

namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => "Product retrieved successfully",
            'data' => $products
        ]);
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric|min:0',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Validation error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

       $product = Product::create($request->all());
       return response()->json([
        'success' => true,
        'message' => "Product created successfully",
        'data' => $product
       ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $product = Product::find($id);
      
      if(!$product) {
        return response()->json([
            'success' => false,
            'message' => "Product not found."
        ], 404);
      }

      return response()->json([
        'success' => true,
        'message' => "Product retrieved successfully",
        'data' => $product
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $product = Product::find($id);

      if(!$product) {
        return response()->json([
            'success' => false,
            'message'=> "Product not found"
        ], 404);
      }

      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    $product->name = $request->name;
    $product->update();
   
    
    return response()->json([
        'success' => true,
        'message' => "Product updated successfully",
        'data' => $product
    ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                'success' => false,
                'message' => "Product not found"
            ], 404);
        }

        $product->delete();
   

        return response()->json([
            'success' => true,
            'message' => "Product delete successfully",
            'data' => $product
        ]);

    }
}
