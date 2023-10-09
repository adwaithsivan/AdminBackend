<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherlinks extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'logo_upload',
        'link',
    ];
}
