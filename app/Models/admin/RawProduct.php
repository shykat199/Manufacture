<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawProduct extends Model
{
    use HasFactory;
    protected $fillable=['name','prefix','price','status'];

    public function productSize()
    {
        return $this->hasMany(RawProductSize::class,'product_id','id');
    }
}
