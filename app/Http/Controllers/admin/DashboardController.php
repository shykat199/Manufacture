<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if ( getRolePermission(auth()->user()->role,'dashboard') == 0){
            toast('You do not have access right','error');
            return redirect()->back();
        }

        return view('admin.dashboard');
    }
}
