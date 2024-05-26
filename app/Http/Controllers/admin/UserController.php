<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use function Laravel\Prompts\text;

class UserController extends Controller
{
    public function index()
    {
        if ( getRolePermission(auth()->user()->role,'user') == 0){
            toast('You do not have access right','error');
            return redirect()->back();
        }
        $data['userLists'] = User::whereNotIn('role', [SUPER_ADMIN_ROLE,ADMIN_ROLE,SUB_ADMIN_ROLE])->latest()->get();

        $data['userLists']->each(function ($user){
            if ($user->role == SUPER_ADMIN_ROLE){
                $user->user_role='Super Admin';
            }elseif ($user->role == ADMIN_ROLE){
                $user->user_role='Admin';
            }elseif ($user->role == SUB_ADMIN_ROLE){
                $user->user_role='SUB ADMIN';
            }elseif ($user->role == USER_ROLE){
                $user->user_role='User';
            }elseif ($user->role == CUSTOMER_ROLE){
                $user->user_role='Customer';
            }elseif ($user->role == SUPPLIER_ROLE){
                $user->user_role='Supplier';
            }else {
                $user->user_role='Manufacture';
            }
        });

        return view('admin.user.index', $data);
    }

    public function createUser()
    {
        $data['allRoles']=Role::select('id','name')->where('status',ACTIVE_STATUS)->whereNotIn('name',['Super Admin','Admin','Sub Admin'])->get();
        return view('admin.user.action',$data);
    }

    public function storeUser(Request $request)
    {
        try {

            $data=[
                'name'=>$request->post('name'),
                'email'=>$request->post('email'),
                'password'=>Hash::make($request->post('password')),
                'role'=>$request->post('role'),
            ];

          $createUser =   User::create($data);

          if ($createUser){
              toast('User Created Successfully','success');
              return redirect()->route('admin.user.list');
          }

        }catch (\Exception $e){
            toast('Something went wrong!','error');
            return redirect()->back();
        }
    }


    public function userInfo($id)
    {
        try {

            $userInfo = User::where('id', $id)->first();
            $allRoles=Role::select('id','name')->where('status',ACTIVE_STATUS)->whereNotIn('name',['Super Admin','Admin','Sub Admin'])->get();


            if ($userInfo) {

                $userInfo->userDate = formatedCreateAt($userInfo->created_at);
            }
            return response()->json([
                'status' => true,
                'data' => $userInfo,
                'user_role' => $userInfo->role,
                'allRoles'=>$allRoles,
                'message' => null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function updateUserInfo(Request $request)
    {
        try {
            $user = User::find($request->post('userId'));
            if ($user) {

                $user->update([
                    'name' => $request->post('UserName'),
                    'role' => $request->post('roleId'),
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Updated successfully',
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            if ($user) {

                $user->delete();
                toast('Successfully deleted', 'success', 'top-right');

                return redirect()->back();

            }
        } catch (\Exception $e) {
            toast('Something went wrong!', 'danger', 'top-right');
            return redirect()->back();
        }
    }
}
