<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'last_date',
        'file_upload',
    ];
}
