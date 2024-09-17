<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    
    protected $table = "customer";

    protected $fillable = [
        'id',
        'auth_mail',
        'company_id',
        'customer_name',	
        'customer_email',
        'customer_mobile',	
        'customer_gstin_number',	
        'customer_address',	
        'customer_pin_code',	
        'customer_city',
        'customer_state',
        'customer_country',
        'cus_shipping_address',	
        'cus_shipping_pin_code',	
        'cus_shipping_city',	
        'cus_shipping_state',	
        'cus_shipping_country',	
    ];

    public function invoices()
    {
        return $this->hasMany(InvoiceModel::class, 'customer_id')->where('flag', 1);
    }
}

