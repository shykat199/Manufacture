<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\WareHouse;
use App\Http\Requests\WareHouseRequest;
use App\Models\admin\WareHouseRack;
use App\Http\Requests\WareHouseRackRequest;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function index()
    {
        $data['allWareHouses'] = WareHouse::all();
        return view('admin.warehouse.warehouse', $data);
    }

    public function detailsWareHouse($id)
    {
        $data['productSizeDetails'] = WareHouse::find($id);
        $data['allWareHouses'] = WareHouse::all();
        return view('admin.warehouse.warehouse', $data);
    }

    public function updateWareHouse(Request $request, $id)
    {
        try {
            $data = [
                'name' => $request->post('name'),
                'address' => $request->post('address'),
                'staff' => $request->post('staff')
            ];


            if ($data) {
                WareHouse::find($id)->update($data);
                toast('Ware house updated successfully', 'success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'error');
            return redirect()->back();
        }
    }

    public function wareHouseRack()
    {
        $data['allWareHouses'] = WareHouse::all();
        $data['allWareHouseRacks'] = WareHouseRack::with(['wareHouse' => function ($select) {
            $select->select('id', 'name');
        }])->get();

        return view('admin.warehouse.warehouseracks', $data);
    }

    public function storeWareHouse(WareHouseRequest $request)
    {
        try {
            $data = [
                'name' => $request->post('name'),
                'address' => $request->post('address'),
                'staff' => $request->post('staff')
            ];


            if ($data) {
                WareHouse::create($data);
                toast('Ware house created successfully', 'success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'error');
            return redirect()->back();
        }
    }

    public function storeWareHouseRack(WareHouseRackRequest $request)
    {
        try {
            $data = [
                'ware_house_id' => $request->post('ware_house_id'),
                'rack' => $request->post('rack'),
            ];


            if ($data) {
                WareHouseRack::create($data);
                toast('Ware house rack created successfully', 'success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'error');
            return redirect()->back();
        }
    }

    public function wareHouseRackDelete($id)
    {
        try {

            $deleteRack = WareHouseRack::find($id);
            if ($deleteRack) {
                $deleteRack->delete();
                toast('Successfully deleted', 'success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            toast('Something went wrong!', 'error');
            return redirect()->back();
        }
    }

    public function wareHouseDelete($id)
    {
        try {
            WareHouseRack::where('ware_house_id', $id)->delete();
            WareHouse::where('id', $id)->first()->delete();
            toast('Successfully deleted', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e->getMessage());
            toast('Something went wrong!', 'error');
            return redirect()->back();
        }
    }
}
