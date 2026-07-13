<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Note: Kept global as it functions as a central supplier directory
class Company extends Model
{
    protected $table = 'company';

    protected $fillable = [
        'company',
        'type',
    ];
}
