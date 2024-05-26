<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Permission;
use App\Models\admin\Role;
use App\Models\admin\RolePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;

class RolePermissionController extends Controller
{

    public function index()
    {
        $data['allRoles'] = Role::with(['permissions' => function ($select) {
            $select->where('status', ACTIVE_STATUS);
        }])->where('status', ACTIVE_STATUS)->get();
        return view('admin.rolepermission.index', $data);
    }

    public function rolePermissionDetails($id)
    {
        try {
            $roleData = Role::with(['permissions' => function ($select) {
                $select->where('status', ACTIVE_STATUS);
            }])->where('id', $id)->where('status', ACTIVE_STATUS)->first();

            $allPermissions = Permission::where('status', ACTIVE_STATUS)->get();
            return response()->json([
                'status' => true,
                'data' => $roleData,
                'allPermissions' => $allPermissions
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function role()
    {
        if(getRolePermission(auth()->user()->role,'role') == 0){
            toast('You do not have access right','error');
            return redirect()->back();
        }

        $data['roles'] = Role::where('status', ACTIVE_STATUS)->get();

        return view('admin.rolepermission.role', $data);
    }

    public function permission()
    {
        $data['permissions'] = Permission::where('status', ACTIVE_STATUS)->get();

        return view('admin.rolepermission.permission', $data);

    }

    public function updateRolePermission(Request $request)
    {

        try {
            $name = $request->post('roleName');
            $id = $request->post('roleId');
            $permissionList = $request->post('selectedValues');

            if ($name) {
                Role::where('id', $id)->update([
                    'name' => $name
                ]);
            }
            $rolePermissionArray = [];

            $userPermissions = RolePermission::where('role_id', $id)
                ->whereIn('permission_id', $permissionList)
                ->pluck('permission_id')
                ->toArray();
            $permissionsToInsert = array_diff($permissionList, $userPermissions);

            if ($permissionsToInsert) {
                foreach ($permissionsToInsert as $permissionId) {
                    $rolePermissionArray[] = [
                        'role_id' => $id,
                        'permission_id' => $permissionId,
                        'created_at' => formateDate(Carbon::now()),
                        'updated_at' => formateDate(Carbon::now()),
                    ];
                }

                RolePermission::insert($rolePermissionArray);
            }

            return response()->json([
                'status' => true,
                'message' => 'Updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }


    }

    public function updateRolePermissionDetails(Request $request, $id)
    {
        try {

            $allPermissions = $request->post('permission');

            $updateRole = Role::find($id);
            if ($request->post('role')) {
                $updateRole->name = $request->post('role');
                $updateRole->save();
            }

            if ($allPermissions) {
                RolePermission::where('role_id', $updateRole->id)->delete();
                $rolePermissionArray = [];
                foreach ($allPermissions as $item) {
                    $rolePermissionArray[] = [
                        'permission_id' => $item,
                        'role_id' => $updateRole->id,
                        'created_at' => formateDate(Carbon::now()),
                        'updated_at' => formateDate(Carbon::now()),
                    ];
                }

                RolePermission::insert($rolePermissionArray);
            }

            toast('Updated successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            toast('Something wrong!', 'error');
            return redirect()->back();
        }
    }

    public function getRoleDetails($id)
    {
        $data['allPermissions'] = Permission::select('id', 'permission_name')->where('status', ACTIVE_STATUS)->get()->toArray();

        $data['roleDetails'] = Role::with(['permissions' => function ($select) {
            $select->where('status', ACTIVE_STATUS);
        }])->select('id', 'name')->where('id', $id)->first();

        $data['chunkData'] = array_chunk($data['allPermissions'], 5);


        if (count($data['roleDetails']->permissions) > 0) {
            $data['rolePermissionIds'] = $data['roleDetails']->permissions->pluck('id')->toArray();
        }

        return view('admin.rolepermission.index', $data);
    }


    public function deletePermission($id)
    {
        $permission = Permission::find($id);
    }
}
