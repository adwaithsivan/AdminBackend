<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'heading',
        'caption',
        'description',
        'file_upload',
    ];
}
