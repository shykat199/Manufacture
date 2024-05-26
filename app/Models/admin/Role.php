<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=['status','description','status'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions','role_id','permission_id');

    }

}
