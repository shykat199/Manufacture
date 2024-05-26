<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        $data['userLists'] = User::where('role', '!=', ADMIN_ROLE)->get();
        return view('admin.user.index', $data);
    }

    public function userInfo($id)
    {
        try {

            $userInfo = User::where('id', $id)->first();

            if ($userInfo) {
                if ($userInfo->role == USER_ROLE) {
                    $userInfo->user_role = 'User';
                }

                $userInfo->userDate = formatedCreateAt($userInfo->created_at);
            }
            return response()->json([
                'status' => true,
                'data' => $userInfo,
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
                    'name' => $request->post('UserName')
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
