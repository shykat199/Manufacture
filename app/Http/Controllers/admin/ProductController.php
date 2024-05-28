<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use App\Models\admin\RawProduct;
use App\Models\admin\RawProductSize;
use App\Models\admin\WareHouse;
use App\Models\admin\WareHouseRack;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $data['allRawProducts'] = RawProduct::select('id', 'name')->where('status', ACTIVE_STATUS)->get();
        $data['allProductWareHouse'] = WareHouse::select('id', 'name')->get();
        return view('admin.product.action', $data);
    }

    public function productSize(Request $request, $id)
    {
        if ($request->ajax()) {
            $allProductSize = RawProductSize::with(['product' => function ($select) {
                $select->select('id', 'name', 'price');
            }])->select('productSize', 'id', 'product_id')->where('product_id', $id)->get();

            if ($allProductSize) {
                return response()->json([
                    'status' => true,
                    'data' => $allProductSize
                ]);
            }

        }
    }

    public function wareHouseRack(Request $request, $id)
    {
        if ($request->ajax()) {
            $wareHouseRacks = WareHouseRack::where('ware_house_id', $id)->get();

            if ($wareHouseRacks) {
                return response()->json([
                    'status' => true,
                    'data' => $wareHouseRacks
                ]);
            }

        }
    }

    public function storeProduct(ProductRequest $request)
    {
        try {

            $data = [
                'product_id' => $request->post('rawProductId'),
                'product_size' => $request->post('rawProductSize'),
                'product_qty' => $request->post('productQty'),
                'product_weight' => $request->post('productWeight'),
                'product_price' => $request->post('productPrice'),
                'product_total_price' => $request->post('productTotalPrice'),
                'product_ware_house' => $request->post('productWareHouseId'),
                'rack' => $request->post('productWareHouseRackId'),
            ];

            if ($data) {
                Product::create($data);
                toast('New product created successfully', 'success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'success');
            return redirect()->back();
        }

    }


    public function updateProduct(ProductRequest $request, $id)
    {
        try {

            $data = [
                'product_id' => $request->post('rawProductId'),
                'product_size' => $request->post('rawProductSize'),
                'product_qty' => $request->post('productQty'),
                'product_weight' => $request->post('productWeight'),
                'product_price' => $request->post('productPrice'),
                'product_total_price' => $request->post('productTotalPrice'),
                'product_ware_house' => $request->post('productWareHouseId'),
                'rack' => $request->post('productWareHouseRackId'),
            ];

            if ($data) {
                Product::find($id)->update($data);
                toast('New product updated successfully', 'success');
                return redirect()->route('admin.warehouse.product.list');
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'success');
            return redirect()->back();
        }

    }

    public function productList()
    {
        $data['getProductLists'] = Product::with(['products' => function ($select) {
            $select->select('id', 'name', 'price');
        }, 'productSize' => function ($select) {
            $select->select('id', 'product_id', 'productSize');
        }, 'productWareHouse' => function ($select) {
            $select->select('id', 'name');
        }, 'productWareHouseRack' => function ($select) {
            $select->select('id', 'ware_house_id', 'rack');
        }])->get();

        return view('admin.product.index', $data);
    }

    public function deleteProduct($id)
    {
        $deleteProduct = Product::find($id)->delete();
        toast('Deleted successfully', 'success');
        return redirect()->back();
    }

    public function editWareHouseProduct($id)
    {
        $data['getProductLists'] = Product::with(['products' => function ($select) {
            $select->select('id', 'name', 'price');
        }, 'productSize' => function ($select) {
            $select->select('id', 'product_id', 'productSize');
        }, 'productWareHouse' => function ($select) {
            $select->select('id', 'name');
        }, 'productWareHouseRack' => function ($select) {
            $select->select('id', 'ware_house_id', 'rack');
        }])->where('id', $id)->first();

        $data['allRawProducts'] = RawProduct::select('id', 'name')->where('status', ACTIVE_STATUS)->get();
        $data['allProductWareHouse'] = WareHouse::select('id', 'name')->get();

        return view('admin.product.action', $data);
    }
}
