<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource as ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
    		'price' => 'required',
    		'category' => 'required',
        ],

        [
            'name.required'=>'product name is required',
            'price.required'=>'product price is required',
            'category.required'=>'product category is required'
        ]
    
    
    );

    if ($validator->fails()){

        return response(['errors'=>$validator->errors()->all()], 422);

        }

        $product = Product::create($request->toArray());

        return response([
            'message'=>'product created successfully',
            'products'=>$product
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
    		'price' => 'required',
    		'category' => 'required',
        ],

        [
            'name.required'=>'product name is required',
            'price.required'=>'product price is required',
            'category.required'=>'product category is required'
        ]
    
    );

    if ($validator->fails()){

        return response(['errors'=>$validator->errors()->all()], 422);

        }
       
        $product->update($request->all());

        return response([
            'message'=>'Updated',
            'data'=> new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            "message"=>'Product Deleted'
        ],200);
    }
}
