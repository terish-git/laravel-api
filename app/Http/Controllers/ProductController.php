<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use App\Http\Requests\ProductImportRequest​;
use Illuminate\Http\Request;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::orderByDesc("id")->paginate(5);
            // $products = Product::where('created_by', auth()->user()->id)->paginate(5); // This will return only Logged user uploaded products
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(ProductImportRequest​ $request) 
    {
        try {
            Excel::import(new ImportProduct(), $request->file('productCSV')->store('temp'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect('products')->with('success', 'Products Imported Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success','Product details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return ['error' => false, 'message' => "Product deleted successfully"];
    }

    /**
     * Return filtered resource with paginated data
     *
     */
    function fetch_data(Request $request) 
    {
        if ($request->ajax()) {
            $products      = Product::paginate(5);
            return view('products.products-pagination-data', compact('products'))->render();
        }
    }
}
