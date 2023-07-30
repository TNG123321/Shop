<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps =false;
    protected $fillable = [
        'brand_id','brand_name','brand_desc','brand_status',
    ];
    //khoa chinh
    protected $primaryKey='brand_id';
    protected $table='brand_product';
    use HasFactory;
}
