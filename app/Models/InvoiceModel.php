<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    use HasFactory;
    
    protected $table = "invoice";

    protected $fillable = [
        'id',
        'auth_mail',
        'invoice_number',
        'invoice_number_cat',
        'customer_name',	
        'customer_id',	
        'invoice_date',
        'due_date',	
        'product_name',	
        'product_hsnsac',	
        'product_rate',	
        'product_quantity',
        'product_quantity_type',
        'product_gst',
        'product_discount',
        'product_discount_type',
        'product_total',	
        'sgst',	
        'cgst',	
        'round_off',	
        'total_tax',	
        'overall_amt',
        'overall_discount',	
        'bank_id',	
        'payment_type',	
        'partially_paid',	
        'transaction_method',	
        'signature_id',	
        'signature_image',	
        'notes',	
        'terms_condition'	
        
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }
    
    public function company()
    {
        return $this->belongsTo(CompanyModel::class, 'company_id');
    }
}