<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;
    
    protected $table = "client_table";

    protected $fillable = [
        'id',
        'auth_mail',
        'billing_name', 
        'billing_email',
        'billing_address',
        'billing_phone',
        'billing_gst',
        'billing_pan',
        'billing_fax',
       
    ];
}
