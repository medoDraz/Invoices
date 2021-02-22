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


    public function update(Request $request)
    {
        // dd($request);
        $id = Section::where('section_name',$request->section_name)->first()->id;
        // dd($id);
        $validatedData = $request->validate([
            'product_name' => 'required|max:255|unique:products,product_name,'.$request->id,
        ],[

            'product_name.required' =>'يرجي ادخال اسم القسم',
            'product_name.unique' =>'اسم القسم مسجل مسبقا',


        ]);
        $product = Product::findOrFail($request->id);
        $product->update([
            'product_name' => $request->product_name,
            'section_id' => $id,
            'description' => $request->description,
//            'Created_by' => (Auth::user()->name),

        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح ');
        return redirect('/products');
    }


    public function destroy(Request $request)
    {
        // dd($request);
        $product = Product::findOrFail($request->id);
        $product->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/products');
    }
}
