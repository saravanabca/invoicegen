<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateActiveModel extends Model
{
    use HasFactory;
    
    protected $table = "template_active";

    protected $fillable = [
        'id',
        'template_name',
        'temp_active_status', 
    ];
}
