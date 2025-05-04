<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\HomeProduct;
use Illuminate\Http\Request;
class HomeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeproducts = HomeProduct::all();
        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $homeproducts 
        ]);


     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    

        $homeproduct = HomeProduct::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $homeproduct

        ],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $homeproduct = HomeProduct::find($id);
        if(!$homeproduct) {
            return response()->json([
                'success' => false,
                'message' => 'Product not find',
                
            ], 404);
         }

         return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $homeproduct
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $homeproduct = HomeProduct::find($id);

        if(!$homeproduct) {
            return response()->json([
                'success' => false,
                'message' => 'Product not find '
            ], 404);
        }

        $homeproduct->name = $request->name;
        $homeproduct->update();

        return response()->json([
            'success' => true,
            'message' => 'Product update successfully',
            'data' => $homeproduct            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $homeproduct = HomeProduct::find($id);

        if(!$homeproduct) {
            return response()->json([
                'success' => false,
                'message' => 'product not find '

            ], 404);
                
        }

        $homeproduct->delete();

        return response()->json([
            'success' => true,
            'message' => 'proudct delete successfully',
            'data' => $homeproduct
        ]);
    }
}
