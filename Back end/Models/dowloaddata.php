<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    /** @use HasFactory<\Database\Factories\DataFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'DataName',
        'DataFile',
    ];
    
}
