<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=['product_id','product_size','product_qty','product_weight','product_price','product_ware_house','product_total_price','rack'];

    public function products()
    {
        return $this->belongsTo(RawProduct::class,'product_id','id');
    }

    public function productSize()
    {
        return $this->belongsTo(RawProductSize::class,'product_size','id');
    }

    public function productWareHouse()
    {
        return $this->belongsTo(WareHouse::class,'product_ware_house','id');
    }

    public function productWareHouseRack()
    {
        return $this->belongsTo(WareHouseRack::class,'rack','id');
    }
}
