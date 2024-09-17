<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureModel extends Model
{
    use HasFactory;
    
    protected $table = "signature";

    protected $fillable = [
        'id',
        'company_id',
        'auth_mail',
        'signature_name',
        'signature_image', 
        'canvas_image', 
        'signature_active'
    ];
}
