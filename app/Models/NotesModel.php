<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotesModel extends Model
{
    use HasFactory;
    
    protected $table = "notes";

    protected $fillable = [
        'id',
        'auth_mail',
        'notes',
        'notes_title',
        'company_id'
      
    ];
}
