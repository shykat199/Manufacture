<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RawProductRequest;
use App\Http\Requests\RawProductSizeRequest;
use App\Models\admin\RawProduct;
use App\Models\admin\RawProductSize;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RawProductSizeController extends Controller
{
    public function createProduct()
    {
        $data['rawProduct']=RawProduct::where('status',ACTIVE_STATUS)->get();

        $data['rawProductSize']=RawProductSize::with(['product'=>function($select){
            $select->select('id','name')->where('status',ACTIVE_STATUS);
        }])->where('status',ACTIVE_STATUS)->get();


        return view('admin.rawproduct.productsize',$data);
    }

    public function storeProductSize(RawProductSizeRequest $request)
    {
        try {
            $data=[
                'product_id'=>$request->post('product'),
                'productSize'=>$request->post('size'),
            ];

            if ($data){
                RawProductSize::create($data);
                toast('Product size created successfully','success');
                return redirect()->back();
            }

        }catch (Exception $e){
            toast('Something went wrong!','error');
            return redirect()->back();
        }
    }

    public function updateProduct($id)
    {
        $data['productSizeDetails'] = RawProductSize::with(['product'=>function($select){
            $select->select('id','name');
        }])->where('id',$id)->first();

        $data['rawProductSize']=RawProductSize::with(['product'=>function($select){
            $select->select('id','name')->where('status',ACTIVE_STATUS);
        }])->where('status',ACTIVE_STATUS)->get();

        $data['rawProduct']=RawProduct::where('status',ACTIVE_STATUS)->get();

        return view('admin.rawproduct.productsize',$data);
    }

    public function updateRawProductSize(Request $request ,$id)
    {
        $productSizeDetails = RawProductSize::find($id)->update([
            'product_id'=>$request->post('product'),
            'productSize'=>$request->post('size'),
        ]);

        toast('Product size updated successfully','success');
        return redirect()->route('admin.create.product.size');
    }


    public function deleteProduct($id)
    {
        $productSizeDetails = RawProductSize::find($id)->delete();
        toast('Product size deleted successfully','success');
        return redirect()->route('admin.create.product.size');
    }
}
