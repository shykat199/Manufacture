<?php
function formateDate($date){
    return \Carbon\Carbon::parse($date)->format('Y-m-d h-i-s');
}

function formatedCreateAt($date){
    return \Carbon\Carbon::parse($date)->format('d-M-Y');
}

function getRolePermission($roleId, $permissionSlug = '')
{
    $checkPermission = \App\Models\admin\RolePermission::select('permission_id')
        ->join('permissions','permissions.id','role_permissions.permission_id')
        ->where('permissions.permission_key',$permissionSlug)
        ->where('permissions.status',ACTIVE_STATUS)
        ->where('role_id',$roleId)
        ->count();

    return $checkPermission;
}
