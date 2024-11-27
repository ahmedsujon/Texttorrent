<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberValidation extends Model
{
    use HasFactory;

    protected $table = 'number_validations';
    protected $casts = [
        'number_ids' => 'array',
    ];
}
