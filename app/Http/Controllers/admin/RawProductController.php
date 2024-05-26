<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RawProductRequest;
use App\Models\admin\RawProduct;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RawProductController extends Controller
{
    public function createProduct()
    {
        return view('admin.rawproduct.action');
    }

    public function storeProduct(RawProductRequest $request)
    {
        try {
            $data=[
                'name'=>$request->post('name'),
                'prefix'=>$request->post('slug'),
                'price'=>$request->post('price'),
                'status'=>$request->post('status'),
            ];

            if ($data){
                RawProduct::create($data);
                toast('Product added successfully','success');
                return redirect()->route('admin.product.list');
            }
        }catch (\Exception $e){
            toast('Something went wrong.','error');
            return redirect()->back();
        }
    }

    public function updateProduct(Request $request,$slug)
    {
        try {

            $data=[
                'name'=>$request->post('name'),
                'prefix'=>$request->post('slug'),
                'price'=>$request->post('price'),
                'status'=>$request->post('status'),
            ];
            if ($data){
                RawProduct::where('prefix',$slug)->first()->update($data);
                toast('Product updated successfully','success');
                return redirect()->route('admin.product.list');
            }

        }catch(Exception $e){
            toast('Something went wrong.','error');
            return redirect()->back();
        }
    }

    public function productList()
    {
        $data['allProducts']=RawProduct::all();
        return view('admin.rawproduct.index',$data);
    }

    public function productDetails($slug)
    {
        $data['getProduct'] = RawProduct::where('prefix',$slug)->first();
        if ($data['getProduct']){
            return view('admin.rawproduct.action',$data);
        }
    }

    public function deleteProduct($slug)
    {
        $data['getProduct'] = RawProduct::where('prefix',$slug)->first();
        if ($data['getProduct']){
            RawProduct::where('prefix',$slug)->delete();
            toast('Successfully deleted the product','success');
            return redirect()->back();
        }
    }
}
