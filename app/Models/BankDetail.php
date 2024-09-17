<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'id',
        'auth_mail',
        'company_id',
        'bank_active',
        'account_no',
        'confirm_account_no',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'type'
    ];
}
