<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouseRack extends Model
{
    use HasFactory;

    protected $fillable=['ware_house_id','rack'];

    public function wareHouse()
    {
        return $this->belongsTo(WareHouse::class,'ware_house_id','id');
    }
}
