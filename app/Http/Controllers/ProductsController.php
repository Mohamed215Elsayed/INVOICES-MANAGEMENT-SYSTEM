<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $sections = sections::all();
        return view("products.products", compact("products", "sections"));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'Product_name' => 'required',
            ],
            [
                'Product_name.required' => 'يرجي ادخال اسم المنتج',
            ]
        );

        Products::create($validatedData + [
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);

        Session::flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate(
            [
                'Product_name' => 'required',
            ],
            [
                'Product_name.required' => 'يرجي ادخال اسم المنتج',
            ]
        );

        $id = sections::where('section_name', $request->section_name)->first()->id;

        $products = Products::findOrFail($request->pro_id);
        $products->update($validatedData + [
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);
        Session::flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }
    public function destroy(Request $request)
    {
        $products = Products::findOrFail($request->pro_id);
        $products->delete();
        Session::flash('delete', 'تم حذف المنتج بنجاح');
        return back();
    }
}
