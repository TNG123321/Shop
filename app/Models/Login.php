<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps =false;
    protected $fillable = [
        'admin_email','admin_password','admin_name','admin_phone',
    ];
    //khoa chinh
    protected $primaryKey='admin_id';
    protected $table='admin';
    use HasFactory;
}
