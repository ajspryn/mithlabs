<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcProduct extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
