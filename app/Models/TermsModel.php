<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsModel extends Model
{
    use HasFactory;
    
    protected $table = "terms";

    protected $fillable = [
        'id',
        'auth_mail',
        'terms',
        'terms_title',
        'company_id'
      
    ];
}
