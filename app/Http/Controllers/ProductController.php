<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.products', compact('products','sections'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    //    dd($request);
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
        ],[

            'product_name.required' =>'يرجي ادخال اسم القسم',
            'product_name.unique' =>'اسم القسم مسجل مسبقا',


        ]);

        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
//            'Created_by' => (Auth::user()->name),

        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
