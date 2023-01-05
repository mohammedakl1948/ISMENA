<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contactinformation';
    protected $primaryKey = 'id';
    protected $fillable = ['id','FirstName','LastName','Email','PhoneNumber','created_at','updated_at'];
}
