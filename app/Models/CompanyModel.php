<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;
    
    protected $table = "company";

    protected $fillable = [
        'id',
        'auth_mail',
        'company_name',	
        'company_email',
        'company_mobile',
        'company_logo',	
        'company_gstin_number',	
        'company_address',	
        'company_pin_code',	
        'company_city',
        'company_state',
        'company_country',
        'company_shipping_address',	
        'company_shipping_pin_code',	
        'company_shipping_city',	
        'company_shipping_state',	
        'company_shipping_country',	
       	
        
    ];
    
    public function invoices()
    {
        return $this->hasMany(InvoiceModel::class, 'company_id')->where('flag', 1);
    }
 
}

