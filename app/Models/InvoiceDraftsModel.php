<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDraftsModel extends Model
{
    use HasFactory;
    
    protected $table = "invoice_drafts_table";

    protected $fillable = [
        'id',
        'auth_mail',
        'invoice_number', 
        'invoice_date', 
        'invoice_due_date', 
        'logo_img', 
        'biller_name', 
        'biller_email', 
        'biller_address', 
        'biller_phone', 
        'biller_gst', 
        'biller_pan', 
        'biller_fax', 
        'billing_name', 
        'billing_email',
        'billing_address',
        'billing_phone',
        'billing_gst',
        'billing_pan',
        'billing_fax',
        'bill_desc',
        'rate',
        'qty',
        'amt',
        'sub_total_amt',
        'all_total_amt',
        'gst',
        'discount',
        'notes_pay_terms',
        'bank_ac_details',
        'signature_img',
        
    ];
}
