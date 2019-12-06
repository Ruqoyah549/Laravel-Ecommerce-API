<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
    }

    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->save();

        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);

    }


    public function show(Product $product)
    {
        // return $product;
        return new ProductResource($product);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());

        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }


    public function destroy(Product $product)
    {
        //
    }
}
