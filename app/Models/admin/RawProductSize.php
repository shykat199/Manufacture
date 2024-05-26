<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawProductSize extends Model
{
    use HasFactory;

    protected $fillable=['product_id','productSize','status'];

    public function product()
    {
        return $this->belongsTo(RawProduct::class,'product_id','id');
    }
}
